<?php
session_start();

$errors = array();

$con=mysqli_connect('localhost','root','','tax');
$na=$_POST['name'];
$sr=$_POST['surname'];
$f=$_POST['fname'];
$fs=$_POST['fsurname'];
$p=$_POST['PAN'];
$c=$_POST['catagory'];
$e=$_POST['email'];
$mo=$_POST['mobile'];
$add=$_POST['address'];
$pass=md5($_POST['password']);

$q1="select * from user where PAN='$p' ";
$result=mysqli_query($con,$q1);
$user = mysqli_fetch_assoc($result);
if ($user) { // if user exists
    header('location: signup.php');
      array_push($errors, "You are already a user...");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$q2="insert into user values('$p','$na','$sr','$f','$fs','$c','$e','$mo','$add','$pass')";
	$i=mysqli_query($con,$q2);
  	//$_SESSION['PAN'] = $p;
  //	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
  
  mysqli_close($con);
?>