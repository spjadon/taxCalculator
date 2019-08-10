
<?php include('server.php');
		//IF user is not logged in,then you cannot access this page
	if(empty($_SESSION['PAN'])){
		header('location: login.php');
	}
	else if(empty($_POST['viewreturn'])){
		header('location: table.php');
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
                    <li >
                        <a class="nav-link" href="user.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Previous Returns</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="calculator.php">
                            <i class="nc-icon nc-notes"></i>
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
                    <a class="navbar-brand" href="#">  View Return </a>
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
			<?php
				$con=mysqli_connect('localhost','root','','tax');
				
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
							</div>
									<div class="row">
                                            <div class="col-sm-9">
                                                <h4><?php echo "Return ID: <b>RET".$returnID."</b>" ?></h4>
                                            </div>
                                            <div class="col-sm-3">
                                                <h4><?php echo "Date: <b>".$time->format('d-m-Y')."</b>" ?></h4>
                                            </div>
                                      </div>
                                <div class="card-body table-full-width table-responsive">
                                   
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
													<div class="alert alert-info">BASIC DETAILS</div>
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
														<td>Tax Payer</td> 
														<td>Individual</td> 
													</tr>
													<tr>
														<td>Catagory</td> 
														<td><?php echo $catagory ?></td> 
													</tr>
													<tr>
														<td>Residential Status</td> 
														<td><?php echo $residence?></td> 
													</tr>
													<tr>
														<td>Name</td> 
														<td><?php echo $user['name']." ".$user['surname']?></td> 
													</tr>
													<tr>
														<td>Father's Name</td> 
														<td><?php echo $user['fname']." ".$user['fsurname']?></td> 
													</tr>
												</tbody>
												</table>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
													<div class="alert alert-primary">INCOME FROM DIFFERENT HEADS</div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
											<table class="table table-hover table-striped">
                                                <tbody>
													<tr>
														<td>Income from Salary</td> 
														<td><?php echo "&#x20b9;".$ifs ?></td> 
													</tr>
													<tr>
														<td>Income from House Property</td> 
														<td><?php echo "&#x20b9;".$ifhp ?></td> 
													</tr>
													<tr>
														<td>Income from Capital Gains</td> 
														<td><?php echo "&#x20b9;".$stcga ?></td> 
													</tr>
													<tr>
														<td>Income From Bussiness</td> 
														<td><?php echo "&#x20b9;".$ifb ?></td> 
													</tr>
													<tr>
														<td>Income From Other Sources</td> 
														<td><?php echo "&#x20b9;".$ifos ?></td> 
													</tr>
													<tr>
														<td>Income From Agriculture</td> 
														<td><?php echo "&#x20b9;".$ifa ?></td> 
													</tr>
													<tr>
														<td>Deductions</td> 
														<td><?php echo "&#x20b9;".$deductions ?></td> 
													</tr>
													<tr>
														<td>Gross Income</td> 
														<td><?php echo "&#x20b9;".$gross ?></td> 
													</tr>
												</tbody>
												</table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group"><br>
													<div class="alert alert-warning">TAX CALCULATION</div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
											<table class="table table-hover table-striped">
											<thead>
												<th></th>
												<th>Taxable Amount</th>
												<th>Tax</th>
												
											</thead>
                                                <tbody>
													
													<tr>
														<td>Tax at Normal Rates</td> 
														<td><?php echo "&#x20b9;".$tax1 ?></td>
														<td><?php echo "&#x20b9;".$tax2 ?></td>
													</tr>
													<tr>
														<td>STCG (u/s 111A)</td> 
														<td><?php echo "&#x20b9;".$tax3 ?></td> 
														<td><?php echo "&#x20b9;".$tax4 ?></td>
													</tr>
													<tr>
														<td>LTCG(20%)</td> 
														<td><?php echo "&#x20b9;".$tax5 ?></td> 
														<td><?php echo "&#x20b9;".$tax6 ?></td>
													</tr>
													<tr>
														<td>LTCG(10%)</td> 
														<td><?php echo "&#x20b9;".$tax7 ?></td> 
														<td><?php echo "&#x20b9;".$tax8 ?></td>
													</tr>
													<tr>
														<td>Winning from Lottery etc.</td> 
														<td><?php echo "&#x20b9;".$tax9 ?></td> 
														<td><?php echo "&#x20b9;".$tax10 ?></td>
													</tr>
													
												</tbody>
												</table>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
													<div class="alert alert-success">TAX LIABILITY</div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
											<table class="table table-hover table-striped">
                                                <tbody>
													<tr>
														<td>Income Tax after relief 87A</td> 
														<td><?php echo "&#x20b9;".$tax11 ?></td> 
														
													</tr>
													<tr>
														<td>Surcharge</td> 
														<td><?php echo "&#x20b9;".$tax12 ?></td>
													</tr>
													<tr>
														<td>Education Cess</td> 
														<td><?php echo "&#x20b9;".$tax13 ?></td> 
													</tr>
													<tr>
														<td>SHE Cess</td> 
														<td><?php echo "&#x20b9;".$tax14 ?></td> 
													</tr>
													<tr>
														<td>Total Tax Liability</td> 
														<td><?php echo "&#x20b9;".$tax15 ?></td> 
													</tr>
													
											
												</tbody>
												</table>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
													<div class="alert alert-info">BANK DETAILS</div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
											<table class="table table-hover table-striped">
                                                <tbody>
													<tr>
														<td>Transaction ID</td> 
														<td><?php echo $transID ?></td>
													</tr>
													<?php if($transID=='NA'){?>
													<tr>
														<td>Date</td> 
														<td><?php echo "NA" ?></td> 
														
													</tr>
													<tr>
														<td>Amount</td> 
														<td><?php echo "NA" ?></td> 
													</tr>
													<?php } else{ 
													$q3="select * from payment where txnid='$transID'";
													$result4=mysqli_query($con,$q3);
													$payment = mysqli_fetch_assoc($result4);
													
													?>
													<tr>
														<td>Date</td> 
														<td><?php echo $payment['createdtime']; ?></td> 
														
													</tr>
													<tr>
														<td>Amount</td> 
														<td><?php echo "&#x20b9;".$payment['payment_amount']; ?></td> 
													</tr>
													<?php }  ?>
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