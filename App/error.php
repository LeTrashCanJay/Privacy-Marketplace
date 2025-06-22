<?php
/**
 * Author: Jay Jones
 * Date: 6/8/2025
 * File: error.php
 * Description: Script to display an error message
 * Code belongs to Dr. Louie Zhu, who I could not get this far without.
 */

use Capstone\View\IndexView;

require_once 'View/IndexView.php';
require_once __DIR__ . '/config.php';

$page_title = "Error";

if (isset($message)) {
    error_log("Error displayed: " . urldecode($message));
}
//display render
IndexView::displayHeader($page_title);
?>
<div id = "main-header">Error</div>
<hr>
<table style = "width: 100%; border: none">
    <tr>
        <td style = "vertical-align: middle; text-align: center; width:100px">
            <img src = '<?= BASE_URL ?>/public/images/error.jpg' style = "width: 80px; border: none"/>
        </td>
        <td style = "text-align: left; vertical-align: top;">
            <h3> Sorry, but an error has occurred.</h3>
            <div style = "color: red">
                <?= isset($message) ? htmlspecialchars(urldecode($message)) : 'An error has occurred. Please try again.'?>
            </div>
            <br>
        </td>
    </tr>
</table>
<br><br><br><br><hr>
<a href="<?= BASE_URL ?>index">Back to Main Page</a>

<?php
IndexView::displayFooter();

