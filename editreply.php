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
<body  style="background-image: url('images/bb3.jpg'); background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">

	<div class="row">
		<div class="col-sm-3">
		</div>
				
		<div class="col-sm-6">
			<?php
				if (isset($_GET['reply_id'])) 
				{
					$get_id=$_GET['reply_id'];
					

					$get_post="select * from reply where reply_id='$get_id'";
					$run_post = mysqli_query($con,$get_post);


					$row=mysqli_fetch_array($run_post);	
					$post_con=$row['reply'];
					$com_id=$row['comm_id'];


				}
				if (isset($_GET['com_id'])) 
				{
					$get=$_GET['com_id'];
					

					$get_post="select * from comments where com_id='$get'";
					$run_post = mysqli_query($con,$get_post);


					$row=mysqli_fetch_array($run_post);	
					$post_con=$row['comment'];
					$com_id=$row['post_id'];	

				}
				
		
			?>
			<form action="" method="post" id="f">
				<center><h2>Edit Your comment</h2></center><br>
				<textarea class="form-control" cols="83" rows="4" name="content"><?php echo $post_con;?></textarea><br>
				<input type="submit" name="update" value="Update Post" class="btn btn-info">
			</form>
			<?php
				if(isset($_POST['update']))
				{
					$content=$_POST['content'];
					if($get=="")
					{
						$update_post="update reply set reply='$content' where reply_id='$get_id'";
						$run_update=mysqli_query($con,$update_post);

						if($run_update)
						{
							echo "<script>alert('A Reply have been Updated!')</script>";
							echo "<script> window.open('replytocomment.php?com_id=$com_id','_self')</script>";
						}
					}
				
					else
					{
						$update_post="update comments set comment='$content' where com_id='$get'";
						$run_update=mysqli_query($con,$update_post);	
				
						if($run_update)
						{
							echo "<script>alert('A comment have been Updated!')</script>";
							echo "<script> window.open('single.php?post_id=$com_id','_self')</script>";
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