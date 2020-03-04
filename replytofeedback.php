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
	<title>reply</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body style="background:url('images/c.jpeg');
	height: 100vh;
	-webkit-background-size:cover;
	background-size: cover;
	background-position: center center;
	position: relative; ">
	<div class="row">
		<div class="col-sm-12">
			<center><h2>Reply</h2><br></center>
			<?php
				reply_feedback();
			?>
		</div>

	</div>
	
</body>
</html>