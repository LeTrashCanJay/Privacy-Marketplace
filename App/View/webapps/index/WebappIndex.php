<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: WebappIndex.php
 * Description:
 */

namespace Capstone\View\webapps\index;
use Capstone\View\webapps\WebappIndexView;

class WebappIndex extends WebappIndexView {
    private array $webapps;

    public function __construct(array $webapps = []) {
        $this->webapps = $webapps;
    }

    //
    public function display() {
        parent::displayHeader("All Web-Apps");
        ?>
        <div id="main-header">Web-Apps in Stock</div>

        <div class="grid-container">
            <?php
            if(empty($this->webapps)) {
                error_log("WebappIndex::display() - No webapps found");
                echo 'No Web-Apps found. <br><br><br><br><br>';
            } else {
                foreach($this->webapps as $i => $webapp) {
                    $id = $webapp->getId();
                    $title = $webapp->getTitle();
                    $price = $webapp->getPrice();
                    $image = $webapp->getImage();

                    if (strpos($image, 'http://') === false && strpos($image, 'https://') === false) {
                        $image = BASE_URL . "/". APP_IMG . $image;
                    }

                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='item-card'>";
                    echo "<p><a href='", BASE_URL, "/webapps/detail/$id'><img src='" . $image . "'></a><br>";
                    echo "<span>$title<br>Price: $price</span></p>";
                    echo "</div>";

                    if ($i % 6 == 5 || $i == count($this->webapps) - 1) {
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