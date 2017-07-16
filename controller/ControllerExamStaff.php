<?php

require_once MODEL . 'Model.php';
require_once MODEL . 'ModelExam.php';
require_once MODEL . 'ModelModule.php';
require_once MODEL . 'ModelUser.php';
require_once MODEL . 'ModelReport.php';


switch ($action)
{
    case "viewExams":
            $view = "staff/exams";
            $pagetitle = "Exams";

        $tab_examsDetails = ModelExam::selectAllExamDetails();
        $tab_modules = ModelModule::selectAll();
        $tab_teachers = ModelUser::selectAllTeachers();


        break;

    case "viewModule":      
            $view = "staff/module";
            $pagetitle = "Modules";
  
        
        $tab_modulesDetails = ModelModule::selectModuleDetails();   
        $tab_modulesNbParticipants = ModelModule::selectModuleNbParticipants();
        $tab_modulesExamDates = ModelModule::selectModuleExamDates();
        $tab_teachers = ModelUser::selectAllTeachers();

        break;

    case "viewReports":
        

            $view = "staff/reports";
            $pagetitle = "Reports";
        
        
        
        // first tab
        $tab_modules = ModelModule::selectAll();
        if (globalGet("moduleComplete")){
            $tab_notes =  ModelReport::selectNoteModuleStudent(globalGet("moduleComplete"));
        }else{
            $tab_notes =  ModelReport::selectNoteModuleStudent("Content Management System");   
        }
        
        
        // 2nd
        $tab_students = ModelUser::selectAllStudents();
        if (globalGet("student")){
            $tab_notesStudent = ModelReport::selectAllModulesStudent((int)globalGet("student"));
        }else{
            $tab_notesStudent = ModelReport::selectAllModulesStudent(4);
        }
        
        // 3rd
        $student_fail = ModelReport::getFailResult();
        
        // 4th
        $student_failedModules = array();
        foreach ($tab_students as $student) {
            $student_failedModules[$student->FirstName . " " . $student->LastName][] = ModelExam::getResits($student->IDUser);
        }

        //5th
        if (globalGet('module')) {
            $tab_passFailList = ModelReport::getPassFailList(globalGet('module'));
        }
        else {
            $tab_passFailList = ModelReport::getPassFailList("Content Management System");
        }


        break;

    case "viewGrades":

        $view = "staff/grades";
        $pagetitle = "Grades";

        $tab_allNotes = ModelReport::selectNoteAllModuleAllStudent();
        $tab_notDone = ModelReport::selectAllNotDoneExam();

        break;


    case 'sendmail':

        $view = "staff/grades";
        $pagetitle = "Grades";
        
        $to = 'Jonathan2.Maturana@live.uwe.ac.uk';
        $subject = 'Your UWE grades';

        $headers = 'Mime-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "\r\n";

        $students = ModelUser::selectAllStudents();
        //foreach ($students as $student){
            // we should send email to each $student -> Email
       // }
        
        /** FOR DEMO ONLY we will send a mail to only one student **/
        $results = ModelExam::getResults(4);
        $results = $results['modules_notes'];
        $name = "Loic GUIN";
        require_once VIEW . 'mailTemplate.php';

        $mail_sent = mail($to, $subject, $messageTpm, $headers);

        
         

        $tab_allNotes = ModelReport::selectNoteAllModuleAllStudent();
        $tab_notDone = ModelReport::selectAllNotDoneExam();

        
        
        break;
}
require_once VIEW . "view.php";
