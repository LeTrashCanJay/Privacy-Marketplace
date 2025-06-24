<?php
/**
 * Author: Jay Jones
 * Date: 6/23/2025
 * File: LoginView.php
 * Description:
 */

namespace Capstone\View\user;

use Capstone\View\IndexView;

class LoginView extends IndexView {
    public function display() {
        parent::displayHeader("Login");

        if (isset($_SESSION['error'])) {
            echo "<div style='color:red; margin:10px 0;'>" . htmlspecialchars($_SESSION['error']) . "</div>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo "<div style='color:green; margin:10px 0;'>" . htmlspecialchars($_SESSION['success']) . "</div>";
            unset($_SESSION['success']);
        }

        ?>

            <h2>Login</h2>
            <form method="post" action="<?= BASE_URL ?>/user/login">
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required autofocus><br><br>

                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required><br><br>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <p>Don't have an account? <a href="<?= BASE_URL ?>/user/registerForm">Register here</a></p>

    <?php
        parent::displayFooter();
    }
}