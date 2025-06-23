<?php

namespace Capstone\Model\Movies;

use Capstone\Database;

/**
 * Author: Jay Jones
 * Date: 6/8/2025
 * File: MovieModel.php
 * Description: The movie model.
 * Code belongs to Dr. Louie Zhu, with adjustments used for the purposes
 * of this project.
 */
class MovieModel
{
    //private members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblMovies;

    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblMovies = $this->db->getMovies();

        //escapes special characters in get and post
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //method to ensure one movie model
    public static function getMovieModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new MovieModel();
        }
        return self::$_instance;
    }

    public function list_movies()
    {
        $sql = "SELECT * FROM " . $this->tblMovies;

        $query = $this->dbConnection->query($sql);

        if (!$query) {
            error_log("Query failed: " . $this->dbConnection->error . " | SQL: " . $sql);
            return false;
        }

        if ($query->num_rows == 0) {
            return [];
        }

        $movies = array();

        while ($obj = $query->fetch_object()) {
            $movie = new Movie(
                stripslashes($obj->title ?? ''),
                stripslashes($obj->price ?? ''),
                stripslashes($obj->image_url ?? ''),
                stripslashes($obj->description ?? '')
            );
            $movie->setId($obj->id);
            $movies[] = $movie;
        }
        return $movies;
    }

    public function view_movies($id)
    {
        $idEscaped = $this->dbConnection->real_escape_string($id);
        $sql = "SELECT * FROM " . $this->tblMovies . " WHERE id = '$id'";


        //execute
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();
            //create movie object
            $movie = new Movie(
                stripslashes($obj->title ?? ''),
                stripslashes($obj->price ?? ''),
                stripslashes($obj->image_url ?? ''),
                stripslashes($obj->description ?? '')
            );
            //set id
            $movie->setId($obj->id);

            return $movie;
        }

        return false;
    }
}