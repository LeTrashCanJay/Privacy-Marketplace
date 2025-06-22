<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: MovieIndex.php
 * Description:
 */

namespace Capstone\View\movie\index;

use Capstone\View\movie\MovieIndexView;

class MovieIndex extends MovieIndexView {
    //show the movies.

    public function display($movies) {
        parent::displayHeader("All Movies");
        ?>
        <div id="main-header">Movies in Stock</div>

        <div class="grid-container">
            <?php
            if($movies === 0) {
                echo 'No movies found. <br><br><br><br><br>';
            } else {
               foreach($movies as $i => $movie) {
                   $id = $movie->getMovieId();
                   $title = $movie->getTitle();
                   $price = $movie->getPrice();
                   $image = $movie->getImage();

                   if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                       $image = BASE_URL . "/" . MOVIE_IMG . $image;
                   }
                   if ($i % 6 == 0) {
                       echo "<div class='row'>";
                   }

                   echo "<div class='store-grid'><p><a href='", BASE_URL, "/movie/detail/$id'><img src='" . $image .
                       "'></a><span>$title<br>Price: </span></p></div>";
                   ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($movies) - 1) {
                        echo "</div>";
                    }
               }
            }
            ?>
        </div>

        <?php
        parent::displayFooter();
    }
}