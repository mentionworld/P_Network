
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		
	</script>
</head>
<?php
			$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$user_id=$row['user_id'];

	$get_id=$_GET['post_id'];

	$get_com="select * from  comments where post_id='$get_id' ORDER by 1 DESC";

	$run_com=mysqli_query($con,$get_com);

	while($row= mysqli_fetch_array($run_com))
	{
		$com=$row['comment'];
		$com_name=$row['comment_author'];
		$date=$row['date'];
		$com_id=$row['com_id'];
		$uid=$row['user_id'];

				$user_posts="SELECT * from reply where comm_id='$com_id'";
					$run_posts =mysqli_query($con,$user_posts);
					$posts=mysqli_num_rows($run_posts);
		if($uid==$user_id)
		{
		echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
							<div class='panel-body'>
							<form action='' method='post'>
								<div>
									<h4><a href='profile.php?u_id=$uid'><strong>$com_name</strong></a><i>commented</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
								</div>
								<a href='r.php?comm_id=$com_id' style='float:right;'><button class='btn btn-danger' name='delete' >delete</button></a>
								<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$com_id'  name='id'></a>
								</form>
								<a href='editreply.php?com_id=$com_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
								<a href='replytocomment.php?com_id=$com_id' style='float:right;'><button class='btn btn-success'>replied<span class='badge badge-secondary'>$posts</span></button></a>
							</div>
						</div>
					</div>
				</div>
		    ";
		}
		else
		{
			echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
							<div class='panel-body'>
								<div>
									<h4><a href='profile.php?u_id=$uid'><strong>$com_name</strong></a><i>commented</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
								</div>
								<a href='replytocomment.php?com_id=$com_id' style='float:right;'><button class='btn btn-success'>reply</button></a>

							</div>
						</div>
					</div>
				</div>
		    ";
		}
	}
					if(isset($_POST['delete']))
							{
								$d=$_POST['id'];

								
								$update="delete   from  comments where  com_id='$d'";
								$run=mysqli_query($con,$update);

							}


?>
</html>