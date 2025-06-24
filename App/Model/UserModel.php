<?php
/**
 * Author: Jay Jones
 * Date: 6/23/2025
 * File: UserModel.php
 * Description:
 */

namespace Capstone\Model;
use Capstone\Database;

class UserModel {
    private $conn;
    private $tblUsers;

    public function __construct() {
        $db = Database::getDatabase();
        $this->conn = $db->getConnection();
        $this->tblUsers = $db->getUsers();
    }

    /**
     * Fetch data by email
     * @param string email
     * @return array|null associative array or null if not found
     */

    public function getByEmail(string $email): ?array {
        $sql = "SELECT * FROM {$this->tblUsers} WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows ? $result->fetch_assoc() : null;
    }

    /**
     * Fetch user data by ID
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array {
        $sql = "SELECT * FROM {$this->tblUsers} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows ? $result->fetch_assoc() : null;
    }

    /**
     * Create new user with email and hashed password
     * @param string $email
     * @param string $passwordHash
     * @return bool success or failure
     */
    public function createUser(string $email, string $passwordHash): bool {
        $sql = "INSERT INTO {$this->tblUsers} (email, password_hash) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $passwordHash);
        return $stmt->execute();
    }

    /**
     * Check if an email is already registered
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email): bool {
        $user = $this->getByEmail($email);
        return $user !== null;
    }

    /**
     * Verify user credentials: fetch user and verify password
     * @param string $email
     * @param string $password plaintext password to verify
     * @return array|null user data if verified, or null if invalid
     */
    public function verifyCredentials(string $email, string $password): ?array {
        $user = $this->getByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return null;
    }
}