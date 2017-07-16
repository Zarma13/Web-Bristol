<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo isset($pagetitle) ? $pagetitle : "UWE Portal";?></title>
		<link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css" >
		<link rel="stylesheet" href="assets/css/custom.css" >
		<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link href="assets/favicon.ico" rel="shortcut icon" type="image/x-icon" />
                <script src="assets/lib/jquery/jquery.min.js"></script>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">


    </head>
    
    <body>

	<nav class="navbar navbar-default navbar-fixed-top ">
	  <div class="container-fluid navbar-fixed-top">
	   
	   
	    <div class="navbar-header">
	      <a class="navbar-brand" href=".">
	        <img alt="UWE - Bristol" src="assets/img/uwe-logo.png">
	      </a>
	    </div>
              <?php if (!empty($_SESSION['user_id'])) { ?>
              <p class="navbar-text navbar-right" id="login-info">Signed in as <?php echo $_SESSION['user_fname'] . " " . $_SESSION['user_lname'];?><span class="label label-<?php echo $_SESSION['user_role'] === "student" ? "info" : ($_SESSION['user_role'] === "staff" ? "success" : "danger" );?>"><?php echo ucfirst($_SESSION['user_role']);?></span> <a href="?action=disconnect" class="navbar-link">Log out</a></p>
              <?php } ?>
                      <div class="glyphicon glyphicon-menu-hamburger" id="menu-button"></div>

          </div>
            
            
            
	</nav>	
	
        
        
	<?php if ($sidebar) {
            require_once VIEW . "sidebar.php"; 
        } ?>
        
        
	<div class="container-fluid content <?php echo $sidebar ? 'with-sidebar' : '';?>">
            
            <?php if (Conf::getDebug()){ ?>
            <div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php var_dump($_SESSION);
            echo '<br/>';
            echo $controller . " : " . $action;
            
            ?>
</div>
            <?php } ?>
            
           
            
            
            <?php if (isset($message_alert)){ ?>
            
            <div class="alert alert-<?php echo $message_alert['level'];?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong><?php echo $message_alert['title'];?> </strong> <?php echo $message_alert['message'];?>
            </div>
            
            <?php } ?>