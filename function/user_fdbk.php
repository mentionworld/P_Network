<?php
		

		global $con;
		$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$uid=$row['user_id'];
			
		    $rp="select * from  feedback where user_id='$uid' ORDER by 1 DESC  ";
		    $run=mysqli_query($con,$rp);
		   while( $get=mysqli_fetch_array($run))
		   {
		    $fd=$get['feedback'];
			$fdname=$get['feedback_author'];
			$date=$get['date'];
			$id=$get['fd_id'];

					$user_posts="SELECT * from reply where fd_id='$id'";
					$run_posts =mysqli_query($con,$user_posts);
					$posts=mysqli_num_rows($run_posts);
		

		echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
						
							<div class='panel-body'>
							<form action='' method='post'>
								<div>
									<h4><strong>$fdname</strong></strong><i>feedback</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$fd</p>
								</div>
								<a href='' style='float:right;'><button class='btn btn-danger' name='delete' >delete</button></a>
								<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$id'  name='id'></a>
								</form>
								<a href='edit_post.php?fd_id=$id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
								<a href='replytocomment.php?fd_id=$id' style='float:right;'><button class='btn btn-success'>replied<span class='badge badge-secondary'>$posts</span></button></a>
							</div>
							
						</div>
					</div>
				</div>
		    ";
		}
		if(isset($_POST['delete']))
							{
								$d=$_POST['id'];

								
								$update="delete   from  feedback where  fd_id='$d'";
								$run=mysqli_query($con,$update);

							}


?>