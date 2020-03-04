

<!DOCTYPE html>
<?php
 session_start();
 include("include/header_ad.php");

	if(!isset($_SESSION['admin_email']))
	{
		header("location:index.php");
	}
?>
<?php
include("include/connection.php");
?>
<html>
<head>
	<title>View Your Post</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>

<div class="row">

		
		<div class="col-sm-12">
			<center><h2><strong>User Feedback</strong></h2><br></center>
			<?php
			global $con;

				$get_com="select * from  feedback ORDER by 1 DESC ";


				$run_com=mysqli_query($con,$get_com);

				while($row= mysqli_fetch_array($run_com))
				{	
					$id=$row['user_id'];
					$com=$row['feedback'];
					$com_name=$row['feedback_author'];
					$date=$row['date'];
					$fd=$row['fd_id'];
				
				$get_user="select * from users where user_id='$id'";
				$row=mysqli_query($con,$get_user);
				while($get=mysqli_fetch_array($row))
				{
					$u_name=$get['f_name'];
					$u_img=$get['user_image'];
				}

					echo"
					
						<div class='row'>
					       <div class='col-md-8 col-md-offset-2'>
						     <div class='panel panel-info'>
						     	<div class='panel-body'>
								<div>
									<h4><img src='users/$u_img' class='img-circle' width='50px' height='40px'><strong>$u_name</strong<i>feedback </i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
								</div>
								<a href='reply.php?fd_id=$fd' style='float:right;'><button class='btn btn-success'>reply</button></a>

								<a href='function/delete_post.php?fd_id=$fd' style='float:right;'><button class='btn btn-danger'>Delete</button></a>

							</div>
						</div>
					</div>
				</div>

					
					    ";
				}

			?>
		</div>
		
	</div>
	</html>

