<?php
/**
 * Author: Jay Jones
 * Date: 6/14/2025
 * File: home_controller.class.php
 * Description:
 */

class HomeController {
    public function index() {
        $view = new HomeIndex();
        $view->display();
    }
}