<?php
/**
 * Author: Jay Jones
 * Date: 6/8/2025
 * File: config.php
 * Description:
 */

//error reporting level: 0 to turn off all error reporting; E_ALL to report all
error_reporting(E_ALL);

//local time zone
date_default_timezone_set('America/New_York');

//base url
define("BASE_URL", "http://localhost/capstone/");

/*****
 * movies
 */

define("MOVIE_IMG", "public/images/movies");

/**
 * web-apps
 */

define("APP_IMG", "public/images/webapps");

/**
 * games
 */

define("GAME_IMG", "public/images/games");

/**
 * ebooks
 */

define("BOOK_IMG", "public/images/ebooks");