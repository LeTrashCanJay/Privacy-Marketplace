<?php
/**
 * Author: Jay Jones
 * Date: 6/23/2025
 * File: CookieController.php
 * Description:
 */

namespace Capstone\Controller;

use Capstone\Model\Cookies\CookieModel;

class CookieController {
    public function save() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        $strictly_necessary = 1;
        $performance = isset($_POST['performance']) ? 1 : 0;
        $analytics = isset($_POST['analytics']) ? 1 : 0;
        $advertising = isset($_POST['advertising']) ? 1 : 0;

        //associate with user
        $user_id = $_SESSION['user_id'] ?? null;

        if ($user_id) {
            $model = CookieModel::getModel();
            $model->savePreference($user_id, $strictly_necessary, $performance, $analytics, $advertising);
        }

        //set cookie so no pop-ups appear
        setcookie("cookie_preferences_set", "1", time() + (86400 * 30), "/"); //30-day period

        //suppress pop-up this cycle
        $_SESSION['cookie_preferences_set'] = true;

        $redirect = $_SERVER['HTTP_REFERER'] ?? BASE_URL . '/index';
        header('Location: ' . $redirect);
        exit();
    }
}