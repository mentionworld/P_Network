<!DOCTYPE html>

<html>
<head>
	
	<title>Forgotten Password</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style >
	body
	{
		overflow-x:hidden; 
	}
	.main-content
	{
		width: 50%;
		height: 40%;
		margin: 10px auto;
		background-color: #fff;
		border:2px solid #e6e6e6;
		padding: 40px 50px;
	}
	.header
	{
		border:0px solid #000;
		margin-bottom: 5px;
	}
	.well
	{
		background-color: #187FAB;
	}
	#signup
	{
		width: 60%;
		border-radius: 30px;
	}
</style>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<center><h1 style="color: white;"><strong>Mention World</strong></h1></center>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="main-content">
				<div class="header">
					<h3 style="text-align: center;"><strong>Forgot Password</strong></h3>
				</div>
				<div class="l_pass">
					<form action="" method="post">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="email" type="email" name="email"  class="form-control" placeholder="Enter your Email" required>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
							<select class="form-control" name="r_Question" required="required">
								<option value="A">What is your best friend name?</option>
								<option value="B"> Who is your loved one?</option>
								<option value="C"> Where  is your favourite Destination?</option>
								<!--<option> USA</option>
								<option> UK</option>
								<option> France</option>
								<option> Germany</option>-->
							</select>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<input  id="msg"  type="text" class="form-control" placeholder="Someone" name="recovery_account"  required>
						</div><br>
						<a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Signin" href="signin.php">Back to Signin?</a><br><br>
						<center><button id="signup" class="btn btn-info btn-lg" name="submit">Submit</button></center>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php
session_start();

include ("include/connection.php");
	if (isset($_POST['submit']))
	 {
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));

		$recovery_account= htmlentities(mysqli_real_escape_string($con,$_POST['recovery_account']));
		$r_question=htmlentities(mysqli_real_escape_string($con,$_POST['r_Question']));

		$select_user = "select * from users where user_email='$email' AND recovery_account='$recovery_account' AND recovey_Q='$r_question'";
		$query = mysqli_query($con,$select_user);
		$check_user = mysqli_num_rows($query);

		if ($check_user == 1) 
		{
			$_SESSION['user_email']=$email;
			echo"<script>window.open('change_password.php','_self')</script>";
		}
		else
		{
			echo"<script>alert('Something is incorrect')</script>";
		}
		
	}
?>
