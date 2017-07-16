<?php


if (empty($_SESSION['user_id']) || $_SESSION['user_role'] != 'student')
{    // user is not allowed
    header('Location: .?action=disconnect');
        die();
}



switch ($action)
{

    case "view":
        
        $results = ModelExam::getResults($_SESSION['user_id']);
        $results = $results['modules_notes'];
        $view = 'student/grades';
        $pagetitle = "My grades";
        break;
    
    case "resit":
        $view = "student/resit";
        $pagetitle = "My resits";
        
        
        $failedModules = ModelExam::getResits($_SESSION['user_id']);
        //update of $_SESSION['user_number_resits']
        $_SESSION['user_number_resits'] = count($failedModules);
        break;
    
    case "resitfees":
        
        $view = "student/payfees";
        $pagetitle = "Pay your resit fees";
        break;
    
    
    case "resitfeessuccess":
        
        
        ModelUser::update(array(
            'paidResits' => '1',
             'IDUser' => $_SESSION['user_id']
        ));
        
        
        $message_alert = array(
                'level' => 'success',
                'title' => 'Success',
                'message' => "You successfully paid your resit fees. Please contact your teacher to set a date for your resits."
            );
        
        $_SESSION['user_paid_resits'] = ModelExam::doesUserPayResits($_SESSION['user_id']);
        
        $failedModules = ModelExam::getResits($_SESSION['user_id']);
        //update of $_SESSION['user_number_resits']
        $_SESSION['user_number_resits'] = count($failedModules);    
        
        
        
        $view = "student/resit";
        $pagetitle = "My resits";
        break;
    
    
    
    
    
    
}

require_once VIEW . "view.php";