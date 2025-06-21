<?php
/**
 * Author: Jay Jones
 * Date: 6/9/2025
 * File: index.php
 * Description:
 */

require_once("App\Dispatcher.php");

require_once("App\config.php");

require_once ("vendor\autoload.php");

use Capstone\Dispatcher;

Dispatcher::dispatch();