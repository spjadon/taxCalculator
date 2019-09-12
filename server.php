<?php
	session_start();
	$success=0;
	$login_session_duration = 1500;
	$temp_session=300;
	$otp;
	$errors = array();
		// connection to the database
	$con=mysqli_connect('localhost','root','','tax');
	
	//php Mailer
	require 'PHPMailer/PHPMailerAutoload.php';
		require'PHPMailer/class.phpmailer.php';
		require'PHPMailer/class.smtp.php';
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'abc@gmail.com';   
		$mail->Password = '******';
		$mail->SMTPSecure = 'tls';
		$mail->Port     = 587;
		$mail->SetFrom('abc@gmail.com', 'Tax Calculator and Submission');
		$mail->AddReplyTo('another@gmail.com', 'Sandeep Jadon');
		$mail->IsHTML(true);
		
		//If the signup button is clicked	
		if(isset($_POST['signupotp'])){
			$pan=strtoupper($_POST['PAN']);
			$dob=($_POST['dob']);
			$email=($_POST['email']);
			$mobile=($_POST['mobile']);
			// first check the database to make sure a user does not already exist with the same PAN
	
			$q1="select * from user where PAN='$pan' ";
			$result=mysqli_query($con,$q1);
			$user = mysqli_fetch_assoc($result);
			if ($user) { // if user exists
				array_push($errors, "You are already a user...");
			}
			else{
				$otp=rand(100000,999999);
				try{
				$mail->AddAddress($email);
				$mail->Subject = 'OTP for Registration | Tax Calculator and Submission';
				date_default_timezone_set('Asia/Kolkata');
				$time=date("d-m-Y h:i:sa");
				$mail->Body='Hello '.'<b>'.$pan.',</b>'.'<br><br>'.'Your OTP for Registration: '.$otp.'</b><br><br>OTP generated at: <p style="color:MediumSeaGreen">'.$time.'**</p><p style="color:red;">**OTP valid only for 5 min</p><br>..............................................................';
				$result = $mail->Send();		
				
					$q1="select * from otp where PAN='$pan' ";
					$result=mysqli_query($con,$q1);
					$user = mysqli_fetch_assoc($result);
					if ($user) { // if user exists
						$q="update otp set otp='$otp',dob='$dob', email='$email', mobile='$mobile' where PAN='$pan'";
					}
					else{
						$q="insert into otp values ('$pan','$dob', '$otp', '$email','$mobile','')";
					}
				$result=mysqli_query($con,$q);
				$_SESSION['temp_PAN']=$pan;
				$_SESSION['loggedin_time'] = time();
				$success=1;
				}
				catch (phpmailerException $e) {
					array_push($errors,$e->errorMessage());
					//Pretty error messages from PHPMailer
					} catch (Exception $e) {
					//Boring error messages from anything else!
					array_push($errors,$e->getMessage());
				}
		}
		
	}
	if(isset($_POST['signupotpsubmit'])){
					$success=1;
					$pan=$_SESSION['temp_PAN'];
					$otpsubmit=($_POST['otp']);
					$q="select * from otp where PAN='$pan'";
					$result=mysqli_query($con,$q);
					$user = mysqli_fetch_assoc($result);
					$otp=$user['otp'];;
					if($otpsubmit==$otp){
							$success=2;
					}
					else{
						array_push($errors, "Incorrect OTP, Please try again!...");
					}
				}	
	if(isset($_POST['signup'])){
		$success=2;
		$pan=$_SESSION['temp_PAN'];
		$sex=($_POST['sex']);
		$name=strtoupper($_POST['name']);
		$surname=strtoupper($_POST['surname']);
		$fname=strtoupper($_POST['fname']);
		$fsurname=strtoupper($_POST['fsurname']);
		$address=strtoupper($_POST['address']);
		$password1=md5($_POST['password1']);
		$password2=md5($_POST['password2']);
		//to define file
		$filename = $_FILES['image']['name'];
		$tempname = $_FILES['image']['tmp_name'];
		$folder="img/profile/".$filename;
			//ensure that form fields properly
		if($password1 != $password2){
			array_push($errors,"The two password do not match");
		}
		else{
		$q="select * from otp where PAN='$pan'";
		$result=mysqli_query($con,$q);
		$user = mysqli_fetch_assoc($result);
		$email=$user['email'];$mobile=$user['mobile'];$dob=$user['dob'];
			//if there is no errors save user to database
			move_uploaded_file($tempname,$folder);
			$q2="insert into user values('$pan','$sex','$name','$surname','$fname','$fsurname','$dob','$email','$mobile','$address','$password1','$folder')";
			$i=mysqli_query($con,$q2);
			if($i){
						array_push($errors, "Password changed successfully<br> Now you can login to your account ");
						try{
						$mail->AddAddress($email);
						$mail->Subject = 'Confirmation for Successfully Registration | Tax Calculator and Submission';
						date_default_timezone_set('Asia/Kolkata');
						$time=date("d-m-Y h:i:sa");
						$mail->Body='<b style="color:Red">Congratulations </b><b>'.$name.' '.$surname.',</b>'.'<br><br>'.'You have successfully registered for Tax Calculator and Submission at: <p style="color:MediumSeaGreen">'.$time.'</p><br>..............................................................';
						$result = $mail->Send();
						
				unset($_SESSION['temp_PAN']);
				$_SESSION['PAN']=$pan;
				$_SESSION['loggedin_time'] = time();
				$_SESSION['success']= "You are now logged in...";
				echo '<script> alert("You have successfully Registered, Now you are logged in.")</script>';
				header('location: dashboard.php');
						}
						catch (phpmailerException $e) {
					array_push($errors,$e->errorMessage());
					//Pretty error messages from PHPMailer
					} catch (Exception $e) {
					//Boring error messages from anything else!
					array_push($errors,$e->getMessage());
				}
			}
		}
	}
	
	
	//login
	if(isset($_POST['login'])){
		$pan=strtoupper($_POST['PAN']);
		$password=md5($_POST['password']);
		$q1="select * from user where PAN='$pan' and password='$password' ";
		$result=mysqli_query($con,$q1);
		$user = mysqli_fetch_assoc($result);
		if ($user) { // if user exists
			$_SESSION['PAN']=$pan;
			$_SESSION['loggedin_time'] = time();
			$_SESSION['success']= "You are now logged in....";
			header('location: dashboard.php');
		}
		else{
			array_push($errors, "Wrong UserName/ Password Combination...");
			
		}			
	}
	
	//Update to the Database
	if(isset($_POST['update'])){
		
		$pan=($_SESSION['PAN']);
		$email=($_POST['email']);
		$mobile=($_POST['mobile']);
		$address=strtoupper($_POST['address']);
		$q="select * from user where PAN='$pan'";
		$result=mysqli_query($con,$q);
		$user = mysqli_fetch_assoc($result);
		$datamail=$user['email'];
	//generate otp
		$otp=rand(100000,999999);
		try{
		$mail->AddAddress($datamail);
		$mail->Subject = 'OTP to Update Profile | Tax Calculator and Submission';
		$mail->Body='Hello '.'<b>'.$user['name'].' '.$user['surname'].',</b>'.'<br><br>'.'Your OTP for Profile upadte: '.$otp.'<br>..............................................................';
		$result = $mail->Send();		
			
				$pan=($_SESSION['PAN']);
				$q="update otp set otp='$otp', email='$email', mobile='$mobile', address='$address' where PAN='$pan'";
				$result=mysqli_query($con,$q);
				$success=1;
				array_push($errors, "Check your Email for OTP...");
				//alert("Updtaed Successfully!!");
		}
		catch (phpmailerException $e) {
					array_push($errors,$e->errorMessage());
					//Pretty error messages from PHPMailer
					} catch (Exception $e) {
					//Boring error messages from anything else!
					array_push($errors,$e->getMessage());
				}
		
			
			// Update UserDatabase
	}
	if(isset($_POST['submitotp'])){
					$success=1;
					$pan=$_SESSION['PAN'];
					$otpsubmit=($_POST['otp']);
					$q="select * from otp where PAN='$pan'";
				$result=mysqli_query($con,$q);
				$user = mysqli_fetch_assoc($result);
				$otp=$user['otp'];$email=$user['email'];$mobile=$user['mobile'];$address=$user['address'];
					if($otpsubmit==$otp){
						$q1="update user set email='$email', mobile='$mobile', address='$address' where PAN='$pan'";
						$result=mysqli_query($con,$q1);
							
						array_push($errors, "Profile updated Successfully...");
						header('location: user.php');
					}
					else{
						array_push($errors, "Incorrect OTP, Please try again!...");
					}
				}
	
	//update password
	
	if(isset($_POST['passwordupdate'])){
		$pan=($_SESSION['PAN']);
		$password=md5($_POST['password']);
		$password1=md5($_POST['password1']);
		$password2=md5($_POST['password2']);
		
		//check whether old password is correct or not
		$q1="select * from user where PAN='$pan' and password='$password' ";
		$result=mysqli_query($con,$q1);
		$user = mysqli_fetch_assoc($result);
		//ensure that form fields properly
			if($password1 != $password2){
				array_push($errors,"The two password do not match!..");
			//alert("The two password do not match!!");
			}
		if ($user) { // if user exists
			
			// Update UserDatabase
			
				$q1="update user set password='$password1' where PAN='$pan'";
				$result=mysqli_query($con,$q1);
				array_push($errors, "Password Changed Successfully...");
				//alert("Updtaed Successfully!!");
			
			
		}
		else{
			array_push($errors, "Old password is not correct, Please try again!..");
			
		}	
			
		
	}
	

	
	//logout
	if(isset($_GET['logout'])){
		unset($_SESSION['success']);
		unset($_SESSION['PAN']);
		
		header('location: login.php');
		session_destroy();
	}
	
	//
	if(isset($_POST['pic'])){
		
		$pan=($_SESSION['PAN']);
		$filename = $_FILES['image']['name'];
		$tempname = $_FILES['image']['tmp_name'];
		$folder="img/profile/".$filename;
		move_uploaded_file($tempname,$folder);
		$q1 = "update user set image='$folder' where PAN='$pan'";
		$data=mysqli_query($con,$q1);
		if ($data) { 
			array_push($errors, "Profile picture uploaded successfully.. ");
		}
		else{
			array_push($errors, "Something went wrong, Please try after some time! ");
		}
	}
		
	
	//Recover password
	
	if(isset($_POST['sendotp'])){
		$pan=($_POST['PAN']);
		$q="select * from user where PAN='$pan'";
		$result=mysqli_query($con,$q);
		$user = mysqli_fetch_assoc($result);
		if($user){
		$datamail=$user['email'];
	//generate otp
		$otp=rand(100000,999999);
		try{
		$mail->AddAddress($datamail);
		$mail->Subject = 'OTP to Recover Password | Tax Calculator and Submission';
		date_default_timezone_set('Asia/Kolkata');
		$time=date("d-m-Y h:i:sa");
		$mail->Body='Hello '.'<b>'.$user['name'].' '.$user['surname'].',</b>'.'<br><br>'.'Your OTP for Recover Password: <b>'.$otp.'</b><br><br>OTP generated at: <p style="color:MediumSeaGreen">'.$time.'**</p><p style="color:red;">**OTP valid only for 5 min</p><br>..............................................................';
		$result = $mail->Send();
			
				$q="update otp set otp='$otp' where PAN='$pan'";
				$result=mysqli_query($con,$q);
				$_SESSION['temp_PAN']=$pan;
				$_SESSION['loggedin_time'] = time();
				$success=1;
				array_push($errors, "Check your Email for OTP...");	
		}
		catch (phpmailerException $e) {
					array_push($errors,$e->errorMessage());
					//Pretty error messages from PHPMailer
					} catch (Exception $e) {
					//Boring error messages from anything else!
					array_push($errors,$e->getMessage());
				}
			
			// Update UserDatabase
		
		}
			else{
				array_push($errors, "No user with this username exists,<br>Please, try with antoher username! ...");
			}	
	}
	
	if(isset($_POST['otpsubmit'])){
					$success=1;
					$pan=$_SESSION['temp_PAN'];
					$otpsubmit=($_POST['otp']);
					$q="select * from otp where PAN='$pan'";
				$result=mysqli_query($con,$q);
				$user = mysqli_fetch_assoc($result);
				$otp=$user['otp'];;
					if($otpsubmit==$otp){
							array_push($errors, "Enter your new Passwords ");
							$success=2;
						
					}
					else{
						array_push($errors, "Incorrect OTP, Please try again!...");
					}
				}
	if(isset($_POST['recoverpass'])){
					$success=2;
					$pan=$_SESSION['temp_PAN'];
					$password1=md5($_POST['password1']);
					$password2=md5($_POST['password2']);
					//ensure that form fields properly
					if($password1 != $password2){
						array_push($errors,"The two password do not match");
					}
					if(count($errors)==0){
					$q="update user set password='$password1' where PAN='$pan'";
					$result=mysqli_query($con,$q);
					if ($result) { 
						$q="select * from user where PAN='$pan'";
						
						$result=mysqli_query($con,$q);
						$user = mysqli_fetch_assoc($result);
						$datamail=$user['email'];
						array_push($errors, "Password changed successfully<br> Now you can login to your account ");
						try{
						$mail->AddAddress($datamail);
						$mail->Subject = 'Confirmation of Password Change| Tax Calculator and Submission';
						date_default_timezone_set('Asia/Kolkata');
						$time=date("d-m-Y h:i:sa");
						$mail->Body='Hello '.'<b>'.$user['name'].' '.$user['surname'].',</b>'.'<br><br>'.'Your account login password for Tax Calculator and Submission has been cahnge at: <p style="color:MediumSeaGreen">'.$time.'</p><br>..............................................................';
						$result = $mail->Send();
						unset($_SESSION['temp_PAN']);
						
						
						header('location: login.php');
						}
						catch (phpmailerException $e) {
					array_push($errors,$e->errorMessage());
					//Pretty error messages from PHPMailer
					} catch (Exception $e) {
					//Boring error messages from anything else!
					array_push($errors,$e->getMessage());
				}
					}
					else{
						array_push($errors, "Something went wrong, Please try again! ");
					}
					}
	}
	if(isset($_POST['calculate'])){
		$ifs=$_POST['ifs'];
		$catagory=$_POST['catagory'];
		$residence=$_POST['residence'];
		$ifhp=$_POST['ifhp'];
		$stcga=$_POST['stcga'];
		$ifb=$_POST['ifb'];
		$ifos=$_POST['ifos'];
		$ifa=$_POST['ifa'];
		$deductions=$_POST['deductions'];
		$gross=$_POST['gross'];
		$tax1=$_POST['tax1'];
		$tax2=$_POST['tax2'];
		$tax3=$_POST['tax3'];
		$tax4=$_POST['tax4'];
		$tax5=$_POST['tax5'];
		$tax6=$_POST['tax6'];
		$tax7=$_POST['tax7'];
		$tax8=$_POST['tax8'];
		$tax9=$_POST['tax9'];
		$tax10=$_POST['tax10'];
		$tax11=$_POST['tax11'];
		$tax12=$_POST['tax12'];
		$tax13=$_POST['tax13'];
		$tax14=$_POST['tax14'];
		$tax15=$_POST['tax15'];
		
		$success=1;
	}
	if(isset($_POST['filereturn'])){
		$success=1;
		$ifs=$_POST['ifs'];
		$catagory=$_POST['catagory'];
		$residence=$_POST['residence'];
		
		date_default_timezone_set('Asia/Kolkata');
		$time=date("Y-m-d H:i:s");
				
		$ifhp=$_POST['ifhp'];
		$stcga=$_POST['stcga'];
		$ifb=$_POST['ifb'];
		$ifos=$_POST['ifos'];
		$ifa=$_POST['ifa'];
		$deductions=$_POST['deductions'];
		$gross=$_POST['gross'];
		$tax1=$_POST['tax1'];
		$tax2=$_POST['tax2'];
		$tax3=$_POST['tax3'];
		$tax4=$_POST['tax4'];
		$tax5=$_POST['tax5'];
		$tax6=$_POST['tax6'];
		$tax7=$_POST['tax7'];
		$tax8=$_POST['tax8'];
		$tax9=$_POST['tax9'];
		$tax10=$_POST['tax10'];
		$tax11=$_POST['tax11'];
		$tax12=$_POST['tax12'];
		$tax13=$_POST['tax13'];
		$tax14=$_POST['tax14'];
		$tax15=$_POST['tax15'];
		$pan=$_SESSION['PAN'];
		
		$query="insert into bank values('','NA','$time','$pan','$catagory','$residence','$ifs','$ifhp','$stcga','$ifb','$ifos','$ifa','$deductions','$gross','$tax1','$tax2','$tax3','$tax4','$tax5','$tax6','$tax7','$tax8','$tax9','$tax10','$tax11','$tax12','$tax13','$tax14','$tax15')";
			$i=mysqli_query($con,$query);
			if($i){
				array_push($errors, "You have successfully Filed your Return.. ");
				$success=0;
				header('location: table.php');
			}
			else{
				array_push($errors, "Something went wrong, Please try again! ");
			}
		
	}
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
