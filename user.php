<?php include('server.php');
		
		//IF user is not logged in,then you cannot access this page
	if(empty($_SESSION['PAN'])){
		header('location: login.php');
	}
	else{
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
			unset($_SESSION['success']);
			unset($_SESSION['PAN']);
			header('location: login.php');
			session_destroy();
		} 
	}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/tax.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Tax Calculator and Submission</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="index.php" class="simple-text">
                        Tax Calculator and Submission
                    </a>
                </div>
                <ul class="nav">
                    <li >
                        <a class="nav-link" href="dashboard.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="table.php">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Previous Returns</p>
                        </a>
                    </li>
                    <li >
                        <a class="nav-link" href="calculator.php">
                            <i class="nc-icon nc-icon nc-notes"></i>
                            <p>File Return</p>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <a class="navbar-brand" href="#"> User Profile </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="no-icon">Account</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php?logout='1'">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
			<!--for fatching the user detail from Database
			<?php
				$con=mysqli_connect('localhost','root','','tax');
				$pan=$_SESSION['PAN'];
				$q1="select * from user where PAN='$pan'";
				$result=mysqli_query($con,$q1);
				$user = mysqli_fetch_assoc($result);
				if($user['fsurname']==""){
					$user['fsurname']="NA";
				}
			?>
            <!-- End Navbar -->
			
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
						<?php if($success==0){ ?>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
								<div><br>
									<!--Display Validation Errors here-->
									<?php include('errors.php'); ?>
								</div>
								
                                <div class="card-body">
                                    <form action="user.php" method="post">
									<div class="alert alert-warning">Basic Details</div>
                                        <div class="row">
										
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label>PAN</label>
                                                    <input type="text" class="form-control" name="PAN"disabled=""  value="<?php echo $user['PAN']; ?>">
                                                </div>
                                            </div>
											<div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <input type="text" class="form-control"  disabled="" value="<?php echo $user['dob'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" disabled="" value="<?php echo $user['name'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control"  disabled="" value="<?php echo $user['surname'];?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Father's First Name</label>
                                                    <input type="text" class="form-control" disabled="" value="<?php echo $user['fname'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Father's Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Father's Last Name" disabled="" value="<?php echo $user['fsurname'];?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" required="" placeholder="Email" name="email" value="<?php echo $user['email'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile"required="" value="<?php echo $user['mobile'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" placeholder="Address" name="address" required="" value="<?php echo $user['address'];?>">
                                                </div>
                                            </div>
                                        </div>
										<button type="submit" name="update" class="btn btn-info btn-fill pull-right" onclick="alert('Please Make sure Email and Mobile Number is Correct!..')" >Update Profile</button>
                                        <div class="clearfix"></div> <br>
										<div class="alert alert-warning">Change Password</div>
										
                                    </form>
									<form action="user.php" method="post">
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Old password</label>
                                                    <input type="password" class="form-control" required="" name="password" placeholder="Old Password" >
                                                </div>
                                            </div>
                                        </div>
										 <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>New password</label>
                                                    <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninvalid="setCustomValidity('Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters ')"onchange="try{setCustomValidity('')}catch(e){}"required="" name="password1" placeholder="New Password" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Confirm New Password</label>
                                                    <input type="password" class="form-control" name="password2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninvalid="setCustomValidity('Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters ')"onchange="try{setCustomValidity('')}catch(e){}"required="" placeholder="Confirm New Password">
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <button type="submit" name="passwordupdate" class="btn btn-info btn-fill pull-right">Change Password</button>
                                        <div class="clearfix"></div>
									</form><br>
									<div class="alert alert-warning">Change Profile Picture</div>
									<form action="user.php" method="POST" enctype="multipart/form-data">
										<label></label><input type="file" name="image" required="" />
										 <button type="submit" name="pic" class="btn btn-info btn-fill pull-right">Upload</button>
									</form>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="img/sidebar-3.jpg"  alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="<?php echo $user['image'];?>" alt="..."/>

                                      <h4 class="title"><?php echo $user['name']." ".$user['surname']; ?><br />
                                         <small><?php echo "(".$_SESSION['PAN'].")"; ?></small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> <?php echo $user['mobile'];?> <br>
                                                    <?php echo $user['email'];?>  <br><?php echo $user['address'];?> <br><br>
                                                  
                                </p>
                            </div>
                            
                        </div>
                    </div>
					<?php } else if($success==1){?>
				<div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
								<div><br>
									<!--Display Validation Errors here-->
									<?php include('errors.php'); ?>
								</div>
								
                                <div class="card-body">
                                    
									<form action="user.php" method="post">
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>OTP</label>
                                                    <input type="password" class="form-control" required="" name="otp" placeholder="One Time Password" >
                                                </div>
                                            </div>
                                        </div>
										
                                       
                                        
										<div class="row">
											<div class="col-md-6 ">
                                                <div >
                                                    <button type="reset"  class="btn btn-info btn-fill " value="Reset" >Reset</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div >
                                                    <button type="submit" name="submitotp" class="btn btn-info btn-fill pull-right">Verify OTP</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
			<?php } ?>
                    </div>
                </div>
            </div> 
           <footer class="footer">
                <div class="container">
                    <nav>
                        <p class="copyright text-center">
                           Copyright &copy; Tax Calculator And Submission 2018
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
    
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>


</html>