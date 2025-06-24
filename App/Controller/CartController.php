<?php
/**
 * Author: Jay Jones
 * Date: 6/23/2025
 * File: CartController.php
 * Description:
 */

namespace Capstone\Controller;

use Capstone\Model\Movies\MovieModel;
use Capstone\Model\Games\GamesModel;
use Capstone\Model\EBooks\EBookModel;
use Capstone\Model\Webapps\WebappModel;
use Capstone\View\cart\CartView;

class CartController
{
    public function add()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $item_id = $_POST['item_id'] ?? null;
        $item_type = $_POST['item_type'] ?? null;

        if (!$item_id || !$item_type) {
            header("Location: " . BASE_URL . '/index');
            exit;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;

        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $item_id && $item['type'] == $item_type) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $item_id,
                'type' => $item_type,
                'quantity' => 1,
            ];
        }

        header("Location: " . BASE_URL . '/cart/view');
        exit();
    }

    public function remove()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $item_id = $_POST['item_id'] ?? null;
        $item_type = $_POST['item_type'] ?? null;

        if (!$item_id || !$item_type) {
            header("Location: " . BASE_URL . '/cart/view');
            exit;
        }

        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] == $item_id && $item['type'] == $item_type) {
                unset($_SESSION['cart'][$index]);
                // reindex the array
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }

        header("Location: " . BASE_URL . '/cart/view');
        exit();
    }

    public function view()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $cart = $_SESSION['cart'] ?? [];

        $itemsInCart = [];

        $movies = MovieModel::getMovieModel();
        $games = GamesModel::getGamesModel();
        $ebooks = EBookModel::getEBookModel();
        $apps = WebappModel::getWebappModel();


        foreach ($cart as $entry) {
            $id = $entry['id'];
            $type = $entry['type'];
            $quantity = $entry['quantity'];

            $item = null;

            switch ($type) {
                case 'movie':
                    $item = $movies->view_movies($id);
                    break;
                case 'game':
                    $item = $games->view_games($id);
                    break;
                case 'ebook':
                    $item = $ebooks->view_books($id);
                    break;
                case 'webapp':
                    $item = $apps->view_apps($id);
                    break;
                default:
                    $item = null;
            }

            if ($item) {
                $itemsInCart[] = [
                    'item' => $item,
                    'type' => $type,
                    'quantity' => $quantity,
                ];
            }
        }
//        var_dump($itemsInCart);
//        exit;
        $view = new CartView($itemsInCart);
        $view->display();
    }
}