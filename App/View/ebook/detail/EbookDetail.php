<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: EbookDetail.php
 * Description:
 */

namespace Capstone\View\ebook\detail;

use Capstone\View\ebook\EBookIndexView;
use Capstone\Model\EBooks\EBook;

class EbookDetail extends EBookIndexView {

    public function show($ebook, $confirm = "") {
        //display page header
        parent::displayHeader("Display Movie Details");

        //retrieve movie details by calling get methods
        $id = $ebook->getId();
        $title = $ebook->getTitle();
        $price = $ebook->getPrice();
        $image = $ebook->getImage();
        $description = $ebook->getDescription();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . BOOK_IMG . $image;
        }
        ?>

        <div id="main-header">E-Book Details</div>
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
                            <input type="hidden" name="item_id" value="<?= htmlspecialchars($ebook->getId()) ?>">
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
        <a href="<?= BASE_URL ?>/ebook/index">Go to E-Book List</a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}