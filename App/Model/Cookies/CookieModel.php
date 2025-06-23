<?php
/**
 * Author: Jay Jones
 * Date: 6/23/2025
 * File: CookieModel.php
 * Description:
 */

namespace Capstone\Model\Cookies;

use Capstone\Database;

class CookieModel {
    private $db;
    private $conn;
    private $tblCookies;

    private static $_instance = null;
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->conn = $this->db->getConnection();
        $this->tblCookies = $this->db->getCookies();
    }

    public static function getModel() {
        if (self::$_instance === null) {
            self::$_instance = new CookieModel();
        }
        return self::$_instance;
    }

    public function savePreference($user_id, $strictly_necessary, $performance, $analytics, $advertising) {
        $sql = "SELECT * FROM {$this->tblCookies} WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $sql = "UPDATE {$this->tblCookies} 
                    SET strictly_necessary = ?, performance = ?, analytics = ?, advertising = ? 
                    WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iiiii",
                $strictly_necessary,
                $performance,
                $analytics,
                $advertising,
                $user_id
            );
        } else {
            $sql = "INSERT INTO {$this->tblCookies}
                    (user_id, strictly_necessary, performance, analytics, advertising)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iiiii",
                $user_id,
                $strictly_necessary,
                $performance,
                $analytics,
                $advertising
            );
        }

        if (!$stmt->execute()) {
            error_log("Failed to save cookie preferences: " . $this->conn->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    public function getPreferences($user_id) {
        $sql = "SELECT * FROM {$this->tblCookies} WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

}