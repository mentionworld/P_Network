<!DOCTYPE html>
<?php
 session_start();
 include("include/a_header.php");

	if(!isset($_SESSION['admin_email']))
	{
		header("location:index.php");
	}
?>
<html>
<head>
	<title> mention world </title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<style >
	body
	{
		overflow-x: hidden;
	}
	#centered1
	{
		position: absolute;
		font-size: 10vw;
		top: 30%;
		left:30%;
		transform: translate(-50%,-50%);
	}
	#centered2
	{
		position: absolute;
		font-size: 10vw;
		top: 50%;
		left:40%;
		transform: translate(-50%,-50%);
	}
	#centered3
	{
		position: absolute;
		font-size: 10vw;
		top: 70%;
		left:30%;
		transform: translate(-50%,-50%);
	}
	#signup
	{
		width: 60%;
		border-radius: 30px;
	}
	#login
	{
		width: 60%;
		background-color: #fff;
		border: 1px solid #1da1f2;
		color: #1da1f2;
		border-radius: 30px;
	}
	#login:hover
	{
		width: 60%;
		background-color: #fff;
		color: #1da1f2;
		border-radius: 30px;
		border:2px solid #1da1f2;
	}
	.well
	{
		background-color: #187FAB;
	}
</style>
<body  style="background-image: url('images/bb1.jpg'); background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<center><h1 style="color: white;">WELCOME ADMIN TO MENTION WORLD </h1></center>
				
			</div>
			
		</div>
	</div>
				<div>
					
				</div>
				<div>
					
				</div>
			<div id="centered1" class="centered"><h4 style="color: white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong> Maintain Users</strong></h4>
			</div>
			<div id="centered2" class="centered"><h3 style="color: white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong> what Users suggest about feedback.</strong></h3>
			</div>
			<div id="centered3" class="centered"><h3 style="color: white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong> maintain records of website</strong></h3>
			</div>

	<div class="col-sm-6" style="left: 8%">
			<!--<img src="images/av1.png" class="img-rounded" title="mention world" width="80px" height="80px">-->
			<h2> <strong>see what's happening  <br> the site right now</strong></h2><br><br>
			<h4><strong>join mention world  today</strong></h4><br><br>
			<?php
					if(isset($_POST['signup']))
					{
						echo "<script>window.open('signup.php','_self')</script>";
					}
				?>
			<h4><strong>join mention world  today</strong></h4><br><br>
			<?php
					if(isset($_POST['signup']))
					{
						echo "<script>window.open('signup.php','_self')</script>";
					}
				?>
			<h4><strong>join mention world  today</strong></h4><br><br>
			
				
				<?php
					if(isset($_POST['signup']))
					{
						echo "<script>window.open('signup.php','_self')</script>";
					}
				?>
				
				
			
		</div>
	</div>
</div>
 </body>
</html>