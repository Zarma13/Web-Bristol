<h1>My grades</h1>
<div class="title-spacer"></div>

<?php if ($_SESSION['user_number_resits'])
{?>
<div class="row">
    <div class="alert alert-danger col-md-8 col-md-offset-2" role="alert"><b>You failed at least one module.</b> You can  <?php if (!$_SESSION['user_paid_resits']) {?>pay the resit fees from the <a href="?controller=exam&action=resitfees">resit page.</a><?php } else {?>contact a teacher to schedule a date.<?php } ?></div>
</div>
<?php } ?>

<row>
    <div class="col-md-6 col-md-offset-3">

        <table class="table table-hover table-grades">

            
            
            
            <?php foreach ($results as $module => $moduleData) { ?>
            
            <tr class="module">
                <td><?php echo $module;?></td>
            <td><?php echo $moduleData['averageLetter'];?></td>
            </tr>
            
                <?php foreach($moduleData['notes'] as $exam){ ?>

                <tr>
                    <td><?php echo $exam["exam"] ;?></td>
                    <td><?php echo $exam["note"] ;?>/100</td>
                </tr>
            <?php  } } ?>
        </table>
    </div>
</row>
