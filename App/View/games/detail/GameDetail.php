<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: EbookDetail.php
 * Description:
 */

namespace Capstone\View\ebook\detail;

use Capstone\View\games\GameIndexView;
use Capstone\Model\Games\Games;

class GameDetail extends GameIndexView {

    public function show($game, $confirm = "") {
        //display page header
        parent::displayHeader("Display Movie Details");

        //retrieve movie details by calling get methods
        $id = $game->getId();
        $title = $game->getTitle();
        $price = $game->getPrice();
        $image = $game->getImage();
        $description = $game->getDescription();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . GAME_IMG . $image;
        }
        ?>

        <div id="main-header">Video Game Details</div>
        <hr>
        <!-- display movie details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 200px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" class="detail-img" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Title:</strong></p>
                    <p><strong>Description:</strong></p>
                    <p><strong>Price: </strong></p>
                    <div id="button-group">
                        <form method="post" action="<?= BASE_URL ?>/cart/add">
                            <input type="hidden" name="item_id" value="<?= htmlspecialchars($game->getId()) ?>">
                            <input type="hidden" name="item_type" value="movie">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </td>
                <td>
                    <p><?= $title ?></p>
                    <p class="media-description"><?= $description ?></p>
                    <p><?= $price ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a href="<?= BASE_URL ?>/games/index">Go to Video Games List</a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}