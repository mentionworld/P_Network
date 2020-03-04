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
	

	<title>Messages</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style >
#scroll_messages
{
	max-height: 400px;
	overflow: scroll;

}
#btn-msg
{
	width: 20%;
	height: 28px;
	border-radius: 5px;
	margin: 5px;
	border:none;
	color: #fff;
	float: right;
	background-color: #2ecc71;
}
#select_user
{
	max-height: 500px;
	overflow: scroll;
}
#green
{
	width: 45%;
	padding: 2.5px;
	border-color: #27ae60;
	border-radius: 3px;
	margin-bottom: 5px;
	font-size: 16px;
	float: left;
	background-color: #2ecc71;
}
#blue
{
	width: 45%;
	padding: 2.5px;
	border-color: #2980b9;
	border-radius: 3px;
	margin-bottom: 5px;
	font-size: 16px;
	float: right;
	background-color: #3498db;	
}
#own_post
{
	border:5px solid #e6e6e6;
	padding: 30px 10px;
	width: 130%;
}

</style><body  style="background-image: url('images/bb3.jpg'); background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">

	<div class="row">

		
		
		<div class="col-sm-3" >
			<div>
				<div>
					<strong><center><h2> Friends</h2></center></strong>
				</div>
			</div>
		

			<?php
				global $con;

				$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$id=$row['user_id'];

				$user="select * from friend where user_from='$id' OR user_to='$id'";
				$run_user=mysqli_query($con,$user);

				while($row_user=mysqli_fetch_array($run_user))
				{
					$user_id=$row_user['user_to'];
					$user_from=$row_user['user_from'];
					$status=$row_user['status'];



					$frd="select * from users where user_id='$user_id'";
					$run_frd=mysqli_query($con,$frd);
					while($row_frd=mysqli_fetch_array($run_frd))
					{
							$user_name=$row_frd['user_name'];
							$f_name=$row_frd['f_name'];
							$l_name=$row_frd['l_name'];
							$user_image=$row_frd['user_image'];

							if($status==2 && $id!=$user_id)
							{
							echo
							"
								<div class='container-fluid'>
									<a  style='text-decoration: none;cursor: pointer;color: #3897f0;'  href='user_profile.php?u_id=$user_id'>
										<img  class='img-circle' src='users/$user_image' width='90px' height='80px' title='$user_name'>
										<strong>&nbsp $f_name  $l_name</strong><br><br>
									</a>
								</div>
							";

							}
							
						}
					}
			?>
		</div>
		<div class="col-sm-5">
			
		</div>
		<div class="col-sm-3" >
			<div>
				<div>
					<strong><center><h2> Friend Request</h2></center></strong>
				</div>
			</div>
			<?php
				global $con;

			$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$id=$row['user_id'];

			$user="select * from friend where user_to='$id'";
			$run_user=mysqli_query($con,$user);

			while($row_user=mysqli_fetch_array($run_user))
				{
					$user_id=$row_user['user_from'];
					$user_from=$row_user['user_from'];
					$status=$row_user['status'];


					$frd="select * from users where user_id='$user_id'";
					$run_frd=mysqli_query($con,$frd);
					while($row_frd=mysqli_fetch_array($run_frd))
					{
							$user_name=$row_frd['user_name'];
							$f_name=$row_frd['f_name'];
							$l_name=$row_frd['l_name'];
							$user_image=$row_frd['user_image'];

							if($status==1)
							{
							
								echo"
									<div id='own_post'>
									<div class='row'>
										<form action='' method='post'>
										<div class='col-sm-12'>
											<a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'><img src='users/$user_image' class='img-circle' width='50px' height='50px'>
											<strong>&nbsp $f_name  $l_name</a></strong>
										</a>
										</div>
									</div>
									<a   style='color:#3897f0; float:right;' ><button  id='$user_id' onClick='get_id(this.id)' class='btn btn-danger' name='Reject' >Reject</button></a>
									<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$user_id'  name='id'></a>
									

									<a   style='color:#3897f0; float: right;' ><button   class='btn btn-info' name='Accept' >Accept</button></a>
									<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$user_id'  name='id'></a>
								</form>
								</div>
								";
							}
						}
					}
					
							if(isset($_POST['Reject']))
							{
								$d=$_POST['id'];
								$update="delete   from  friend where  user_from='$d' AND user_to='$id'";
								$run=mysqli_query($con,$update);
								if($run_insert)
						{		
							echo "<script>window.open('add_friend.php','_self');</script>";
						}

							}
							if(isset($_POST['Accept']))
							{
								$d=$_POST['id'];
		
								$update="update friend set a_date=NOW(),status=2 where user_to='$id'";
								$run=mysqli_query($con,$update);

								if($run_insert)
						{		
							echo "<script>window.open('add_friend.php','_self');</script>";
						}

							}
			?>
		</div>
	</div>
</body>
</html>
