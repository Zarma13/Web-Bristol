<?php


function globalGet($var)
{
    if (isset($_GET[$var]))
    {
        return $_GET[$var];
    }
    else if (isset($_POST[$var]))
    {
        return $_POST[$var];
    }
    else
    {
        return NULL;
    }
}


// changer pour définir le ctrl par default stoké dans $_SESSION

if (!is_null(globalGet('controller')))
    $controller = globalGet('controller'); //recupere le controlleur passe dans l'url
else
    $controller = "user";

if (!is_null(globalGet('action')))
    $action = globalGet('action');    //recupere l'action  passee dans l'url
else
    $action = "home";
    


switch ($controller) {

    case "exam":
        require_once "ControllerExam.php";
    break;

    case "examStaff":
        require_once "ControllerExamStaff.php";
    break;
    
    case "user":
    default:
        require_once "ControllerUser.php";
        break;
}

