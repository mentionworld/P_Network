<!DOCTYPE html>
<?php
 session_start();
 include("include/header.php");

	if(!isset($_SESSION['user_email']))
	{
		header("location:index.php");
	}
?>
<html>
<head>
	
	<title>Edit Account Setting</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">


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
<body  style="background-image: url('images/bb3.jpg'); background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">

	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<form action="" method="post" enctype="multipart/form-data" onsubmit="return validate1()">
				<table class="table table-bordered table-hover">
					<tr align="center"> 
						<td colspan="6" class="active"><h2>Edit Your Profile</h2></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change Your Firstname</td>
						<td>
							<input  class="form-control" type="text"  id="fn" name="f_name" required value="<?php echo $first_name;?>">
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change Your Lastname</td>
						<td>
							<input  class="form-control" type="text" id="ln" name="l_name" required value="<?php echo $last_name;?>">
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change Your Username</td>
						<td>
							<input  class="form-control" type="text" name="u_name" required value="<?php echo $user_name;?>">
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Description</td>
						<td>
							<input  class="form-control" type="text" name="describe_user" required value="<?php echo $describe_user;?>">
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Relationship Status</td>
						<td>
							<select class="form-control" name="Relationship">
								<option><?php echo $Relationship_status; ?></option>
								<option>Engaged</option>
								<option>Married</option>
								<option>Single</option>
								<option>In a Relationship</option>
								<option>It's Complicated</option>
								<option>Separated</option>
								<option>NOt Interested in Relationship</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Password</td>
						<td>
							<input  class="form-control" type="Password" name="u_pass"  id=" mypass" required value="<?php echo $user_pass;?>">
							<input type="checkbox"  onclick="show_password()" ><strong>Show Password</strong>
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Email</td>
						<td>
							<input  class="form-control" type="email" name="u_email" required value="<?php echo $user_email;?>">
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Country</td>
						<td>
							<select class="form-control" name="u_country">
								<option><?php echo $user_country; ?></option>
								<option>United State</option>
								<option>UAE</option>
								<option>JAPAN</option>
								<option>KUWAIT</option>
								<option>CANADA</option>
								<option>RUSSIA</option>
								<option>SPAN</option>
								<option>INDIA</option>
								<option>NEPAL</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Gender</td>
						<td>
							<select class="form-control" name="u_gender">
								<option><?php echo $user_gender; ?></option>
								<option>Male</option>
								<option>Female</option>
								<option>Other</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Birthdate</td>
						<td>
							<input  class="form-control input-md" type="date" name="u_birthday" required value="<?php echo $user_birthday;?>">
						</td>
					</tr>
					<!-- recover password option-->
					<tr>
						<td style="font-weight: bold;">Forgotten Password</td>
						<td>
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Turn On</button>

							<div id="myModal" class="modal fade" role="dailog">
								<div class="modal-dailog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											
										</div>
										<div class="modal-body">
											<form action="recovery.php?id=<?php echo $user_id;?>" method="post" id="f">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
													<select class="form-control" name="r_Question" required="required">
														<option value="A">What is your best friend name?</option>
														<option value="B"> Who is your loved one?</option>
														<option value="C"> Where  is your favourite Destination?</option>
													</select>
												</div><br>
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
													<input  id="msg"  type="text" class="form-control" placeholder="Someone" name="recovery_account" >
												</div>
												<input class="btn btn-info" type="submit" name="sub" value="Submit" style="width: 10%;
		                                              border-radius: 30px;"><br><br>
											</form>
											<?php
												if(isset($_POST['sub']))
												{
													$bfn=htmlentities($_POST['recovery_account']);
													$qts=htmlentities($_POST['r_Question']);

													if($bfn=="")
													{
														echo"<script>alert('please enter something') </script>";
														echo"<script>window.open('edit_profile.php?u_id=$user-id','_self')</script>";
														exit();
													}
													else
													{
														$update="update users set recovery_account='$bfn', recovey_Q='$qts' where user_id='$user_id'";
														$run=mysqli_query($con,$update);

														if($run)
														{
															echo"<script>alert('working.....')</script>";
															echo"<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
														}
														else
														{
															echo"<script>alert('Error while Updating information')</script>";
															echo"<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
														}
													}
												}
											?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
					<tr align="center">
						<td colspan="6">
							<input  type="submit" class="btn btn-info" name="update" style="width: 250px;border-radius: 30px;" value="Update">
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="col-sm-2">
		</div>
	</div>
</body>
</html>
<?php
	if(isset($_POST['update']))
	{
		$f_name=htmlentities($_POST['f_name']);
		$l_name=htmlentities($_POST['l_name']);
		$u_name=htmlentities($_POST['u_name']);
		$describe_user=htmlentities($_POST['describe_user']);
		$Relationship_status=htmlentities($_POST['Relationship']);
		$u_pass=htmlentities($_POST['u_pass']);
		$u_email=htmlentities($_POST['u_email']);
		$u_country=htmlentities($_POST['u_country']);
		$u_gender=htmlentities($_POST['u_gender']);
		$u_birthday=htmlentities($_POST['u_birthday']);

		$update="update users set f_name='$f_name',l_name='$l_name',user_name='$u_name',describe_user='$describe_user',Relationship='$Relationship_status',
		user_pass='$u_pass',user_email='$u_email',user_country='$u_country',user_gender='$u_gender',user_birthday='$u_birthday' where user_id='$user_id'";

		$run=mysqli_query($con,$update);

		if($run)
		{
			echo"<script>alert('Your Profile  Updated')</script>";
			echo"<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
		}
		else
		{
			echo"<script>alert('..................................................die')</script>";
		}

	}
?>