<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: EBookIndex.php
 * Description:
 */

namespace Capstone\View\ebook\index;
use Capstone\View\ebook\EBookIndexView;

class EBookIndex extends EBookIndexView {
    private array $ebooks;

    public function __construct(array $ebooks = []) {
        $this->ebooks = $ebooks;
    }

    //
    public function display() {
        parent::displayHeader("All E-Books");
        ?>
        <div id="main-header">E-Books in Stock</div>

        <div class="grid-container">
            <?php
            if(empty($this->ebooks)) {
               error_log("EbookIndex::display() - No ebooks found");
               echo 'No E-Books found. <br><br><br><br><br>';
            } else {
               foreach($this->ebooks as $i => $ebook) {
                   $id = $ebook->getId();
                   $title = $ebook->getTitle();
                   $price = $ebook->getPrice();
                   $image = $ebook->getImage();

                   if (strpos($image, 'http://') === false && strpos($image, 'https://') === false) {
                        $image = BASE_URL . "/". BOOK_IMG . $image;
                   }

                   if ($i % 6 == 0) {
                      echo "<div class='row'>";
                   }

                   echo "<div class='item-card'>";
                   echo "<p><a href='", BASE_URL, "/ebook/detail/$id'><img src='" . $image . "'></a><br>";
                   echo "<span>$title<br>Price: $price</span></p>";
                   echo "</div>";

                   if ($i % 6 == 5 || $i == count($this->ebooks) - 1) {
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