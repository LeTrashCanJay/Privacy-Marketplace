<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: WebappDetail.php
 * Description:
 */

namespace Capstone\View\webapps\detail;
use Capstone\View\webapps\WebappIndexView;

class WebappDetail extends WebappIndexView {

    public function show($webapp, $confirm = "") {
        //display page header
        parent::displayHeader("Display Webapp Details");

        //retrieve movie details by calling get methods
        $id = $webapp->getId();
        $title = $webapp->getTitle();
        $price = $webapp->getPrice();
        $image = $webapp->getImage();
        $description = $webapp->getDescription();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . APP_IMG . $image;
        }
        ?>

        <div id="main-header">Web-App Details</div>
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
                            <input type="hidden" name="item_id" value="<?= htmlspecialchars($webapp->getId()) ?>">
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
        <a href="<?= BASE_URL ?>/webapps/index">Go to Web-App List</a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}