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
	<title>edit post </title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
	<div class="row">
		<div class="col-sm-3">
		</div>
				
		<div class="col-sm-6">
			<?php
				if (isset($_GET['post_id'])) 
				{
					$get_id=$_GET['post_id'];
					

					$get_post="select * from posts where post_id='$get_id'";
					$run_post = mysqli_query($con,$get_post);

					$row=mysqli_fetch_array($run_post);	
					$post_con=$row['post_content'];	

				}
				if (isset($_GET['fd_id'])) 
				{
					$fd=$_GET['fd_id'];
					
					echo"..................hello =$fd";
					$get_post="select * from feedback where fd_id='$fd'";
					$run_post = mysqli_query($con,$get_post);


					$row=mysqli_fetch_array($run_post);	
					$post_con=$row['feedback'];
					$com_id=$row['fd_id'];	

				}

			
			?>
			<form action="" method="post" id="f">
				<center><h2>Edit Your Post</h2></center><br>
				<textarea class="form-control" cols="83" rows="4" name="content"><?php echo $post_con;?></textarea><br>
				<input type="submit" name="update" value="Update Post" class="btn btn-info">
			</form>
			<?php
				if(isset($_POST['update']))
				{	
					$content=$_POST['content'];

					if($get_id=="")
					{
						echo"........................geueufendfkj";
						$update_post="update feedback set feedback='$content' where fd_id='$fd'";
						$run_update=mysqli_query($con,$update_post);
						if($run_update)
						{
							echo "<script>alert('A feedback have been Updated!')</script>";
							echo "<script> window.open('home.php','_self')</script>";
						}
					}
					else
					{
						$update_post="update posts set post_content='$content' where post_id='$get_id'";
						$run_update=mysqli_query($con,$update_post);
						if($run_update)
						{
							echo "<script>alert('A Post have been Updated!')</script>";
							echo "<script> window.open('home.php','_self')</script>";
						}
					}
				}
			?>
		</div>
		<div class="col-sm-3">
			
		</div>
	</div>
</body>
</html>