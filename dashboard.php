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
  <link rel="icon" type="image/png" href="img/tax.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Tax Calculator and Submission</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
	
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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="user.php">
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
                    <a class="navbar-brand" href="#"> Dashboard </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="user.php">
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
			
            <!-- End Navbar -->
			<?php 
				$con=mysqli_connect('localhost','root','','tax');
				$pan=$_SESSION['PAN'];
				$q="select * from user where PAN='$pan' ";
				$result=mysqli_query($con,$q);
				$user = mysqli_fetch_assoc($result);
				//TOTAL NUMBERS OF RETURN FILED
				$q2="select count(*) as total from bank where PAN='$pan'";
				$result1=mysqli_query($con,$q2);
				$count = mysqli_fetch_assoc($result1);
				//LAST RETURNS FILED
				$q3="select date as total2 from bank where PAN='$pan' order by returnID desc ";
				$result2=mysqli_query($con,$q3);
				$count2=mysqli_fetch_assoc($result2);
				if($count2['total2']==""){
					$count2['total2']='NA';
				}
				// TOTAL AMOUNT PAID
				$q4="select sum(tax15) as total3 from bank where PAN='$pan'";
				$result3=mysqli_query($con,$q4);		
				$count3=mysqli_fetch_assoc($result3);
					if($count3['total3']==""){
						$count3['total3']='NA';
					}else{
						$count3['total3']=" &#x20b9;".$count3['total3'];
					}
			?>
            
			 <div class="content">
			<div class="container-fluid">
	
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
							<div class="col-lg-10 mx-auto text-center"><br>
								<img src="img/tax.png" alt="Tax Calculator and Submission" height="63" width="83"><br><br>
								<h4 class="text-uppercase">
								<strong>Tax Calculator And<br> Submission</strong>
								</h4><hr>
								 <div class="author">
									  
                                     <a href="user.php">
									
                                      <h4 class="title"><?php echo $user['name']." ".$user['surname']; ?>
                                         <small><?php echo "(".$_SESSION['PAN'].")"; ?></small>
                                      </h4>
                                    </a>
                                </div>
							</div>
                                <div class="card-header ">
								 
                                    <h4 class="card-title">At a Glance</h4>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Total Numbers of Return Filed</th>
											<th>Last Returns Filed</th>
                                            <th>Total Amount paid</th>
                                        </thead>
                                        <tbody>
                                            <th><?php echo $count['total']; ?></th>
											<th><?php echo $count2['total2'];?></th>
											<th><?php echo $count3['total3'];?></th>
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