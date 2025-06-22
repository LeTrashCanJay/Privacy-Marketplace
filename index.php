<?php
/**
 * Author: Jay Jones
 * Date: 6/9/2025
 * File: index.php
 * Description:
 */

// Turn on error reporting and display errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/php-error.log');


require_once("App\config.php");

require_once ("vendor\autoload.php");

use Capstone\Dispatcher;

Dispatcher::dispatch();