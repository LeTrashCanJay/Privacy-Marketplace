<?php
/**
 * Author: Jay Jones
 * Date: 6/23/2025
 * File: CheckoutView.php
 * Description:
 */


namespace Capstone\View\checkout;

use Capstone\View\home\HomeIndex;

class CheckoutView extends HomeIndex
{
    private string $cookieMessage;

    public function __construct(string $cookieMessage = "")
    {
        $this->cookieMessage = $cookieMessage;
    }

    public function display()
    {
        parent::displayHeader("Checkout Complete");

        echo "<div class='container'>";
        echo "<h2>You've checked out!</h2>";
        echo "<textarea rows='15' cols='100' readonly style='width:100%; font-family: monospace; padding: 10px;'>" . htmlspecialchars($this->cookieMessage) . "</textarea>";
        echo "<br><a href='" . BASE_URL . "/index' class='btn btn-primary'>Return to Home</a>";
        echo "</div>";

        parent::displayFooter();
    }
}
