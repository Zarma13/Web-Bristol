<?php

session_start();
$sidebar = true; // by default, the sidebar is displayed
// Désactiver le rapport d'erreurs
error_reporting(0);

//define the root of our website
define('ROOT', dirname(__FILE__) . '/');
define('MODEL', ROOT .'/model/');
define('CONTROLLER', ROOT .'/controller/');
define('VIEW', ROOT .'/view/');
define('ASSETS', ROOT .'/assets/');



// dispatcher : filter requests and call specifics controllers
include_once ROOT . 'conf/Conf.php';
require_once MODEL . 'Model.php';
require_once MODEL . 'ModelExam.php';
require_once MODEL . 'ModelUser.php';
include_once ROOT . '/controller/dispatcher.php';


