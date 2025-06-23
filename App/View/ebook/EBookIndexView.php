<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: EBookIndexView.php
 * Description:
 */

namespace Capstone\View\ebook;
use Capstone\View\home\HomeIndex;

class EBookIndexView extends HomeIndex {
    public static function displayHeader($title) {
        parent::displayHeader($title);
        ?>
        <script>
            var media = "ebook";
        </script>
    <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}