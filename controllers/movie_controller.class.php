<?php
/**
 * Author: Jay Jones
 * Date: 6/8/2025
 * File: movie_controller.class.php
 * Description: Controller for the movie items
 * Code belongs to Dr. Louie Zhu with minor adjustments for my purposes.
 */

class MovieController
{
    private $movie_model;

    public function __construct()
    {
        //instance of movie model class
        $this->movie_model = MovieModel::getMovieModel();
    }

    //index action

}