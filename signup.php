<!DOCTYPE html>
<html>
<head>
	<title>signup</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.
  /bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function validate1()
	{
		
		var n1=document.myform.fn.value;
		var n2=document.myform.ln.value;
		var n3=document.myform.e.value;
		//var n4=document.myform.fn.value;
		//var n5=document.myform.fn.value;
		//var n6=document.myform.fn.value;

		alert("name"+n1+"lname"+n2);

		if(!isNaN(n1))
		{
			alert(" fisrt name must be String");
			document.getElementById('fn').focus();
			return false;
		}
		
	
		 if(!isNaN(n2))
		{
			alert(" last name must be String");
			document.getElementById('ln').focus();
			return false;
		}
			
		
	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(n3))
	{
		return true;
	}	
	else
	{
	alert("please enter valid email");
	document.getElementById('e').focus();
	return false
	}
	}

</script>
 

</head>
<style>
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
		border: 2px solid #e6e6e6;
		padding: 40px 30px;
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
				<center><h1 style="color: white;">mention world</h1></center>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="main-content">
				<div class="header">
					<h3 style="text-align: center;"><strong> Join mention world</strong></h3><hr>
				</div>
				<div class="l-part">
					<form  name="myform" action="" method="post" onsubmit="return validate1()">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<input type="text" class="form-control" placeholder="first name"  id="fn" name="first_name" required="required" >
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<input type="text" class="form-control" placeholder="last name" id="ln" name="last_name" required="required">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password"  type="password" class="form-control" placeholder="password"  id="p" name="u_pass" required="required">
						</div><br>
						<div class="input-group">
							<span id="email" class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control" placeholder="abc@gmail.com" id="e" name="u_email" required="required">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
							<select class="form-control" name="u_country" required="required">
								<option disabled> Select your Country</option>
								<option> India</option>
								<option> Nepal</option>
								<option> Pakistan</option>
								<option> USA</option>
								<option> UK</option>
								<option> France</option>
								<option> Germany</option>
							</select>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
							<select class="form-control  input-md" name="u_gender" required="required">
								<option disabled> Select your Gender</option>
								<option> Male</option>
								<option> Female</option>
								<option> Others</option>
							</select>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="date" class="form-control input-md" placeholder="dd/mm/yy" name="u_birthday"required="required">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
							<select class="form-control" name="r_Question" required="required">
								<option value="A">What is your best friend name?</option>
								<option value="B"> Who is your loved one?</option>
								<option value="C"> Where  is your favourite Destination?</option>
	
							</select>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="r_answer"  type="password" class="form-control" placeholder="answered above Question" name="r_answer" required="required">
						</div><br>
						<a style="text-decoration: none; float: right;color: #187FAB;" data-toggle="tooltip" title="signin" href="signin.php"> Already have an Account?</a><br><br>
						<center> <button id="signup" class="btn btn-info btn-lg" name="sign_up"> Signup</button></center>
						<?php
				//		include("insert_user.php");
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>