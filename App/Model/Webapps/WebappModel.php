<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: WebappModel.php
 * Description:
 */

namespace Capstone\Model\Webapps;
use Capstone\Database;

class WebappModel
{
    //private members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblApps;

    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblApps = $this->db->getApps();

        //escapes special characters in get and post
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //method to ensure one movie model
    public static function getWebappModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new WebappModel();
        }
        return self::$_instance;
    }

    public function list_apps()
    {
        $sql = "SELECT * FROM " . $this->tblApps;

        $query = $this->dbConnection->query($sql);

        if (!$query) {
            error_log("Query failed: " . $this->dbConnection->error . " | SQL: " . $sql);
            return false;
        }

        if ($query->num_rows == 0) {
            return [];
        }

        $apps = array();

        while ($obj = $query->fetch_object()) {
            $app = new Webapps(
                stripslashes($obj->title ?? ''),
                stripslashes($obj->price ?? ''),
                stripslashes($obj->image_url ?? ''),
                stripslashes($obj->description ?? '')
            );
            $app->setId($obj->id);
            $apps[] = $app;
        }
        return $apps;
    }

    public function view_apps($id)
    {
        $idEscaped = $this->dbConnection->real_escape_string($id);
        $sql = "SELECT * FROM " . $this->tblApps . " WHERE id = '$id'";


        //execute
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();
            //create movie object
            $app = new Webapps(
                stripslashes($obj->title ?? ''),
                stripslashes($obj->price ?? ''),
                stripslashes($obj->image_url ?? ''),
                stripslashes($obj->description ?? '')
            );
            //set id
            $app->setId($obj->id);

            return $app;
        }

        return false;
    }
}