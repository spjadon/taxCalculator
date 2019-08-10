<?php include('adminserver.php');
		//IF user is not logged in,then you cannot access this page
	if(empty($_SESSION['adminid'])){
		header('location: admin_login.php');
	}
	else{
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
			unset($_SESSION['success']);
			unset($_SESSION['admin']);
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
                        <a class="nav-link" href="admin_dashboard.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
					<li>
                        <a class="nav-link" href="admin_return_list.php">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Returns Detail</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
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
                    <a class="navbar-brand" href="#"> User Details </a>
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
                                <a class="nav-link" href="userlist.php?adminlogout='1'">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
			<div>
				<!--Display Validation Errors here-->
				<?php include('errors.php'); ?>
			</div>
			<!--for fatching the user detail from Database
			<?php
				$con=mysqli_connect('localhost','root','','tax');
				$pan=$_SESSION['PAN'];
				$q1="select * from user where PAN='$pan'";
				$result=mysqli_query($con,$q1);
				$user = mysqli_fetch_assoc($result);
			?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Users Profile List</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>PAN</th>
											<th>Picture</th>
											<th>Name</th>
											<th>Father's Name</th>
											<th>Email</th>
											<th>Mobile</th>
											 <th>View Deatils</th> 
                                        </thead>
                                        <tbody>
                                            <?php
											$con=mysqli_connect('localhost','root','','tax');
											$q1="select * from user";
											$result=mysqli_query($con,$q1);
											while ($row = $result->fetch_assoc()) {
												$userid=$row['PAN']; $name=$row['name']." ".$row['surname']; $fname=$row['fname']." ".$row['fsurname']; $email=$row['email']; $mobile=$row['mobile'];$image=$row['image'];
											?>	
											<tr>	<td><?php echo $userid ; ?></td> 
													<td><a href="<?php echo $image;?>"><img  src="<?php echo $image;?>" height=100 width=100 /></a></td>
												<td><?php	echo $name;  ?></td>  
												<td><?php echo  $fname; ?></td>  
												<td><?php echo  $email; ?></td>
												<td><?php echo  $mobile; ?></td>
												<td><form action="view_user.php" method="post">
													<input type="hidden" name="view" value="<?php echo $userid; ?>">
													<input type="submit"  name="viewuser"  value="View Details" class="btn btn-success ">
												<div class="clearfix"></div>
												</form>
												</td></tr>
										<?php } ?> 
											
                                        </tbody>
                                    </table>
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


</html>