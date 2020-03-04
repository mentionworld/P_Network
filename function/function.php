<?php

$con=mysqli_connect("localhost","root","","p_network") or die("didn't connection established");

	// function for inserting post

	function insertPost()
	{
		if (isset($_POST['sub']))
		 {
			global $con;
			global $user_id;

			$content =htmlentities($_POST['content']);
			$upload_image =$_FILES['upload_image']['name'];
			$image_tmp=$_FILES['upload_image']['tmp_name'];
			$random_number=rand(1, 100);

			if(strlen($content)>250)
			{
				echo "<script>alert('Please Use 250 or Less than 250 words!')</script>";
				echo "<script> window.open('home.php','_self')</script>";
			}
			else
			{
				if (strlen($upload_image)>=1 && strlen($content)>=1) 
				{
					move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
					$insert="insert into posts (user_id,post_content,upload_image,post_date) values('$user_id','$content',
					'$upload_image.$random_number',NOW())";

					$run = mysqli_query($con,$insert);

					if($run)
					{
						echo "<script>alert('Your Post  Updated a moment ago!')</script>";
						echo "<script> window.open('home.php','_self')</script>";

						$update="update users set posts='yes' where user_id='$user_id'";
						$run_update=mysqli_query($con,$update);
					}
					exit();
				}
				else
				{
					if($upload_image=='' && $content=='')
					{
						echo "<script>alert('Error Occured while uploading!')</script>";
						echo "<script> window.open('home.php','_self')</script>";
					}
					else
					{
						if($content=='')
						{
							move_uploaded_file($image_tmp,"imagepost/$upload_image.$random_number");

							$insert="insert into posts (user_id,post_content,upload_image,post_date) values('$user_id','No','$upload_image.$random_number',NOW())";

							$run = mysqli_query($con,$insert);

							if($run)
							{
								echo "<script>alert('Your Post  Updated a moment ago!')</script>";
								echo "<script> window.open('home.php','_self')</script>";

								$update="update users set posts='yes' where user_id='$user_id'";
								$run_update=mysqli_query($con,$update);
							}
								exit();
						}
						else
						{
							$insert="insert into posts (user_id,post_content,upload_image,post_date) values('$user_id','$content','',NOW())";

							$run = mysqli_query($con,$insert);

							if($run)
							{
								echo "<script>alert('Your Post  Updated a moment ago!')</script>";
								echo "<script> window.open('home.php','_self')</script>";

								$update="update users set posts='yes' where user_id='$user_id'";
								$run_update=mysqli_query($con,$update);
							}
						}
					}
				}
			}
		} 

	}
	function get_posts()
	{
		global $con;
		$per_page=4;

		if(isset($_GET['page']))
		{
			$page=$_GET['page'];
		}
		else
		{
			$page=1;
		}
		$start_from=($page-1)*$per_page;

		$get_posts="select * from posts ORDER by 1 DESC LIMIT $start_from,$per_page";

		$r_posts =mysqli_query($con,$get_posts);

		while($run_posts= mysqli_fetch_array($r_posts))
		{
			$post_id=$run_posts['post_id'];
			$user_id=$run_posts['user_id'];
			$content= substr($run_posts['post_content'],0,40);
			$upload_image=$run_posts['upload_image'];
			$post_date=$run_posts['post_date'];

			$user="select * from users where user_id='$user_id' AND posts='yes'";
			$run_user=mysqli_query($con,$user);
			$row_user =mysqli_fetch_array($run_user);

			$user_name=$row_user['user_name'];
			$user_image =$row_user['user_image'];

			$user_posts="SELECT * from comments where post_id='$post_id'";
					$run_posts =mysqli_query($con,$user_posts);
					$posts=mysqli_num_rows($run_posts);

			//now displaying posts from database

			if($content=="No" && strlen($upload_image)>=1)
			{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6' style='background-color:#dbe6f4;'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp&nbsp$user_name</a></h3>

									<h4><small style='color:black;'>&nbsp &nbspUpdated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment<span class='badge badge-secondary'>$posts</span></button></a><br>
						</div>
						
					</div><br>
				";
			}
			else if(strlen($content)>=1 && strlen($upload_image)>=1)
			{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6' style='background-color:#dbe6f4;'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp&nbsp$user_name</a></h3>

									<h4><small style='color:black;'>&nbsp&nbsp Updated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<p>$content</p>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment<span class='badge badge-secondary'>$posts</span></button></a><br>
						</div>
					</div><br>
				";
			}
			else
			{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6' style='background-color:#dbe6f4;'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp&nbsp$user_name</a></h3>

									<h4><small style='color:black;'>&nbsp&nbsp Updated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment<span class='badge badge-secondary'>$posts</span></button></a><br>
						</div>
						
					</div><br>
				";
			}
		}
		include("pagination.php");
	}

	function single_post()
	{
		if(isset($_GET['post_id']))
		{
			global $con;

			$get_id=$_GET['post_id'];

		
			$get_posts = "select * from posts where post_id='$get_id'";
			$run_posts=mysqli_query($con,$get_posts);
			$row_posts = mysqli_fetch_array($run_posts);

			$post_id=$row_posts['post_id'];
			$user_id=$row_posts['user_id'];
			$content=$row_posts['post_content'];
			$upload_image=$row_posts['upload_image'];
			$post_date=$row_posts['post_date'];
			
			$user="select * from users where user_id='$user_id' AND posts='yes'";
			$run_user=mysqli_query($con,$user);

			$row_user=mysqli_fetch_array($run_user);

			$user_name=$row_user['user_name'];
			$user_image=$row_user['user_image'];

			$user_com=$_SESSION['user_email'];
			$get_com="select * from users where user_email='$user_com'";

			$run_com=mysqli_query($con,$get_com);
			$row_com=mysqli_fetch_array($run_com);

			$user_com_id=$row_com['user_id'];
			$user_com_name=$row_com['user_name'];

			if(isset($_GET['post_id']))
			{
				$post_id=$_GET['post_id'];
			}
			$get_posts="select post_id from users  where post_id='$post_id'";
			$run_user=mysqli_query($con,$get_posts);
			

			$post_id=$_GET['post_id'];
			$post=$_GET['post_id'];


			$get_user="select * from posts  where post_id='$post'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
			
			$p_id=$row['post_id'];

			if($p_id!=$post_id)
			{
				echo" <script> alert('ERROR')</script>";
				echo "<script>window.open('home.php','_self'</script>";
			}
			else
			{
				if($content=="No" && strlen($upload_image)>=1)
					{
					echo "
	
							<div class='row'>
							<div class='col-sm-3'>
							</div>	
							<div id='posts' class='col-sm-6'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

										<h4><small style='color:black;'> &nbspUpdated a post on<strong>$post_date</strong> </small></h4>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
				";
				 }
				else if(strlen($content)>=1 && strlen($upload_image)>=1)
			{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

									<h4><small style='color:black;'>&nbsp Updated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<p>$content</p>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
				";
			}
			else
			{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

									<h4><small style='color:black;'>&nbsp Updated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
				";
			}
			//else condtion ending

			include("function/commnets.php");

			echo"
			<div class='row'>
				<div class='col-md-6 col-md-offset-3'>
					<div class='panel panel-info'>
						<div class='panel-body'>
							<form action='' method='post' class='form-inline'>
								<textarea placeholder='Write Your Comment here!' class='pb-cmnt-textarea' name='comment'></textarea>
								<button class='btn btn-info pull-right' name='reply'>Comment</button>
							</from>
						</div>
					</div>
				</div>
			</div>
			";

				if(isset($_POST['reply']))
				{
					$comment = htmlentities($_POST['comment']);

					if($comment=="")
					{
						echo"<script> alert('Enter your comment!')</script>";
						echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
					}
					else
					{

						$insert="insert into comments(post_id,user_id,comment,comment_author,date)values('$post_id','$user_id','$comment' ,'$user_com_name',NOW())";

						$run=mysqli_query($con,$insert);
						if($run)
						{
						echo" <script> alert('Your Comment Added!')</script>";
						echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
						}
					}
				}

			}
		}
	}

	function user_posts()
	{
		global $con;

		if(isset($_GET['u_id']))
		{
			$u_id=$_GET['u_id'];
		}

		$get_posts="select * from posts where user_id='$u_id' ORDER by 1 DESC ";
		$run_posts=mysqli_query($con,$get_posts);

		while($row_posts=mysqli_fetch_array($run_posts))
		{
			$post_id=$row_posts['post_id'];
			$user_id=$row_posts['user_id'];
			$content=$row_posts['post_content'];
			$upload_image=$row_posts['upload_image'];
			$post_date=$row_posts['post_date'];

			$user="select * from users where user_id='$user_id'  AND posts='yes'";

			$run_user=mysqli_query($con,$user);
			$row_user=mysqli_fetch_array($run_user);

			$user_name=$row_user['user_name'];
			$user_image=$row_user['user_image'];

			if(isset($_GET['u_id']))
			{
				$u_id=$_GET['u_id'];
			}

			$getuser="select user_email from users where user_id='$u_id'";
			$run_user=mysqli_query($con,$getuser);
			$row=mysqli_fetch_array($run_user);

			$user_email=$row['user_email'];

			$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$user_id=$row['user_id'];
			$u_email=$row['user_email'];

			if($u_email!=$user_email)
			{
				echo"<script>window.open('my_post.php?u_id=$user_id','_self')</script>";
			}
			else
			{
				if($content=="No" && strlen($upload_image)>=1)
					{
					echo "
	
							<div class='row'>
							<div class='col-sm-3'>
							</div>	
							<div id='posts' class='col-sm-6'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

										<h4><small style='color:black;'> &nbspUpdated a post on<strong>$post_date</strong> </small></h4>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>

								<a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
								<a href='function/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
						</div>
						<div class='col-sm-3'>
						</div>
						</div><br><br>
					";
				 }
				else if(strlen($content)>=1 && strlen($upload_image)>=1)
				{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

									<h4><small style='color:black;'>&nbsp Updated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<p>$content</p>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>

								<a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
								<a href='function/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
				";
				}
				else
				{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

									<h4><small style='color:black;'>&nbsp Updated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>

								<a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
								<a href='function/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";	
				}
			}
		}
	}

	function results()
	{
		global $con;
		if(isset($_GET['search']))
		{
			$search_query=htmlentities(($_GET['user_query']));

		}

		$get_posts="select * from posts where post_content like '%$search_query%' OR  upload_image like '%$search_query%'";
		$run_posts=mysqli_query($con,$get_posts);

		while($row_posts=mysqli_fetch_array($run_posts))
		{
			$post_id=$row_posts['post_id'];
			$user_id=$row_posts['user_id'];
			$content=$row_posts['post_content'];

			$upload_image=$row_posts['upload_image'];
			$post_date=$row_posts['post_date'];

			$user="select * from users where user_id='$user_id' AND posts='yes'";

			$run_users=mysqli_query($con,$user);
			
			$row_user=mysqli_fetch_array($run_users);

			$user_name=$row_user['user_name'];
			$first_name=$row_user['f_name'];
			$last_name=$row_user['l_name'];
			$user_image=$row_user['user_image'];



			//display the posts

				if($content=="No" && strlen($upload_image)>=1)
					{
					echo "
	
							<div class='row'>
							<div class='col-sm-3'>
							</div>	
							<div id='posts' class='col-sm-6'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

										<h4><small style='color:black;'>&nbsp Updated a post on<strong>$post_date</strong> </small></h4>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							
						</div>
						<div class='col-sm-3'>
						</div>
						</div><br><br>
					";
				 }
				else if(strlen($content)>=1 && strlen($upload_image)>=1)
				{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

									<h4><small style='color:black;'> &nbspUpdated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<p>$content</p>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
				";
				}
				else
				{
				echo "

					<div class='row'>
						<div class='col-sm-3'>
						</div>	
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>&nbsp$user_name</a></h3>

									<h4><small style='color:black;'>&nbsp Updated a post on<strong>$post_date</strong> </small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";	
				}
		}

	}

	function search_user()
	{
		global $con;

			$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$id=$row['user_id'];
			

		if(isset($_GET['search_user_btn']))
		{
			$search_query= htmlentities($_GET['search_user']);
			$get_user="select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%$search_query%' ";
		}
		else
		{
			$get_user="select * from users";
		}

		$run_user=mysqli_query($con,$get_user);

		while($row_user=mysqli_fetch_array($run_user))
		{
			$user_id=$row_user['user_id'];
			$f_name=$row_user['f_name'];
			$l_name=$row_user['l_name'];
			$username=$row_user['user_name'];
			$user_image=$row_user['user_image'];
			
			if($id==$user_id)
			{
			echo 
				"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div class='col-sm-6'>
							<div class='row' id='find_people'>
								<div class='col-sm-4'>
									<a href='user_profile.php?u_id=$user_id'>
									<img src='users/$user_image' width='150px' height='140px' title='$username' style='float:left; , margin: 1px;'/>
									</a>
								</div><br><br>
								<div class='col-sm-6'>
									<a  style='text-decoration:none; cursor:pointer;color:#3897f0;'    href='user_profile.php?u_id=$user_id'>
									<strong><h2>$f_name  $l_name</h2></strong>
									</a>
								</div>
								<div class='col-sm-3'>
								</div>
							</div>
						</div>
						<div class='col-sm-4'>
						</div>
					</div><br>
				";
			}
			else
			{
				$user="select * from friend where user_from='$id'";
				$run=mysqli_query($con,$user);
				
				while($row=mysqli_fetch_array($run))
				{
					$status=$row['status'];
					$fid=$row['user_from'];
					$tid=$row['user_to'];
					if($status==2 && $tid==$user_id)
					{
						echo 
								"
									<div class='row'>
										<div class='col-sm-3'>
										</div>
										<div class='col-sm-6'>
											<div class='row' id='find_people'>
												<div class='col-sm-4'>
													<a href='user_profile.php?u_id=$user_id'>
													<img src='users/$user_image' width='150px' height='140px' title='$username' style='float:left; , margin: 1px;'/>
													</a>
												</div><br><br>
												<div class='col-sm-6'>
													<a  style='text-decoration:none; cursor:pointer;color:#3897f0;'    href='user_profile.php?u_id=$user_id'>
													<strong><h2>$f_name  $l_name</h2></strong>
													</a>
												</div>
												<div class='col-sm-3'>
												</div>
												<a   style='color:#3897f0; float: right;' ><button   class='btn btn-info' name='Accept' >Friend</button></a>
														<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$user_id'  name='id'></a>
											</div>
										</div>
										<div class='col-sm-4'>
										</div>
									</div><br>
								";
					}
					if($status==1 && $tid==$user_id)
					{
							echo 
									"
										<div class='row'>
											<div class='col-sm-3'>
											</div>
											<div class='col-sm-6'>
												<div class='row' id='find_people'>
													<div class='col-sm-4'>
														<a href='user_profile.php?u_id=$user_id'>
														<img src='users/$user_image' width='150px' height='140px' title='$username' style='float:left; , margin: 1px;'/>
														</a>
													</div><br><br>
													<div class='col-sm-6'>
														<a  style='text-decoration:none; cursor:pointer;color:#3897f0;'    href='user_profile.php?u_id=$user_id'>
														<strong><h2>$f_name  $l_name</h2></strong>
														</a>
													</div>
													<div class='col-sm-3'>
													</div>
													<a   style='color:#3897f0; float: right;' ><button   class='btn btn-info' name='Accept' >Request send</button></a>
															<!--<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$user_id'  name='id'></a>-->
												</div>
											</div>
											<div class='col-sm-4'>
											</div>
										</div><br>
									";
					}
				}
				echo 
									"
										<div class='row'>
											<div class='col-sm-3'>
											</div>
											<div class='col-sm-6'>
												<div class='row' id='find_people'>
												<form action='' method='post'>
													<div class='col-sm-4'>
														<a href='user_profile.php?u_id=$user_id'>
														<img src='users/$user_image' width='150px' height='140px' title='$username' style='float:left; , margin: 1px;'/>
														</a>
													</div><br><br>
													<div class='col-sm-6'>
														<a  style='text-decoration:none; cursor:pointer;color:#3897f0;'    href='user_profile.php?u_id=$user_id'>
														<strong><h2>$f_name  $l_name</h2></strong>
														</a>
													</div>
													<div class='col-sm-3'>
													</div>
													
													<a   style='color:#3897f0; float: right;' ><button   class='btn btn-info' name='add' >Add Friend </button></a>
													<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$user_id'  name='id'></a>
													</form>
												</div>
												
											</div>
											<div class='col-sm-4'>
											</div>
										</div><br>
									";
								}
						}

			if(isset($_POST['add']))
			{
				$d=$_POST['id'];
				
			$insert="insert into friend(user_from,user_to,r_date,a_date,status)values('$id','$d',NOW(),NOW(),1);";
				$get=mysqli_query($con,$insert);
				
			}
	}


