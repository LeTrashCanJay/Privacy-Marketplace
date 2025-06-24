<?php
/**
 * Author: Jay Jones
 * Date: 6/23/2025
 * File: CartView.php
 * Description:
 */

namespace Capstone\View\cart;


use Capstone\View\home\HomeIndex;

class CartView extends HomeIndex
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function display()
    {
        parent::displayHeader("Your Cart");

        echo "<div class='container'>";
        echo "<h2>Your Cart</h2>";

        if (empty($this->items)) {
            echo "<p>Your Cart is empty!</p>";
        } else {
            echo "<table border='1' cellpadding='10' cellspacing='0' style='width:100%; text-align:left;'>";
            echo "<tr><th>Title</th><th>Price</th><th>Quantity</th><th>Total</th><th>Category</th><th>Action</th></tr>";

            $grandTotal = 0;

            foreach ($this->items as $entry) {
                $product = $entry['item'];  // <-- change here
                $qty = $entry['quantity'];
                $type = ucfirst($entry['type']);

                $title = htmlspecialchars($product->getTitle());
                $price = $product->getPrice();
                $total = $price * $qty;
                $grandTotal += $total;

                echo "<tr>";
                echo "<td>$title</td>";
                echo "<td>$" . number_format($price, 2) . "</td>";
                echo "<td>$qty</td>";
                echo "<td>$" . number_format($total, 2) . "</td>";
                echo "<td>$type</td>";
                echo "<td>
                        <form method='post' action='" . BASE_URL . "/cart/remove'>
                            <input type='hidden' name='item_id' value='" . $product->getId() . "'>
                            <input type='hidden' name='item_type' value='" . strtolower($type) . "'>
                            <button type='submit' class='btn btn-danger'>Remove</button>
                        </form>
                      </td>";
                echo "</tr>";
            }

            echo "<tr><td colspan='3'><strong>Grand Total</strong></td><td colspan='3'><strong>$" . number_format($grandTotal, 2) . "</strong></td></tr>";
            echo "</table>";
        }

        echo "<br><a class='btn btn-primary' href='" . BASE_URL . "/index'>Continue Shopping</a>";
        echo " | <a class='btn btn-success' href='" . BASE_URL . "/checkout'>Checkout</a>";
        echo "</div>";

        parent::displayFooter();

    }

}