<?php
///**
// * Author: Jay Jones
// * Date: 6/8/2025
// * File: dispatcher.class.php
// * Description: Should break up the requested URL and route the request.
// * Code belongs to Dr. Louie Zhu, who I could not get this far without.
// */
//
//namespace App;
//
//class Dispatcher
//{
//    public function __construct() {
//        self::dispatch();
//    }
//
//    //dispatch request to the appropriate controller/method
//    public static function dispatch() {
//        //split the uri into url and querystrings
//        $uri_array = explode('?', trim($_SERVER['REQUEST_URI'], '/'));
//
//        //extract components in url and store them in an array.
//        $url_array = explode('/', $uri_array[0]);
//
//        //remove the root folder name from the array if there is
//        //array_shift($url_array);
//        while (array_search(basename(getcwd()), $url_array) !== FALSE) {
//            array_shift($url_array);
//        }
//
//        //strip off index.php or index from the beginning of url if present
//        if (count($url_array) > 0 && ($url_array[0] == "index.php" or $url_array[0] == "index")) {
//            array_shift($url_array);
//        }
//
//        //Now, the url_array contains controller name, followed by method name, and zero, one or more arguments
//        //get controller name or assign the default controller "HomeController"
//        $controllerName = !empty($url_array[0]) ? ucfirst($url_array[0]) . 'Controller' : 'HomeController';
//
//        //create controller instance
//        if (!class_exists($controllerName)) {
//            $message = "Controller '$controllerName' does not exist.";
//            include 'error.php';
//            exit();
//        }
//        $controller = new $controllerName();
//
//        //get method name or assign the default method "index"
//        $method = !empty($url_array[1]) ? $url_array[1] : 'index';
//
//        //remove .php from the method name if present
//        if (strpos($method, '.')) {
//            $method = substr($method, 0, strpos($method, '.'));
//        }
//        //get all arguments and store them in an array
//        $args = array();
//        if (count($url_array) > 2) {
//            $args = array_slice($url_array, 2);
//        }
//
//        //call a method with a variable number of arguments
//        call_user_func_array(array($controller, $method), $args);
//    }
//}


namespace Capstone;

class Dispatcher
{
    public static function dispatch()
    {
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $urlParts = explode('/', $requestUri);

        // Remove root folder if present
        while (array_search('capstone', $urlParts) !== false) {
            array_shift($urlParts);
        }

        if (!empty($urlParts) && ($urlParts[0] === 'index.php' || $urlParts[0] === 'index')) {
            array_shift($urlParts);
        }

        $controllerSegment = ucfirst($urlParts[0] ?? 'Home') . 'Controller';
        $method = $urlParts[1] ?? 'index';
        $args = array_slice($urlParts, 2);

        $controllerClass = "Capstone\\Controller\\$controllerSegment";

        if (!class_exists($controllerClass)) {
            self::error("❌ Controller '$controllerClass' not found.");
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            self::error("❌ Method '$method' not found in '$controllerClass'.");
            return;
        }

        call_user_func_array([$controller, $method], $args);
    }

    private static function error(string $message)
    {
        http_response_code(404);
        echo "<h1>404 Not Found</h1><p>$message</p>";
        exit;
    }
}
