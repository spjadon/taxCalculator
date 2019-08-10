
<?php 
	include('adminserver.php');
		//IF user is not logged in,then you cannot access this page
	if(empty($_SESSION['adminid'])){
		header('location: admin_login.php');
	}
	else if(empty($_POST['viewuser'])){
		header('location: admin_return_list.php');
	}
	else{
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
			unset($_SESSION['success']);
			unset($_SESSION['admin']);
			echo '<script> alert("You have successfully Registered, Now you are logged in.")</script>';
			header('location: admin_login.php');
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
                    <li>
                        <a class="nav-link" href="admin_dashboard.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
					</li>
					<li >
                        <a class="nav-link" href="admin_return_list.php">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Returns Detail</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="userlist.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>User Details</p>
                        </a>
                    </li>
                    <li >
                        <a class="nav-link" href="edit_admin.php">
                            <i class="nc-icon nc-icon nc-notes"></i>
                            <p>Edit User</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <a class="navbar-brand" href="userlist.php">  User Details </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="edit_admin.php">
                                    <span class="no-icon">Account</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_return_list.php?adminlogout='1'">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
			<?php
				$con=mysqli_connect('localhost','root','','tax');
				$pan=($_POST['view']);
				$q="select * from user where PAN='$pan'";
				$result2=mysqli_query($con,$q);
				$user = mysqli_fetch_assoc($result2);
			?>
			
            <!-- End Navbar -->
			
            <div  id="printform" class="content">
                <div class="container-fluid">
												
                    <div class="row">
						<div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="card">
							<div class="col-lg-10 mx-auto text-center"><br>
								<img src="img/tax.png" alt="Tax Calculator and Submission" height="100" width="120"><br><br>
								<h2 class="text-uppercase">
								<strong>Tax Calculator And<br> Submission</strong>
								</h2><hr>
								<a href="<?php echo $user['image'];?>"><img  src="<?php echo $user['image'];?>"  height="120" width="140" alt="..."></a>
							</div>
									
                                <div class="card-body table-full-width table-responsive">
											
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
													<div class="alert alert-info">BASIC DETAIL</div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
											<table class="table table-hover table-striped">
                                                <tbody>
													<tr>
														<td>PAN</td>
														<td><?php echo $pan ?></td> 
													</tr>
													
													<tr>
														<td>Name</td> 
														<td><?php echo $user['name']." ".$user['surname'];?></td> 
													</tr>
													<tr>
														<td>Father's Name</td> 
														<td><?php echo $user['fname']." ".$user['fsurname']?></td> 
													</tr>
													<tr>
														<td>Sex</td> 
														<td><?php echo $user['sex'];?></td> 
													</tr>
													<tr>
														<td>Date Of Birth</td> 
														<td><?php echo $user['dob']?></td> 
													</tr>
												</tbody>
												</table>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
													<div class="alert alert-info">CONTACT INFORMATION</div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
											<table class="table table-hover table-striped">
                                                <tbody>
													<tr>
														<td>Mobile Number</td> 
														<td><?php echo $user['mobile'] ?></td>
													</tr>
													
													<tr>
														<td>Email Address</td> 
														<td><?php echo $user['email'] ?></td> 
														
													</tr>
													<tr>
														<td>Address</td> 
														<td><?php echo $user['address'] ?></td> 
													</tr>
													
												</tbody>
												</table>
                                            </div>
                                        </div>
                                </div>
								
								
								
                            </div>
                        </div>
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
<!--Calculator JavaScript-->
<script src="calculator.js" type="text/javascript"></script>

</html>