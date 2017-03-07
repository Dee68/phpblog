<?php
/****************************************************
*** output buffering on to enable redirect **********
*/
ob_start();
/****************************************************
*** enable session inclusion on all pages ***********
*/
session_start();
$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
if (!isset($_SESSION['initiated']))
{
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}

// set time-out period (in seconds)
$inactive = 240;//4 mins.
// check to see if $_SESSION["timeout"] is set
if (isset($_SESSION["timeout"])) {
    // calculate the session's "time to live"
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
        session_destroy();
        header("Location: ../logout");
    }
}

$_SESSION["timeout"] = time();

/****************************************************
*** defination of path constants ********************
*****************************************************
*/
defined("DS") ? null :define("DS",DIRECTORY_SEPARATOR);
define("BASE_URL","/phpblog/");
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT",__DIR__ . DS ."front".DS);
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK",__DIR__ . DS ."back".DS);
defined("ADMIN") ? null : define("ADMIN",BASE_URL."admin/");
//defined("IMAGE_DIR") ? null : define("IMAGE_DIR",__DIR__ . DS ."images" .DS);
defined("ROOT")? null:define("ROOT",$_SERVER['DOCUMENT_ROOT'] . DS . "phpblog".DS);

/*******************************************************
**** database configuration constants ******************
********************************************************
*/

$db['db_host'] = 'localhost';
$db['db_name'] = 'phpblog';
$db['db_user'] = 'root';
$db['db_pass'] = '';
foreach ($db as $key => $value) {
  define(strtoupper($key), $value);
  
}


