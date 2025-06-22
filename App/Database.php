<?php
/**
 * Author: Jay Jones
 * Date: 6/8/2025
 * File: Database.php
 * Description: Setting up the Database details.
 * Code belongs mostly to Dr. Louie Zhu. Code has been adjusted for my usage.
 */

namespace Capstone;

use mysqli;

class Database
{
    //database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'privacy_marketplace',
        'tblUsers' => 'users',
        'tblMovies' => 'movies',
        'tblEBooks' => 'ebooks',
        'tblApps' => 'webapps',
        'tblGames' => 'videogames',
        'tblCookies' => 'cookie_preferences',
    );

    //db connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor, please
    private function __construct() {
        $this->objDBConnection = new mysqli(
            $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
        );
        if (mysqli_connect_errno() != 0) {
            error_log("Database connection failed" . mysqli_connect_error());
            $message = "Connecting database failed: " . mysqli_connect_error() . ".";
            include 'error.php';
            exit();
        }
    }

    //single database instance
    static public function getDatabase() {
        if (self::$_instance == NULL) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    //return connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    //return all the tables
    public function getUsers() {
        return $this->param['tblUsers'];
    }
    public function getMovies() {
        return $this->param['tblMovies'];
    }
    public function getEbooks() {
        return $this->param['tblEBooks'];
    }
    public function getApps() {
        return $this->param['tblApps'];
    }
    public function getCookies() {
        return $this->param['tblCookies'];
    }
    public function getGames() {
        return $this->param['tblGames'];
    }
}