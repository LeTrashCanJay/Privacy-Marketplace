<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: WebappError.php
 * Description:
 */

namespace Capstone\View\webapps\error;
use Capstone\View\webapps\WebappIndexView;

class WebappError extends WebappIndexView {
    private string $message;

    public function __construct(string $message = "An unknown error occurred.") {
        $this->message = $message;
    }

    public function display() {
        parent::displayHeader("Error");
        ?>

        <div id="main-header">Error</div>
        <hr>
        <table style="width: 100%; border: none">
            <tr>
                <td style="vertical-align: middle; text-align: center; width:100px">
                    <img src='<?= BASE_URL ?>/public/images/error.jpeg' style="width: 80px; border: none"/>
                </td>
                <td style="text-align: left; vertical-align: top;">
                    <h3> Sorry, but an error has occurred.</h3>
                    <div style="color: red">
                        <?= urldecode($this->message) ?>
                    </div>
                    <br>
                </td>
            </tr>
        </table>
        <br><br><br><br><hr>
        <a href="<?= BASE_URL ?>webapps/index">Back to Webapp List</a>
        <?php
        //display page footer
        parent::displayFooter();
    }
}