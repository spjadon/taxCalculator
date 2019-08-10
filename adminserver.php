<?php
	session_start();
	$login_session_duration = 1501;

	$errors = array();
		// connection to the database
	$con=mysqli_connect('localhost','root','','tax');
	
	//login
	
	if(isset($_POST['adminlogin'])){
		$adminid=($_POST['adminid']);
		$password=md5($_POST['password']);
		$q1="select * from admin where adminid='$adminid' and password='$password' ";
		$result=mysqli_query($con,$q1);
		$admin = mysqli_fetch_assoc($result);
		if ($admin) { // if user exists
			$_SESSION['adminid']=$adminid;
			$_SESSION['loggedin_time'] = time();
			$_SESSION['success']= "You are now logged in....";
			header('location: admin_dashboard.php');
		}
		else{
			array_push($errors, "Wrong User id Password Combination or You have not Admin Rights...");
		}			
	}
	//To count number of users
		$q2="select count(*) as total from user";
		$result1=mysqli_query($con,$q2);
		$count = mysqli_fetch_assoc($result1);
	//To count number of Returns Filed
		$q3="select count(*) as total2 from bank";
		$result2=mysqli_query($con,$q3);
		$count2=mysqli_fetch_assoc($result2);
	// to count total amount recieved
		$q4="select sum(tax15) as total3 from bank";
		$result3=mysqli_query($con,$q4);		
		$count3=mysqli_fetch_assoc($result3);		
	//To count number of admins
		$q5="select count(*) as total4 from admin";
		$result4=mysqli_query($con,$q5);
		$count4 = mysqli_fetch_assoc($result4);		
	//change admin password		
	if(isset($_POST['changepassword'])){
		$adminid=$_SESSION['adminid'];
		$password=md5($_POST['password']);
		$password1=md5($_POST['password1']);
		$password2=md5($_POST['password2']);
		
		//check whether old password is correct or not
		$q1="select * from user where adminid='$adminid' and password='$password' ";
		$result=mysqli_query($con,$q1);
		
			//ensure that form fields properly
		if($password1 != $password2){
			array_push($errors,"The two password do not match");
		}
		if ($result) { // if user exists
			$q1="update admin set password='$password1' where adminid='$adminid'";
			$result=mysqli_query($con,$q1);
			array_push($errors, "User Profile Updated Successfully...");
		}
		else{
			array_push($errors, "Old password is not correct, Please try with correct password!");
			
		}
	}
	
	//add new admin profile
	if(isset($_POST['addadmin'])){
		$adminid=$_POST['adminid'];
		$password=md5($_POST['password']);
		if($_SESSION['adminid']=='admin'){
			// first check the database to make sure a user does not already exist with the same PAN
	
			$q1="select * from admin where adminid='$adminid' ";
			$result=mysqli_query($con,$q1);
			$user = mysqli_fetch_assoc($result);
			if ($user) { // if user exists
				array_push($errors, "Admin Profile already exist...");
			}
			//if there is no errors save user to database
	
			if(count($errors)==0){
				$q2="insert into admin values('$adminid','$password')";
				$i=mysqli_query($con,$q2);
				array_push($errors, "Admin Profile Successfully Created...");
			}
		}
		else{
			array_push($errors, "You have not Prime Admin Rights...");
		}
	}
	
	//Delete Admin Profile
	if(isset($_POST['deleteadmin'])){
		$adminid=$_POST['adminid'];
		if($_SESSION['adminid']=='admin'and $adminid != 'admin'){
			// first check the database to make sure a user does not already exist with the userId
	
			$q1="select * from admin where adminid='$adminid' ";
			$result=mysqli_query($con,$q1);
			$user = mysqli_fetch_assoc($result);
			if (!$user) { // if user exists
				array_push($errors, "No admin Profile Exists...");
			}
			//if there is no errors save user to database
	
			else{
				$q2="delete from admin where adminid='$adminid'";
				$i=mysqli_query($con,$q2);
				array_push($errors, "Admin Profile Successfully Deleted...");
			}
		}
		else if($adminid=='admin'){
			array_push($errors, "This Profle can not be deleted...");
		}
		else{
			array_push($errors, "You have not Prime Admin Rights...");
		}
	}
	
	// Delete user Profile
	if(isset($_POST['deleteuser']) ){
		if(isset($_GET['del'])){
			$userid=$_GET['del'];
		}
		else{
			$userid=$_POST['userid'];
		}
		
		
			// first check the database to make sure a user does not already exist with the userId
	
			$q1="select * from user where PAN='$userid' ";
			$result=mysqli_query($con,$q1);
			$user = mysqli_fetch_assoc($result);
			if (!$user) { // if user exists
				array_push($errors, "No Such User Profile Exists...");
			}
			//if there is no errors save user to database
	
			else{
				$q2="delete from user where PAN='$userid'";
				$i=mysqli_query($con,$q2);
				array_push($errors, "User Profile Successfully Deleted...");
			}
	}
	//logout
	if(isset($_GET['adminlogout'])){
		session_destroy();
		unset($_SESSION['success']);
		unset($_SESSION['admin']);
		header('location: admin_login.php');
	}

	//To view Returns Details
	if(isset($_POST['viewreturn'])){
		$returnID=($_POST['view']);
		
		$q1="select * from bank where returnID='$returnID'";
		$result=mysqli_query($con,$q1);
		$i = mysqli_fetch_assoc($result);
		if($i){
		$transID=$i['transID'];
		$date=$i['date'];
		$time = new DateTime($date);
		$pan=$i['PAN'];
		$ifs=$i['ifs'];
		$catagory=$i['catagory'];
		
		$residence=$i['residence'];
		$ifs=$i['ifs'];
		$ifhp=$i['ifhp'];
		$stcga=$i['stcga'];
		$ifb=$i['ifb'];
		$ifos=$i['ifos'];
		$ifa=$i['ifa'];
		$deductions=$i['deductions'];
		$gross=$i['gross'];
		$tax1=$i['tax1'];
		$tax2=$i['tax2'];
		$tax3=$i['tax3'];
		$tax4=$i['tax4'];
		$tax5=$i['tax5'];
		$tax6=$i['tax6'];
		$tax7=$i['tax7'];
		$tax8=$i['tax8'];
		$tax9=$i['tax9'];
		$tax10=$i['tax10'];
		$tax11=$i['tax11'];
		$tax12=$i['tax12'];
		$tax13=$i['tax13'];
		$tax14=$i['tax14'];
		$tax15=$i['tax15'];
		}
		
	}
	
	
	
		
  mysqli_close($con);
  
?>