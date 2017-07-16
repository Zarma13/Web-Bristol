<?php $resit = true; ?>

<div class="row">
    <div class="col-md-10">
        <h1>Resit</h1>
    </div>
    <?php if ($resit && ! $_SESSION['user_paid_resits'])
    {
        ?>
        <div class="col-md-2">
            <a class="btn btn-info title-margin" href="?controller=exam&action=resitfees"><span class="glyphicon glyphicon-gbp" aria-hidden="true"></span> Pay resit fees</a> 
        </div>
<?php } ?>
</div>

<div class="title-spacer"></div>


<div clas="row">

    <div class="col-md-10">
<?php if ($_SESSION['user_number_resits'])
{?>

            <p>You failes some of your module. Please <?php if (!$_SESSION['user_paid_resits']) {?>pay the resit fees and <?php }?>schedule a date, otherwise you won't pass your semester.   </p>
<?php } else { ?>
            <p>Congratulations, you passed all your modules. You don't have any resit.</p>
<?php } ?>

    </div>

</div>



<br/><br/>


<?php if ($_SESSION['user_number_resits']) { 


    foreach ($failedModules as $module) { ?>


<div class = "row">
    <div class = "col-md-6 col-md-offset-3">
        <div class = "panel panel-danger">
            <div class = "panel-heading">
                <h3 class = "panel-title"><?php echo $module['name'];?></h3>
            </div>
            <div class = "panel-body">
                
                <?php switch($module['reason']){
                    
                    case 'avgUnder50':
                        echo "You failed \"". $module['name'] . "\". Your grade was under 50%.";
                        break;
                    case 'examNoteUnder40':
                        echo "You failed \"". $module['name'] . "\". You get under 40/100 on one of your exams.";
                        break;
                }?>
                
            </div>
        </div>
    </div>
</div>

     

    <?php }} ?>