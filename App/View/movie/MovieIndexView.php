<?php

namespace Capstone\View\movie;

use Capstone\View\home\HomeIndex;

/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: MovieIndexView.php
 * Description:
 */

class MovieIndexView extends HomeIndex {
    public static function displayHeader($title) {
        parent::displayHeader($title);
        ?>
        <script>
            //the media type
            var media = "movie";
        </script>
    <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}