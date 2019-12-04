<?php
include("include/connection.php");
$insert ="insert into dummy(user_id,s_name,l_name) values ( 2,'p','y')";
$r=mysqli_query($con,$insert);

?>