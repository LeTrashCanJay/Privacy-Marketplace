<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: EBookModel.php
 * Description:
 */

namespace Capstone\Model\EBooks;
use Capstone\Database;

class EBookModel {
    //private members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblEBooks;

    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblEBooks = $this->db->getEbooks();

        //escapes special characters in get and post
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    // one book model
    public static function getEBookModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new EBookModel();
        }
        return self::$_instance;
    }

    public function list_books()
    {
        $sql = "SELECT * FROM " . $this->tblEBooks;

        $query = $this->dbConnection->query($sql);

        if (!$query) {
            error_log("Query failed: " . $this->dbConnection->error . " | SQL: " . $sql);
            return false;
        }

        if ($query->num_rows == 0) {
            return [];
        }

        $ebooks = array();

        while ($obj = $query->fetch_object()) {
            $ebook = new EBook(
                stripslashes($obj->title ?? ''),
                stripslashes($obj->price ?? ''),
                stripslashes($obj->image_url ?? ''),
                stripslashes($obj->description ?? '')
            );
            $ebook->setId($obj->id);
            $ebooks[] = $ebook;
        }
        return $ebooks;
    }

    public function view_books($id)
    {
        $idEscaped = $this->dbConnection->real_escape_string($id);
        $sql = "SELECT * FROM " . $this->tblEBooks . " WHERE id = '$id'";


        //execute
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();
            $ebook = new EBook(
                stripslashes($obj->title ?? ''),
                stripslashes($obj->price ?? ''),
                stripslashes($obj->image_url ?? ''),
                stripslashes($obj->description ?? '')
            );
            //set id
            $ebook->setId($obj->id);

            return $ebook;
        }

        return false;
    }
}