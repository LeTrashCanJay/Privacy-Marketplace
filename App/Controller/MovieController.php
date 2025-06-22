<?php

namespace Capstone\Controller;

use Capstone\Model\Movies\MovieModel;
use Capstone\View\movie\index\MovieIndex;
use Capstone\View\movie\detail\MovieDetail;
use Capstone\View\movie\error\MovieError;

/**
 * Author: Jay Jones
 * Date: 6/8/2025
 * File: MovieController.php
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
    public function index() {
        $movies = $this->movie_model->list_movies();
        if(!$movies) {
            //toss an error
            $message = "We've had an issue with displaying the movies. Please try again later.";
            $this->error($message);
        }

        $view = new MovieIndex();
        $view->display($movies);

    }

    public function detail($id) {
        //retrieve specific movie
        $movie = $this->movie_model->view_movies($id);

        if (!$movie) {
            $message = "There was an issue displaying the movie id='".$id."'.";
            $this->error($message);
            return;
        }

        $view = new MovieDetail();
        $view->display($movie);

    }

    //handle ya errors
    public function error($message) {
        $error = new MovieError();

        $error->display($message);
    }
}