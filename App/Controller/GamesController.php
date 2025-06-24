<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: GamesController.php
 * Description:
 */

namespace Capstone\Controller;

use Capstone\Model\Games\GamesModel;
use Capstone\View\games\index\GameIndex;
use Capstone\View\ebook\detail\GameDetail;
use Capstone\View\games\error\GameError;

class GamesController
{
    private $game_model;

    public function __construct()
    {
        //instance of movie model class
        $this->game_model = GamesModel::getGamesModel();
    }

    //index action
    public function index() {
        $games = $this->game_model->list_games();
        if(!$games) {
            //toss an error
            error_log("GamesModel::list_games() returned false. Possible DB error.");
            $message = "We've had an issue with displaying our games. Please try again later.";
            $this->error($message);
            return;
        }

        $view = new GameIndex($games);
        $view->display();

    }

    public function detail($id) {
        $game = $this->game_model->view_games($id);

        if (!$game) {
            $message = "There was an issue displaying the game id='".$id."'.";
            $this->error($message);
            return;
        }

        $view = new GameDetail();
        $view->show($game);

    }

    //handle ya errors
    public function error($message) {
        $error = new GameError();

        $error->display($message);
    }
}