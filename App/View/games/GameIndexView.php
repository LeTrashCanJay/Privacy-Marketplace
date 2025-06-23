<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: GameIndexView.php
 * Description:
 */

namespace Capstone\View\games;
use Capstone\View\home\HomeIndex;

class GameIndexView extends HomeIndex {
    public static function displayHeader($title) {
        parent::displayHeader($title);
        ?>
        <script>
            var media = "videogames";
        </script>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}