function reply_comment()
{
	global $con;
	if(isset($_GET['com_id']))
	{
		$id=$_GET['com_id'];
	
		

	

			$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$uid=$row['user_id'];
			$name=$row['f_name'];
			$email=$row['user_email'];

	$get="select * from  comments where com_id='$id'";
	$run_com=mysqli_query($con,$get);
	$row=mysqli_fetch_array($run_com);
	
		$com=$row['comment'];
		$com_name=$row['comment_author'];
		$date=$row['date'];
		$com_id=$row['com_id'];
		$cid=$row['user_id'];

		echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
							<div class='panel-body'>
								<div>
									<h4><strong>$com_name</strong><i>commented</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
		    ";

		    $rp="select * from  reply where comm_id='$id'";
		    $run=mysqli_query($con,$rp);
		   while( $get=mysqli_fetch_array($run))
		   {
		    $com=$get['reply'];
			$comname=$get['reply_author'];
			$date=$get['date'];
			$u_id=$get['user_id'];
			$rid=$get['reply_id'];

		if($u_id==$uid)
			{
				echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
						
						<div class='panel-body'>
							<form action='' method='post'>
								<div>
									<h4><a href='profile.php?u_id=$uid'><strong>$comname</strong></a><i>commented</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
								</div>
								
								<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$rid'  name='id'></a>
								<button class='btn btn-danger pull-right' name='delete'>delete</button>
								<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$rid'  name='id'></a>
								</form>
								<a href='editreply.php?reply_id=$rid' style='float:right;'><button class='btn btn-info'>Edit</button></a>
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
									<h4><a href='user_profile.php?u_id=$u_id'><strong>$comname</strong></a><i>commented</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
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
								
								$update="delete  from reply where reply_id='$d'";
								$run=mysqli_query($con,$update);

							}

	
			$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$uid=$row['user_id'];
			$name=$row['f_name'];
			$email=$row['user_email'];

		echo"
			<div class='row'>
				<div class='col-md-6 col-md-offset-3'>
					<div class='panel panel-info'>
						<div class='panel-body'>
							<form action='' method='post' class='form-inline'>
								<textarea placeholder='Write Your Comment here!' class='pb-cmnt-textarea' name='comment'></textarea>
								<button class='btn btn-info pull-right' name='reply'>reply</button>
							</from>
						</div>
					</div>
				</div>
			</div>
			";

				if(isset($_POST['reply']))
				{
					$comment = htmlentities($_POST['comment']);

					if($comment=="")
					{
						echo"<script> alert('Enter your comment!')</script>";
						echo "<script>window.open('replytocomment.php?comm_id=$com_id','_self')</script>";
					}
					else
					{

						$insert="insert into reply(fd_id,user_id,comm_id,reply,reply_author,reply_email,date)values('NULL','$uid','$com_id','$comment','$name','$email',NOW())";

						$run=mysqli_query($con,$insert);
						if($run)
						{
						echo" <script> alert('Your Comment Added!')</script>";
						echo "<script>window.open('replytocomment.php?com_id=$com_id','_self')</script>";
						}
						
					}
				}
	}
	if(isset($_GET['fd_id']))
	{
		$id=$_GET['fd_id'];
	
			
	$get="select * from  feedback where fd_id='$id'";
	$run_com=mysqli_query($con,$get);
	$row=mysqli_fetch_array($run_com);
	
		$com=$row['feedback'];
		$com_name=$row['feedback_author'];
		$date=$row['date'];
		$com_id=$row['fd_id'];
		$cid=$row['user_id'];

		echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
							<div class='panel-body'>
								<div>
									<h4><strong>$com_name</strong><i>feedbacked</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
		    ";

		    $rp="select * from  reply where fd_id='$id'";
		    $run=mysqli_query($con,$rp);
		   while( $get=mysqli_fetch_array($run))
		   {
		    $com=$get['reply'];
			$comname=$get['reply_author'];
			$date=$get['date'];
			$u_id=$get['user_id'];
			$rid=$get['reply_id'];

				echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
							<div class='panel-body'>
								<div>
									<h4><a href='user_profile.php?u_id=$u_id'><strong>$comname</strong></a><i>replied</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
								</div>
								
							</div>
						</div>
					
				</div>
		    ";
		
				
	
}				
				if(isset($_POST['delete']))
							{
								$d=$_POST['id'];
								
								$update="delete  from reply where reply_id='$d'";
								$run=mysqli_query($con,$update);

							}

	

	/*	echo"
			<div class='row'>
				<div class='col-md-6 col-md-offset-3'>
					<div class='panel panel-info'>
						<div class='panel-body'>
							<form action='' method='post' class='form-inline'>
								<textarea placeholder='Write Your Comment here!' class='pb-cmnt-textarea' name='comment'></textarea>
								<button class='btn btn-info pull-right' name='reply'>reply</button>
							</from>
						</div>
					</div>
				</div>
			</div>
			";

				if(isset($_POST['reply']))
				{
					$comment = htmlentities($_POST['comment']);

					if($comment=="")
					{
						echo"<script> alert('Enter your comment!')</script>";
						echo "<script>window.open('replytocomment.php?fd_id=$com_id','_self')</script>";
					}
					else
					{

						$insert="insert into reply(fd_id,user_id,comm_id,reply,reply_author,reply_email,date)values('$id','$uid','NULL','$comment','$name','$email',NOW())";

						$run=mysqli_query($con,$insert);
						if($run)
						{
						echo" <script> alert('Your Comment Added!')</script>";
						echo "<script>window.open('replytocomment.php?fd_id=$com_id','_self')</script>";
						}
						
					}
				}*/
	}

}

function feedback_admin()
{
	global $con;

	if(isset($_GET['u_id']))
	{
		$id=$_GET['u_id'];
	}
	$val="select * from users where user_id='$id'";
	$run=mysqli_query($con,$val);
	$get=mysqli_fetch_array($run);
	$name=$get['user_name'];
		echo"
			<div class='row'>
				<div class='col-md-6 col-md-offset-3'>
					<div class='panel panel-info'>
						<div class='panel-body'>
							<form action='' method='post' class='form-inline'>
								<textarea placeholder='Write Your Comment here!' class='pb-cmnt-textarea' name='comment'></textarea>
								<button class='btn btn-info pull-right' name='reply'>send</button>
							</from>
						</div>
					</div>
				</div>
			</div>
			";

  			if(isset($_POST['reply']))
				{
					$comment = htmlentities($_POST['comment']);

					if($comment=="")
					{
						echo"<script> alert('Enter your comment!')</script>";
						echo "<script>window.open('feedback.php?u_id=$id','_self')</script>";
					}
					else
					{

						$insert="insert into feedback(user_id,feedback,feedback_author,date)values('$id','$comment','$name',NOW())";

						$run=mysqli_query($con,$insert);
						if($run)
						{
						echo" <script> alert('Your Comment Added!')</script>";
						echo "<script>window.open('feedback.php?u_id=$id','_self')</script>";
						}
					
					}
				}
}

function search_a_user()
{
	global $con;

			$user=$_SESSION['admin_email'];
			$get_user="select * from admin where admin_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$id=$row['admin_id'];
			

		if(isset($_GET['search_user_btn']))
		{
			$search_query= htmlentities($_GET['search_user']);
			$get_user="select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%$search_query%'  ";
		}
		else
		{
			$get_user="select * from users";
		}

		$run_user=mysqli_query($con,$get_user);

		while($row_user=mysqli_fetch_array($run_user))
		{
			$user_id=$row_user['user_id'];
			$f_name=$row_user['f_name'];
			$l_name=$row_user['l_name'];
			$username=$row_user['user_name'];
			$user_image=$row_user['user_image'];
			
				
				echo 
									"
										<div class='row'>
											<div class='col-sm-3'>
											</div>
											<div class='col-sm-6'>
												<div class='row' id='find_people'>
												<form action='' method='post'>
													<div class='col-sm-4'>
														<a href='user_profile.php?u_id=$user_id'>
														<img src='users/$user_image' class='img-circle' width='120px' height='110px' title='$username' style='float:left; , margin: 1px;'/>
														</a>
													</div><br><br>
													<div class='col-sm-6'>
														<a  style='text-decoration:none; cursor:pointer;color:#3897f0;'    href='user_profile.php?u_id=$user_id'>
														<strong><h2>$f_name  $l_name</h2></strong>
														</a>
													</div>
													<div class='col-sm-3'>
													</div>
													
													<a   style='color:#3897f0; float: right;' ><button   class='btn btn-danger' name='add' >delete </button></a>
													<a   style='color:#3897f0; float:right;' ><input type='hidden' value='$user_id'  name='id'></a>
													</form>
												</div>
												
											</div>
											<div class='col-sm-4'>
											</div>
										</div><br>
									";
								}
						

			if(isset($_POST['add']))
			{
				$d=$_POST['id'];
				
			$insert="delete from users where u_id=$d";
				$get=mysqli_query($con,$insert);
				
			}
}


function reply_feedback()
{
	global $con;
	if(isset($_GET['fd_id']))
	{
		$id=$_GET['fd_id'];
			
	$get="select * from  feedback where fd_id='$id'";
	$run_com=mysqli_query($con,$get);
	$row=mysqli_fetch_array($run_com);
	
		$com=$row['feedback'];
		$com_name=$row['feedback_author'];
		$date=$row['date'];
		$com_id=$row['fd_id'];
		$cid=$row['user_id'];

		echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
							<div class='panel-body'>
								<div>
									<h4><strong>$com_name</strong><i>commented</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
		    ";

	
			$user=$_SESSION['admin_email'];
			$get_user="select * from admin where admin_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$uid=$row['admin_id'];
			$name=$row['af_name'];
			$email=$row['admin_email'];


		echo"
			<div class='row'>
				<div class='col-md-6 col-md-offset-3'>
					<div class='panel panel-info'>
						<div class='panel-body'>
							<form action='' method='post' class='form-inline'>
								<textarea placeholder='Write Your Comment here!' class='pb-cmnt-textarea' name='comment'></textarea>
								<button class='btn btn-info pull-right' name='reply'>reply</button>
							</from>
						</div>
					</div>
				</div>
			</div>
			";

				if(isset($_POST['reply']))
				{
					$comment = htmlentities($_POST['comment']);

					if($comment=="")
					{
						echo"<script> alert('Enter your comment!')</script>";
						echo "<script>window.open('replytocomment.php?comm_id=$com_id','_self')</script>";
					}
					else
					{

						$insert="insert into reply(fd_id,user_id,comm_id,reply,reply_author,reply_email,date)values('$com_id','$uid','NULL','$comment','$name','$email',NOW())";

						$run=mysqli_query($con,$insert);
						if($run)
						{
						echo" <script> alert('Your Comment Added!')</script>";
						echo "<script>window.open('replytocomment.php?fd_id=$com_id','_self')</script>";
						}
						
					}
				}
	}
}

function search_report()
{
	global $con;

			$user=$_SESSION['admin_email'];
			$get_user="select * from admin where admin_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$id=$row['admin_id'];
			

		if(isset($_GET['get']))
		{
			$p=htmlentities($_GET['option']);
			$m=htmlentities($_GET['month']);
			$y=htmlentities($_GET['year']);
			$type=htmlentities($_GET['type']);
			$tm=htmlentities($_GET['to_month']);
			$ty=htmlentities($_GET['to_year']);


			if($type==1)
			{
					if($p==1)
					{
						$q="select * from users where month(user_reg_date)=$m && year(user_reg_date)=$y ";
						$run=mysqli_query($con,$q);
						$a=array("user id","fisrt name","last name","gender","country","DOB","email","joined date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style 'size=100px;'>Record as mention detail : option= Users  and type= In perticular details</strong></center>";
						echo"<center><strong style 'size=100px;'> : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['user_id'];
							$f=$row_user['f_name'];
							$l=$row_user['l_name'];
							$g=$row_user['user_gender'];
							$c=$row_user['user_country'];
							$dob=$row_user['user_birthday'];
							$e=$row_user['user_email'];
							$d=$row_user['user_reg_date'];
							
								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$dob."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}
				if($p==2)
				{
						$q="select * from posts where month(post_date)=$m && year(post_date)=$y ";
						$run=mysqli_query($con,$q);
						$a=array("post id","fisrt name","last name","content","country","image","email","post date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style 'size=100px;'>Record as mention detail : option= Post  and type= In perticular details</strong></center>";
						echo"<center><strong style 'size=100px;'> : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['post_id'];
							$g=$row_user['post_content'];
						
							$dob=$row_user['upload_image'];
							$d=$row_user['post_date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$dob."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}

				if($p==3)
					{
						$q="select * from comments where month(date)=$m && year(date)=$y ";
						$run=mysqli_query($con,$q);
						$a=array("comts id","post id ","user id","fisrt name","last name","comment","country","email","comment date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style 'size=100px;'>Record as mention detail : option=Comments  and type= In perticular details</strong></center>";
						echo"<center><strong style 'size=100px;'> : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['com_id'];
							$pid=$row_user['post_id'];
							$g=$row_user['comment'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$pid."</td><td>".$uid."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}

				if($p==4)
					{
						$q="select * from feedback where month(date)=$m && year(date)=$y ";
						$run=mysqli_query($con,$q);
						$a=array("fd id","user id","fisrt name","last name","feedback","country","email","feedback date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style 'size=100px;'>Record as mention detail : option= Feedback  and type= In perticular details</strong></center>";
						echo"<center><strong style 'size=100px;'> : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['fd_id'];
							$g=$row_user['feedback'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$uid."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
						echo"</table>";
					}

				if($p==5)
					{
						$q="select * from reply where month(date)=$m && year(date)=$y ";
						$run=mysqli_query($con,$q);
						$a=array("reply id","feedback id ","user id","comment id","fisrt name","last name","reply","country","email","reply date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style 'size=100px;'>Record as mention detail : option= Reply  and type= In perticular details</strong></center>";
						echo"<center><strong style 'size=100px;'> : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$fid=$row_user['fd_id'];
							$id=$row_user['comm_id'];
							$rid=$row_user['reply_id'];
							$g=$row_user['reply'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$rid."</td><td>".$fid."</td><td>".$uid."</td><td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}
			}

			if($type==2)
			{			
			

					if($p==1)
					{
						 $from="$y-$m-o1";
							$todate="$ty-$tm-31";
						$df="select * from users where date(user_reg_date) >='".$from ."' and  date(user_reg_date) <='".$todate."'";
						echo $df;
						$q="select * from users where month(user_reg_date)  between ".$m." and ".$tm." && year(user_reg_date)  between ".$y." and ".$ty;
						$run=mysqli_query($con,$df);
						if($run)
						{
							echo"working...........";
						}
						else
						{
							echo".......................not ";
						}
						$a=array("user id","fisrt name","last name","gender","country","DOB","email","joined date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style 'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['user_id'];
							$f=$row_user['f_name'];
							$l=$row_user['l_name'];
							$g=$row_user['user_gender'];
							$c=$row_user['user_country'];
							$dob=$row_user['user_birthday'];
							$e=$row_user['user_email'];
							$d=$row_user['user_reg_date'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$dob."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";

				}
				if($p==2)
				{
						$q="select * from post where month(date)  between ".$m." and ".$tm." && year(date)  between ".$y." and ".$ty;
						$run=mysqli_query($con,$q);
						$a=array("post id","fisrt name","last name","content","country","image","email","post date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['post_id'];
							$g=$row_user['post_content'];
						
							$dob=$row_user['upload_image'];
							$d=$row_user['post_date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$dob."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}

				if($p==3)
					{
						$q="select * from comments where month(date)  between ".$m." and ".$tm." && year(date)  between ".$y." and ".$ty;
						$run=mysqli_query($con,$q);
						$a=array("comts id","post id ","user id","fisrt name","last name","comment","country","email","comment date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['com_id'];
							$pid=$row_user['post_id'];
							$g=$row_user['comment'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$pid."</td><td>".$uid."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}

				if($p==4)
					{
						$q="select * from feedback where month(date)  between ".$m." and ".$tm." && year(date)  between ".$y." and ".$ty;
						$run=mysqli_query($con,$q);
						$a=array("fd id","user id","fisrt name","last name","feedback","country","email","feedback date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['fd_id'];
							$g=$row_user['feedback'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$uid."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
						echo"</table>";
					}

				if($p==5)
					{
						$q="select * from reply where month(date)  between ".$m." and ".$tm." && year(date)  between ".$y." and ".$ty;
						$run=mysqli_query($con,$q);
						$a=array("reply id","feedback id ","user id","comment id","fisrt name","last name","reply","country","email","reply date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$fid=$row_user['fd_id'];
							$id=$row_user['comm_id'];
							$rid=$row_user['reply_id'];
							$g=$row_user['reply'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$rid."</td><td>".$fid."</td><td>".$uid."</td><td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}
			}

			if($type==3)
			{
					if($p==1)
					{
						$q="select * from users where month(user_reg_date)>$m && year(user_reg_date)>$y ";
						$run=mysqli_query($con,$q);
						$a=array("user id","fisrt name","last name","gender","country","DOB","email","joined date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style 'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['user_id'];
							$f=$row_user['f_name'];
							$l=$row_user['l_name'];
							$g=$row_user['user_gender'];
							$c=$row_user['user_country'];
							$dob=$row_user['user_birthday'];
							$e=$row_user['user_email'];
							$d=$row_user['user_reg_date'];
							
								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$dob."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}
				if($p==2)
				{
						$q="select * from posts where month(post_date)>$m && year(post_date)>$y ";
						$run=mysqli_query($con,$q);
						$a=array("post id","fisrt name","last name","content","country","image","email","post date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['post_id'];
							$g=$row_user['post_content'];
						
							$dob=$row_user['upload_image'];
							$d=$row_user['post_date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$dob."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}

				if($p==3)
					{
						$q="select * from comments where month(date)>$m && year(date)>$y ";
						$run=mysqli_query($con,$q);
						$a=array("comts id","post id ","user id","fisrt name","last name","comment","country","email","comment date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['com_id'];
							$pid=$row_user['post_id'];
							$g=$row_user['comment'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$pid."</td><td>".$uid."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}

				if($p==4)
					{
						$q="select * from feedback where month(date)>$m && year(date)>$y ";
						$run=mysqli_query($con,$q);
						$a=array("fd id","user id","fisrt name","last name","feedback","country","email","feedback date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['fd_id'];
							$g=$row_user['feedback'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$uid."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
						echo"</table>";
					}

				if($p==5)
					{
						$q="select * from reply where month(date)>$m && year(date)>$y ";
						$run=mysqli_query($con,$q);
						$a=array("reply id","feedback id ","user id","comment id","fisrt name","last name","reply","country","email","reply date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$fid=$row_user['fd_id'];
							$id=$row_user['comm_id'];
							$rid=$row_user['reply_id'];
							$g=$row_user['reply'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$rid."</td><td>".$fid."</td><td>".$uid."</td><td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}
			}

			if($type==4)
			{
					if($p==1)
					{
						$q="select * from users where month(user_reg_date)<$m && year(user_reg_date)<$y ";
						$run=mysqli_query($con,$q);
						$a=array("user id","fisrt name","last name","gender","country","DOB","email","joined date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style 'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['user_id'];
							$f=$row_user['f_name'];
							$l=$row_user['l_name'];
							$g=$row_user['user_gender'];
							$c=$row_user['user_country'];
							$dob=$row_user['user_birthday'];
							$e=$row_user['user_email'];
							$d=$row_user['user_reg_date'];
							
								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$dob."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}
				if($p==2)
				{
						$q="select * from posts where month(post_date)<$m && year(post_date)<$y ";
						$run=mysqli_query($con,$q);
						$a=array("post id","fisrt name","last name","content","country","image","email","post date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['post_id'];
							$g=$row_user['post_content'];
						
							$dob=$row_user['upload_image'];
							$d=$row_user['post_date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$dob."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}

				if($p==3)
					{
						$q="select * from comments where month(date)<$m && year(date)<$y ";
						$run=mysqli_query($con,$q);
						$a=array("comts id","post id ","user id","fisrt name","last name","comment","country","email","comment date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['com_id'];
							$pid=$row_user['post_id'];
							$g=$row_user['comment'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$pid."</td><td>".$uid."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}

				if($p==4)
					{
						$q="select * from feedback where month(date)<$m && year(date)<$y ";
						$run=mysqli_query($con,$q);
						$a=array("fd id","user id","fisrt name","last name","feedback","country","email","feedback date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$id=$row_user['fd_id'];
							$g=$row_user['feedback'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$id."</td><td>".$uid."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
						echo"</table>";
					}

				if($p==5)
					{
						$q="select * from reply where month(date)<$m && year(date)<$y ";
						$run=mysqli_query($con,$q);
						$a=array("reply id","feedback id ","user id","comment id","fisrt name","last name","reply","country","email","reply date");
					
					
						echo"<table border=3 align='center'>";
						echo"<center><strong style'size=100px;'>Record as mention date : month=".$m."and year=".$y."</strong></center>";
						echo"<tr>";
						foreach($a as $v)
						{
							echo"<th>".$v."</th>";
						}
						echo"</tr>";
						
						while($row_user=mysqli_fetch_array($run))
						{
							$fid=$row_user['fd_id'];
							$id=$row_user['comm_id'];
							$rid=$row_user['reply_id'];
							$g=$row_user['reply'];
						
							
							$d=$row_user['date'];
							$uid=$row_user['user_id'];


							$q="select * from users where user_id=$uid";
							
							$rw=mysqli_query($con,$q);
							$get=mysqli_fetch_array($rw);

							$f=$get['f_name'];
							$l=$get['l_name'];
							$e=$get['user_email'];
							$c=$get['user_country'];

								echo"<tr>";
						
									echo"<td>".$rid."</td><td>".$fid."</td><td>".$uid."</td><td>".$id."</td><td>".$f."</td><td>".$l."</td><td>".$g."</td><td>".$c."</td><td>".$e."</td><td>".$d."</td>";
							
								echo"</tr>";
						}
					echo"</table>";
				}
			}
}
}
?>
