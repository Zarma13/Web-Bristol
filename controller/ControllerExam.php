<?php

// add here $actions that are allowed when the user is not connected
$allowed_actions_while_not_connected = array();
if (empty($_SESSION['user_id']) && !in_array($action, $allowed_actions_while_not_connected))
{    // user is not connected
    header('Location: .?action=disconnect');
        die();
}




/** This controller is actually a dispatcher between student exam controller & admin exam controller * */
switch ($_SESSION['user_role'])
{
    case 'student':
        require_once CONTROLLER . "ControllerExamStudent.php";
        break;
    case 'admin':
    case 'staff':
        require_once CONTROLLER . "ControllerExamStaff.php";
        break;
    default :
        header('Location: .?action=disconnect');
        die();
}

