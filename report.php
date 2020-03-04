<!DOCTYPE html>
<?php
 session_start();
 include("include/a_header.php");

	if(!isset($_SESSION['admin_email']))
	{
		header("location:index.php");
	}
?>
<html>
<head>
	

	<title>Find People</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style >
	#find_people
{
	border:5px solid #e6e6e6;
	padding: 40px 50px;
}
#result_posts
{
	border:5px solid #e6e6e6;
	padding: 40px 50px;
}
form.search_form input[type=text]
{
	padding: 10px;
	font-size: 17px;
	border-radius: 4px;
	border:1px solid grey;
	float: left;
	width: 80%;
	background: #f1f1f1;
}
form.search_form button
{
	float: left;
	width: 20%;
	padding: 10px;
	font-size: 17px;
	border:1px solid grey;
	border-left:none;
	cursor: pointer;
}
form.search_form button:hover
{
	background: #0b7dda;
}
form.search_form::after
{
	content: "";
	clear:both;
	display: table;
}
</style>
<body>


<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
			<!--<a hre="home.php" class="navbar-brand">mention world</a>-->
		</div>
		<div class="collapse navbar-collapse" id="#bs-example-navbar-collapse-1">
			<form>
			<ul class="nav navbar-nav"> 
				
				<li>
				<br><strong>	<?php //echo"$user_name";?></strong>
				</li>
				<li>&nbsp<strong>select option</strong>
						&nbsp&nbsp<select  name="option" placeholder="<?php  if(isset($_GET['option'])){echo$_GET['option'];}?>" required="required">
								<option value="1">users</option>
								<option value="2"> Post</option>
								<option value="3"> Comments</option>
								<option value="4">Feedback</option>
								<option value="5"> reply</option>	
							</select></li>
				<li>&nbsp<strong>Month</strong>
					&nbsp&nbsp&nbsp&nbsp<select  name="month" placeholder="<?php  if(isset($_GET['month'])){echo$_GET['month'];}?>"  required="required">
								<option value="1">Jan </option>
								<option value="2"> Feb</option>
								<option value="3"> Mar</option>
								<option value="4"> Apr</option>
								<option value="5"> May</option>
								<option value="6">Jun</option>
								<option value="7"> Jul</option>
								<option value="8"> Aug</option>
								<option value="9"> Sep</option>
								<option value="10"> Oct</option>
								<option value="11"> Nov</option>
								<option value="12"> Dec</option>
							</select></li>
				<li>&nbsp<strong>Year</strong>&nbsp&nbsp&nbsp<input type="text" width="25px" placeholder="<?php if(isset($_GET['year'])){echo$_GET['year'];}?>" name="year" required="required">
				</li>
				<li>&nbsp<strong>type</strong>
						&nbsp&nbsp<select name="type" placeholder="<?php  if(isset($_GET['type'])){echo$_GET['type'];}?>" required="required">
								<option value="1">perticular date</option>
								<option value="2">In between date</option>
								<option value="3">After date</option>
								<option value="4">Before date</option>
	
							</select></li>
				<li>&nbsp<strong> To Month</strong>
					&nbsp&nbsp&nbsp&nbsp<select  name="to_month" placeholder="<?php  if(isset($_GET['to_month'])){echo$_GET['to_month'];}?>"  required="required">
								<option value="1">Jan </option>
								<option value="2"> Feb</option>
								<option value="3"> Mar</option>
								<option value="4"> Apr</option>
								<option value="5"> May</option>
								<option value="6">Jun</option>
								<option value="7"> Jul</option>
								<option value="8"> Aug</option>
								<option value="9"> Sep</option>
								<option value="10"> Oct</option>
								<option value="11"> Nov</option>
								<option value="12"> Dec</option>
							</select></li>
				<li>&nbsp<strong> To Year</strong>&nbsp&nbsp&nbsp<input type="text" width="25px" placeholder="<?php if(isset($_GET['to_year'])){echo$_GET['to_year'];}?>" name="to_year" >
				</li>
				
							
			</ul>
			<ul><center><button class="btn btn-info" type="submit" name="get">Search</button></center></ul>
		</form>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<form class="navbar-form navbar-left" method="get" action="">
						
					<button align="right" class="btn btn-info" onclick="call()"> Print this page</button>
					</form>
				</li>
				
			</ul>
		
		</div>
	</div>
	
</nav>
<div class="col-sm-12">
			<center><h2>report</h2></center><br><br>
			
			<?php 
			search_report();
			?>
		
	</div>
<script type="text/javascript">
	function call()
	{
		window.print();
	}
</script>
</body>
</html>
