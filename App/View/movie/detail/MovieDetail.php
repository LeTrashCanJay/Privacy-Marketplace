<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: MovieDetail.php
 * Description:
 */

namespace Capstone\View\movie\detail;

use Capstone\View\movie\MovieIndexView;
use Capstone\Model\Movies\Movie;

class MovieDetail extends MovieIndexView {

    public function show($movie, $confirm = "") {
        //display page header
        parent::displayHeader("Display Movie Details");

        //retrieve movie details by calling get methods
        $id = $movie->getId();
        $title = $movie->getTitle();
        $price = $movie->getPrice();
        $image = $movie->getImage();
        $description = $movie->getDescription();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . MOVIE_IMG . $image;
        }
        ?>

        <div id="main-header">Movie Details</div>
        <hr>
        <!-- display movie details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 200px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" class="movie-detail-img" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Title:</strong></p>
                    <p><strong>Description:</strong></p>
                    <p><strong>Price: </strong></p>
                    <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/movie/edit/<?= $id ?>'">&nbsp;
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
        <a href="<?= BASE_URL ?>/movie/index">Go to movie list</a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}