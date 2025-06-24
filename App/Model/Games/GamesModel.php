<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: GamesModel.php
 * Description:
 */

namespace Capstone\Model\Games;
use Capstone\Database;

class GamesModel {
    //private members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblGames;

    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblGames = $this->db->getGames();

        //escapes special characters in get and post
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //method to ensure one movie model
    public static function getGamesModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new GamesModel();
        }
        return self::$_instance;
    }

    public function list_games()
    {
        $sql = "SELECT * FROM " . $this->tblGames;

        $query = $this->dbConnection->query($sql);

        if (!$query) {
            error_log("Query failed: " . $this->dbConnection->error . " | SQL: " . $sql);
            return false;
        }

        if ($query->num_rows == 0) {
            return [];
        }

        $games = array();

        while ($obj = $query->fetch_object()) {
            $game = new Games(
                stripslashes($obj->title ?? ''),
                stripslashes($obj->price ?? ''),
                stripslashes($obj->image_url ?? ''),
                stripslashes($obj->description ?? '')
            );
            $game->setId($obj->id);
            $games[] = $game;
        }
        return $games;
    }

    public function view_games($id)
    {
        $idEscaped = $this->dbConnection->real_escape_string($id);
        $sql = "SELECT * FROM " . $this->tblGames . " WHERE id = '$id'";


        //execute
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();
            $game = new Games(
                stripslashes($obj->title ?? ''),
                stripslashes($obj->price ?? ''),
                stripslashes($obj->image_url ?? ''),
                stripslashes($obj->description ?? '')
            );
            //set id
            $game->setId($obj->id);

            return $game;
        }

        return false;
    }
}