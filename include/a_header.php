<?php
include("include/connection.php");
include("function/function.php");
?>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
			<a hre="home.php" class="navbar-brand">mention world</a>
		</div>
		<div class="collapse navbar-collapse" id="#bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav"> 
				<?php
					$user=$_SESSION['admin_email'];
					$get_user="select * from admin where admin_email='$user'";
					$run_user=mysqli_query($con,$get_user);
					$row=mysqli_fetch_array($run_user);

					$user_id=$row['admin_id'];
					$user_name=$row['af_name'];
					
					
				?>
				<li>
				<br><strong>	<?php echo"$user_name";?></strong>
				</li>
				<li><a href="admin_home.php">Home</a></li>
				<li><a href="admin_fdk.php">feedback</a></li>
				<li><a href="admin_m.php">users</a></li>
				<li><a href="report.php">report</a></li>
				<li><a href="Logout.php">logout</a></li>

				<!--<?php
					/*echo "
							<li class='dropdown'>
								<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='true'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
								<ul class='dropdown-menu'>
									<li>
									 
									 </li>
										<li>
											<a href='edit_profile.php?u_id=$user_id'>Edit Account</a>
										</li>
										<li>
											<a href='feedback.php?u_id=$user_id'>feedback</a>
										</li>
										<li role='seperator' class='divider'></li>
										<li>
											<a href='logout.php'>Logout</a>
										</li>
								</ul>
							</li>
					";*/
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<form class="navbar-form navbar-left" method="get" action="results.php">
						<div class="form-group">
							<input type="text"  class="form-control" name="user_query" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-info" name="search">Search</button>
					</form>
				</li>-->
				
			</ul>
		</div>
	</div>
</nav>