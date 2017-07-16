<?php

define('ROOT', dirname(__FILE__));
define('MODEL', ROOT . '/model/');
define('VIEW', ROOT . '/view/');
define('ASSETS', ROOT . '/assets/');




echo password_hash("admin", PASSWORD_DEFAULT)."\n";





$isStaff = true;
$isAdmin = false;
$isStudent = false;
$sidebar = true;



if (isset($_GET['page']))
{
    if (strpos($_GET["page"], "/"))
    {
        $page = substr(strstr($_GET['page'], "/"), 1);
    }
    else
    {
        $page = "login";
    }
    echo $page;


    require "view/header.php";

    require "view/" . $_GET['page'] . '.php';

    require 'view/footer.php';
}

