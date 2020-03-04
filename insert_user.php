<?php
include ("include/connection.php");
	if (isset($_POST['sign_up']))
	 {
	 	$user_id;
		$first_name=htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
		$last_name=htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
		$pass=htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
		$email=htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
		$country=htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
		$gender=htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
		$birthday=htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));

		$r_ans=htmlentities(mysqli_real_escape_string($con,$_POST['r_answer']));
		$r_question=htmlentities(mysqli_real_escape_string($con,$_POST['r_Question']));

		$status="varified";
		$posts="no";
		$newgid=sprintf('%05d',rand(0,9999999));

		$username=strtolower($first_name . "_" . $last_name . "_" .$newgid);

		$check_username_query="SELECT user_name from users where user_email='email'";
		$run_username=mysqli_query($con,$check_username_query);
		if(strlen($pass)<9)
		{
			echo "<script> alert('password should be minimum 9 characters!')</script>";
			exit();
		}
		$check_email="SELECT* from users where user_email='$email'";

		$run_email=mysqli_query( $con,$check_email);

		$check=mysqli_num_rows($run_email);
		if($check == 1)
		{
			echo "<script>alert('Email already exist, please try using another email')</script>";
			echo "<script>window.open('signup.php','_self'</script>";
			exit();
		}
		$rand = rand(1,3);
			if ($rand == 1)
				$profile_pic="p1.jpg";
			else if ($rand==2)
				$profile_pic="p2.jpg";
			else if ($rand==3)
				$profile_pic="p3.jpg";

		

/*		$insert="INSERT INTO   users (f_name,l_name,user_name,describe_user,Relationship,user_pass,user_email,user_country,user_gender,user_birthday,user_image,user_cover,user_reg_date,status,posts,recovery_account,recovey_Q)
		 VALUES('$first_name','$last_name','$username','Hello mention world . this is my default status!','...','$pass','$email','$country','$gender','$birthday','$profile_pic','c2.jpg',NOW(),'$status','$posts','$r_ans','$r_question');";
		$query=mysqli_query($con,$insert);
	if ($query)
		{
			echo "<script>alert('Well Done $first_name,you are good to go.')</script>";
			echo "<script>window.open('signin.php','_self')</script>";
		}
		else
		{
			echo "<script>alert('Registration failed, Please try again! ')</script>";
			echo "<script>window.open('signup.php','_self'</script>";
		}*/
	 }
?>