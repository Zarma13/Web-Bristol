<div class="sidebar">
    <ul>
        
       
        <?php if ($_SESSION["user_role"] === "student") {?>
        <li><a href="."><span class="glyphicon glyphicon-home"></span>Home</a></li>
        <li><a href="?controller=exam&action=view"><span class="glyphicon glyphicon-education"></span>View your grades</a></li>
        <li><a href="?controller=exam&action=resit"><span class="glyphicon glyphicon-repeat"></span>Consult resits  </a>
                            <?php if (!$_SESSION['user_paid_resits']) echo $_SESSION['user_number_resits'] ? "<span class='badge'>" . $_SESSION['user_number_resits'] . "</span></li>" : '';?>
        <li><a href="?controller=exam&action=resitfees"><span class="glyphicon glyphicon-piggy-bank"></span>Pay resit fees    </a> </li>
        <li><a href="?controller=user&action=viewDetails"><span class="glyphicon glyphicon-user"></span>Your personnal details </a> </li>
        <?php } else if ($_SESSION["user_role"] === "staff" || $_SESSION["user_role"] === "admin") { ?>
        <li><a href="."><span class="glyphicon glyphicon-home"></span>Home</a></li>
        <li><a href="?controller=examStaff&action=viewExams"><span class="glyphicon glyphicon-file"></span>Exams</a> </li>
        <li><a href="?controller=examStaff&action=viewModule"><span class="glyphicon glyphicon-list-alt"></span>Modules</a> </li>
        <li><a href="?controller=examStaff&action=viewReports"><span class="glyphicon glyphicon-stats"></span>Generate reports </a>     
        <li><a href="?controller=user&action=viewList"><span class="glyphicon glyphicon-education"></span>Students </a></li>  
        <li><a href="?controller=examStaff&action=viewGrades"><span class="glyphicon glyphicon-education"></span>Grades</a></li> 
     
        
        <?php } if ($_SESSION["user_role"] === "admin") { ?>
            <li><a href="?controller=user&action=viewList""><span class="glyphicon glyphicon-education"></span>Admin</a></li>  
        <?php } ?> 
        
        
        <li><a href="?action=disconnect"><span class="glyphicon glyphicon-log-out"></span>Log out</a> </li>
    </ul>
</div>
