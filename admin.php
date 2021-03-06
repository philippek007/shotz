<?php require("login.php"); ?>
<?php

include("functions.php");

$link = file_get_contents('storage/shot.json');


?>
<!DOCTYPE html>
<html><head>
<title><?php echo "".$LANG["softwarename"]. " ".$LANG["softwareversion"]."";?></title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="openlab3" >

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="css/shotz.css" media="all" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
 <link rel="icon" href="favicon.ico" type="image/ico" sizes="64x64"> 



      
</head>
<body><a id="top-of-page"></a>

   <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Shotz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><i class="fa fa-tasks"></i> Home</a></li>
            <li><a href="finished.php"><i class="fa fa-check-square-o"></i> Finished</a></li>
            <li><a href="stats.php"><i class="fa fa-bar-chart"></i> Stats</a></li>            
            <li class="active"><a href="admin.php"><i class="fa fa-cogs"></i> Admin</a></li>
            <li><a href="trash.php"><i class="fa fa-trash-o"></i> Trash</a></li>
           
 
 <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img-circle" style="margin-top: -15px;margin-bottom: -15px;" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['ls_email']))); ?>?size=32" alt=""> <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="edit_profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
 <li class="divider"></li> 
<li><a href="<?php $_SERVER['PHP_SELF']; ?>?ls_logout" rel=""><i class="fa fa-sign-out"></i> Logout</a></li>
</ul>
</li>


          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    

<div class="container-fluid">    
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	      <div class="page-header">
				<h1><?php echo "".$LANG["admintitle"]."";?></h1>    
      	</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
			<button type="button" class="center-block btn btn-default btn-lg artistsadmin" data-toggle="modal" data-target="#usersModal">
				<i class="fa fa-users fa-4x"></i>
				<h2><?php echo "".$LANG["usersadmin"]."";?></h2>
			</button>


<!-- Modal -->
<div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="userModalLabel">EDIT <?php echo "".$LANG["users"]."";?></h3>
        <h5><small><i class="fa fa-info-circle"></i> One name per line and no empty lines.</small></h5>
      </div>
      <div class="modal-body">

<?php
$usersmyfile = "storage/users.txt";
if (isset($_POST['usersta'])) {
    $usersnewData = nl2br(htmlspecialchars($_POST['usersta']));
    $usershandle = fopen($usersmyfile, "w");
    fwrite($usershandle, $usersnewData);
    fclose($usershandle);
}
// ------------------------------------------------
if (file_exists($usersmyfile)) {

    $usersmyData = file_get_contents($usersmyfile);
}
?>


<form action="admin.php" method="post">
<textarea class="form-control" name="usersta" id="userstextareaediting" rows="10">
<?php echo str_replace("<br />","",$usersmyData); ?>
</textarea>


      </div>
      <div class="modal-footer">
      
    		<button type="submit" name="usersBtn" class="btn btn-primary">Submit</button>
      </form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>


		</div>

		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
		
			<button type="button" class="center-block btn btn-default btn-lg tasksadmin" data-toggle="modal" data-target="#taskModal">
				<i class="fa fa-wrench fa-4x"></i>
				<h2><?php echo "".$LANG["tasksadmin"]."";?></h2>
			</button>


<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="taskModalLabel">EDIT <?php echo "".$LANG["task"]."";?></h3>
        <h5><small><i class="fa fa-info-circle"></i> One task per line and no empty lines.</small></h5>
      </div>
      <div class="modal-body">

<?php
$taskmyfile = "storage/tasks.txt";
if (isset($_POST['taskta'])) {
    $tasknewData = nl2br(htmlspecialchars($_POST['taskta']));
    $taskhandle = fopen($taskmyfile, "w");
    fwrite($taskhandle, $tasknewData);
    fclose($taskhandle);
}
// ------------------------------------------------
if (file_exists($taskmyfile)) {

    $taskmyData = file_get_contents($taskmyfile);
}
?>


<form action="admin.php" method="post">
<textarea class="form-control" name="taskta" id="tasktextareaediting" rows="10">
<?php echo str_replace("<br />","",$taskmyData); ?>
</textarea>



      </div>
      <div class="modal-footer">
          		<button type="submit" name="taskBtn" class="btn btn-primary">Submit</button>
          		</form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>



	</div>
			<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
				<button type="button" class="center-block btn btn-default btn-lg statusesadmin" data-toggle="modal" data-target="#statuseModal">
				<i class="fa fa-cogs fa-4x"></i>
				<h2><?php echo "".$LANG["statusesadmin"]."";?></h2>
				</button>


<!-- Modal -->
<div class="modal fade" id="statuseModal" tabindex="-1" role="dialog" aria-labelledby="statuseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="statuseModalLabel">EDIT <?php echo "".$LANG["statuse"]."";?></h3>
        <h5><small><i class="fa fa-info-circle"></i> One status per line and no empty lines.</small></h5>
      </div>
      <div class="modal-body">

<?php
$statusmyfile = "storage/statuses.txt";
if (isset($_POST['statusta'])) {
    $statusnewData = nl2br(htmlspecialchars($_POST['statusta']));
    $statushandle = fopen($statusmyfile, "w");
    fwrite($statushandle, $statusnewData);
    fclose($statushandle);
}
// ------------------------------------------------
if (file_exists($statusmyfile)) {

    $statusmyData = file_get_contents($statusmyfile);
}
?>


<form action="admin.php" method="post">
<textarea class="form-control" name="statusta" id="statustextareaediting" rows="10">
<?php echo str_replace("<br />","",$statusmyData); ?>
</textarea>


      </div>
      <div class="modal-footer">
      
     		<button type="submit" name="statusBtn" class="btn btn-primary">Submit</button>
     		</form>
                		
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>






</div>


			<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">

				<a  href="<?php echo $_SERVER['PHP_SELF'] ?>?ls_register"  type="button" class="center-block btn btn-default btn-lg loginsadmin">
				<i class="fa fa-key fa-4x"></i>
				<h2>Logins</h2>
				</a>

			</div>
</div>


</div>


</div>
<?php include 'footer.php';?>




