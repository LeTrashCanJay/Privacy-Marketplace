<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: WebappIndexView.php
 * Description:
 */

namespace Capstone\View\webapps;
use Capstone\View\home\HomeIndex;

class WebappIndexView extends HomeIndex {
    public static function displayHeader($title) {
        parent::displayHeader($title);
        ?>
        <script>
            var media = "webapps";
        </script>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}