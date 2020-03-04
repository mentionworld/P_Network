
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
	<title>View Your Post</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body  style="background-image: url('images/bb1.jpg'); background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
	
	<div class="row">
		<div class="col-sm-12">
			<center><h2> User's Feedback</h2><br></center>
			<?php
				global $con;
				include ("include/connection.php");
			
		    $rp="select * from  feedback ORDER by 1 DESC  ";
		    $run=mysqli_query($con,$rp);
		   while( $get=mysqli_fetch_array($run))
		   {
		    $fd=$get['feedback'];
			$fdname=$get['feedback_author'];
			$date=$get['date'];
			$com_id=$get['fd_id'];
				

		echo"

				<div class='row'>
					<div class='col-md-6 col-md-offset-3'>
						<div class='panel panel-info'>
						
							<div class='panel-body'>
								<div>
									<h4><strong>$fdname</strong></strong><i>commented</i>on $date</h4>
									<p class='text-primary' style='margin-left:5px;font-size:20px;'>$fd</p>
								</div>
								
							
						
							<a href='replytofeedback.php?fd_id=$com_id' style='float:right;'><button class='btn btn-success'>reply</button></a>
							</div>
						</div>
					</div>
				</div>
		    ";
		}
		


?>
		</div>
	</div>
</body>
</html>