<?php




// add here $actions that are allowed when the user is not connected
$allowed_actions_while_not_connected = array('disconnect', 'verify');
if (empty($_SESSION['user_id']) && !in_array($action, $allowed_actions_while_not_connected))
{    // user is not connected
    $action = "disconnect";
}

require_once MODEL . 'Model.php';
require_once MODEL . 'ModelUser.php';




switch ($action)
{
    
    /***************************************************/
    /***********  BASIC USER VERIFICATIONS *************/
    /***************************************************/
    
    case "verify":
        
        if (empty(globalGet('login')) || empty(globalGet('pwd')))
        {
            $message_alert = array(
                'level' => 'danger',
                'title' => 'Error !',
                'message' => "Please fill in all the fields to log in."
            );

            $sidebar = false;
            $pagetitle = "Error : login to UWE";
            $view = "login";
            if (null !== globalGet('login')){
                $login = globalGet('login');
            }
        }
        else    
        {
            $data = array("Email" => globalGet('login'));
            $tab_u = ModelUser::selectWhere($data);
            if (count($tab_u) == 0)
            {
                $message_alert = array(
                    'level' => 'danger',
                    'title' => 'Error !',
                    'message' => "Your e-mail address is invalid."
                );

                $sidebar = false;
                $pagetitle = "Error : login to UWE";
                $view = "login";
                break;
            }
            else
            {
                if (!password_verify(globalGet("pwd"), $tab_u[0]->Password)) {
                    $message_alert = array(
                        'level' => 'danger',
                        'title' => 'Error !',
                        'message' => "Your password is invalid."
                    );
                    $sidebar = false;
                    $pagetitle = "Error : login to UWE";
                    $view = "login";
                    if (null !== globalGet('login')) {
                        $login = globalGet('login');
                    }
                    break;
                }
            }
            // Connection process
            session_name('UWE_portal_session');
            $_SESSION['user_mail'] = filter_var($tab_u[0]->Email, FILTER_SANITIZE_STRING);
            $_SESSION['user_role'] = filter_var($tab_u[0]->Role, FILTER_SANITIZE_STRING);
            $_SESSION['user_id']= filter_var($tab_u[0]->IDUser, FILTER_SANITIZE_STRING);
            $_SESSION['user_fname']= filter_var($tab_u[0]->FirstName, FILTER_SANITIZE_STRING);
            $_SESSION['user_lname']= filter_var($tab_u[0]->LastName, FILTER_SANITIZE_STRING);
            $_SESSION['user_number_resits'] = count(ModelExam::getResits($_SESSION['user_id']));
            $_SESSION['user_paid_resits'] = ModelExam::doesUserPayResits($_SESSION['user_id']);
            
           
            
            
            switch ($_SESSION['user_role'])
            {
                case "student":
                    $view = "student/home";
                    $pagetitle = "Welcome to UWE Portal";
                    break;
                case "staff":
                case "admin":   
                    $view = "staff/home";
                    $pagetitle = "Welcome to UWE Portal";
                    break;
            }
        }
        break;

    case "home":

        switch ($_SESSION['user_role'])
        {
            case "student":
                $view = "student/home";
                $pagetitle = "Welcome to UWE Portal";
                break;
            case "staff":
            case "admin":
            default:
                $view = "staff/home";
                $pagetitle = "Welcome to UWE Portal";
                break;
        }

        break;


    /***************************************************/
    /*****************   USER ACTIONS   ****************/
    /***************************************************/
    
    case "viewDetails":
        
        if ($_SESSION['user_role'] === "student"){
            
            $view = "student/details";
            $pagetitle = "My details";
        }
        
        break;
        
    case "editDetails":
        
        if ($_SESSION['user_role'] === "student"){
            
            $view = "student/edit";
            $pagetitle = "Edit my details";
        }
        
        break;



    case "viewList":

    if ($_SESSION['user_role'] === "staff" || $_SESSION['user_role'] === "admin"){

        $view = "staff/listStudent";
        $pagetitle = "Students list";
        
        $listStudents = ModelUser::selectAllStudents();
    }

    break;
        
    case "disconnect":
    default:
        session_destroy(); // reset the current session
        session_start(); // reset the current session
        $sidebar = false;
        $view = "login";
        $pagetitle = "Login to UWE";
        break;

}

require_once VIEW . "view.php";
