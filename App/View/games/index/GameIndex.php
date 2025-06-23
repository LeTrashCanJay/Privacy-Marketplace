<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: GameIndex.php
 * Description:
 */

namespace Capstone\View\games\index;
use Capstone\View\games\GameIndexView;

class GameIndex extends GameIndexView {
    private array $games;

    public function __construct(array $games = []) {
        $this->games = $games;
    }

    public function display() {
        parent::displayHeader("All Video Games");
        ?>
        <div id="main-header">Video Games in Stock</div>

        <div class="grid-container">
            <?php
            if (empty($this->games)) {
                error_log("GameIndex::display() - No games found");
                echo 'No games found <br><br><br><br><br>';
            } else {
                foreach ($this->games as $i => $game) {
                    $id = $game->getId();
                    $title = $game->getTitle();
                    $price = $game->getPrice();
                    $image = $game->getImage();

                    if (strpos($image, 'http://') === false && strpos($image, 'https://') === false) {
                        $image = BASE_URL . "/". GAME_IMG . $image;
                    }

                    if ($i % 6 == 0) {
                        echo '<div class="row">';
                    }

                    echo "<div class='item-card'>";
                    echo "<p><a href='", BASE_URL, "/games/detail/$id'><img src='" . $image . "'></a><br>";
                    echo "<span>$title<br>Price: $price</span></p>";
                    echo "</div>";

                    if ($i % 6 == 5 || $i == count($this->games) - 1) {
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