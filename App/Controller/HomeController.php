<?php
/**
 * Author: Jay Jones
 * Date: 6/14/2025
 * File: HomeController.php
 * Description:
 */

namespace Capstone\Controller;

use Capstone\View\home\HomeIndex;

class HomeController {
    public function index() {
        $view = new HomeIndex();
        $view->display();
    }
}