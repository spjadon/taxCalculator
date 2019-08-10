
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
                    <li >
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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
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
                    <a class="navbar-brand" href="#"> File Return </a>
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
				$pan=$_SESSION['PAN'];
				$q1="select * from user where PAN='$pan'";
				$result=mysqli_query($con,$q1);
				$user = mysqli_fetch_assoc($result);
				$dob=$user['dob'];
				//$interval=$dob->DIFF(new DateTime);
				$q2="select TIMESTAMPDIFF(YEAR,dob,CURDATE()) AS age from user where PAN='$pan'";
				$result2=mysqli_query($con,$q2);
				//$user2 = mysqli_fetch_assoc($result2);
				$row = $result2->fetch_assoc();
				$age=$row['age'];
			?>
			
            <!-- End Navbar -->
			
            <div  id="printform" class="content">
                <div class="container-fluid">
				
                    <div class="row">
						<div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="card">
								<?php if($success==0){?>
                                <div class="card-header">
								  <div class="row">
										
									<div class="col-md-10" > <h4 class="card-title">Income Tax Calculator</h4></div>
                                    <div class="col-md-2" > <button type="button" onclick="printform()" class="btn btn-info">&#128439&nbspPrint</button></div>
                                  </div><br>
								  <div>
									<!--Display Validation Errors here-->
									<?php include('errors.php'); ?>
								  </div>
								</div>
                                <div class="card-body">
                                    <form  action="calculator.php" method="post">
										<div class="alert alert-warning">BASIC DETAILS</div>
										
                                        <div class="row">
												 <div class="col-md-6 ">
													<label>Residential Status</label>
													<select id="residence" name="residence" class="col-md-12" onchange="popup()" >
														<option value="select">Select</option>
														<option value="Resident">Resident</option>
														<option value="Non-Resident">Non-Resident</option>
														<option value="Not Ordinary Residance">Not Ordinary Residance</option>
													</select>
												</div>
											 <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Catagory</label>
													<?php if($age<60){ ?>
														<input type="text" name="catagory"class="form-control" id="catagory" readonly="" value="<?php echo $user['sex'];?>">
													<?php } else if($age>=60 && $age<80){ ?>
														<input type="text" name="catagory"class="form-control" id="catagory" readonly="" value="Senior Citizen">
													<?php } else if($age>=80){ ?>
														<input type="text" name="catagory"class="form-control" id="catagory" readonly="" value="Super Senior Citizen">
													<?php } ?>
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Age</label>
													<input type="text" class="form-control" disabled="" value="<?php echo $age." Years";?>">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="name" readonly="" value="<?php echo $user['name'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="surname" readonly="" value="<?php echo $user['surname'];?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Father's First Name</label>
                                                    <input type="text" class="form-control" readonly=""name="fname"  value="<?php echo $user['fname'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Father's Last Name</label>
                                                    <input type="text" class="form-control"name="fsurname" placeholder="Father's Last Name" readonly="" value="<?php echo $user['fsurname'];?>">
                                                </div>
                                            </div>
                                        </div>
						<!--Income from Salary -->

							<div id="fullForm">
										<div class="alert alert-primary" >INCOME FROM SALARY <button type="button" onclick="salary1()" id="p0" class="btn btn-success btn-sm">Show Details</button><button type="button" id="p1"onclick="salary2()" class="btn btn-danger btn-sm">Hide Details</button></div>
									<div id="salaryForm">
										<div class="row" >
											<div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Income from Salary </label>
                                                    <input type="number" min="0" class="form-control" id="ifs" name="ifs" onchange="house1b()" placeholder="Income from Salary" value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>
										
					<!--Income From House Property-->
										<div class="alert alert-primary">INCOME FROM HOUSE PROPERTY <button type="button" onclick="house1()"id="p2" class="btn btn-success btn-sm">Show Details</button><button type="button" id="p3"onclick="house2()" class="btn btn-danger btn-sm">Hide Details</button></div>
									<div id="houseForm">
										<div class="row">
											<div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Income From House Property</label>
                                                    <input type="text" min="0" class="form-control" id="ifhp" name="ifhp" readonly=""  value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>a. Interest Paid/Payable on Housing Loan for Current Financial Year Interest Paid/Payable on Housing Loan <h6><br>
										<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>1. Interest on Housing Loan</label>
                                                    <input type="number" min="0" class="form-control" id="a1a" onchange="house1b()" placeholder="Interest on Housing Loan" value="0">
                                                </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Income from Self-occupied House Property</label>
                                                    <input type="text"  class="form-control" id="a1b"  disabled="" value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>b. Income from Let-out Property</h6><br>
										<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>1. Annual Letable Value/Rent Received</label>
                                                    <input type="number" min="0" class="form-control"  id="b1" onchange="house1b()" placeholder="1. Annual Letable Value/Rent Received" value="0">
                                                </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label>2. Less: Municipal Taxes Paid During the Year</label>
                                                    <input type="number" min="0" class="form-control"  id="b2" placeholder="2. Less: Municipal Taxes Paid During the Year"onchange="house1b()" value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>3. Less:Unrealized Rent</label>
                                                    <input type="number" min="0" class="form-control" id="b3" onchange="house1b()" placeholder="3. Less:Unrealized Rent" value="0">
                                                </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label>4. Net Annual Value (1-(2+3))</label>
                                                    <input type="text"  class="form-control"  id="b4"  disabled="" value="0">
                                                </div>
                                            </div>
                                        </div>
										<label>Less: Deductions from Net Annual Value</label><br>
										<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>i. Standard Deduction @30% of Net Annual Value</label>
                                                    <input type="text"  class="form-control" id="hi"  disabled="" value="0">
                                                </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ii. Interest on Housing Loan</label>
                                                    <input type="number" min="0" class="form-control" id="h2" placeholder="ii. Interest on Housing Loan" onchange="house1b()" value="0">
                                                </div>
                                            </div>
                                        </div>
										 <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Income from Let-out House Property</label>
                                                    <input type="text"  class="form-control" id="h3"  disabled="" value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>
							<!--Income FROM Capital GainS -->
										<div class="alert alert-primary">CAPITAL GAINS<button type="button"id="p4" onclick="capital1()" class="btn btn-success btn-sm">Show Details</button><button type="button"id="p5" onclick="capital2()" class="btn btn-danger btn-sm">Hide Details</button></div>
									<div id="capitalForm">
										<h6>Short Term Capital GainS (Other than covered under section 111A)</h6>
										<div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 01/04/2017 to 15/06/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="stcga1"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/06/2017 to 15/09/2017</label>
                                                    <input type="number" min="0" class="form-control" id="stcga2" onchange="house1b()"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/09/2017 to 15/12/2017</label>
                                                    <input type="number" min="0" class="form-control" id="stcga3" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/12/2017 to 15/03/2018</label>
                                                    <input type="number" min="0" class="form-control"  id="stcga4" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/03/2018 to 31/03/2018</label>
                                                    <input type="number" min="0" class="form-control"  id="stcga5" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label ><br>total</label>
                                                    <input type="text"  class="form-control" id="stcga" name="stcga" readonly="" value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Short Term Capital GainS (Covered under section 111A)</h6>
										<div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 01/04/2017 to 15/06/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="stcgb1"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/06/2017 to 15/09/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="stcgb2"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/09/2017 to 15/12/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="stcgb3" value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/12/2017 to 15/03/2018</label>
                                                    <input type="number" min="0" class="form-control" id="stcgb4"  onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/03/2018 to 31/03/2018</label>
                                                    <input type="number" min="0" class="form-control" id="stcgb5"  onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label ><br>total</label>
                                                    <input type="text" class="form-control" id="stcgb"  disabled="" value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Long Term Capital Gains (Charged to tax @ 20%)</h6>
										<div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 01/04/2017 to 15/06/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="ltcga1"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/06/2017 to 15/09/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="ltcga2"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/09/2017 to 15/12/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="ltcga3" value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/12/2017 to 15/03/2018</label>
                                                    <input type="number" min="0" class="form-control"  onchange="house1b()" id="ltcga4"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/03/2018 to 31/03/2018</label>
                                                    <input type="number" min="0" class="form-control"  onchange="house1b()" id="ltcga5"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label ><br>total</label>
                                                    <input type="text"  class="form-control"  id="ltcga" disabled="" value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Long Term Capital Gains (Charged to tax @ 10%)</h6>
										<div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 01/04/2017 to 15/06/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="ltcgb1"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/06/2017 to 15/09/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="ltcgb2"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/09/2017 to 15/12/2017</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="ltcgb3" value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/12/2017 to 15/03/2018</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="ltcgb4"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From 16/03/2018 to 31/03/2018</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="ltcgb5"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-2">
                                                <div class="form-group">
                                                    <label ><br>total</label>
                                                    <input type="text" min="0" class="form-control" id="ltcgb"  disabled="" value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>	
						<!--Income from other sources-->
										<div class="alert alert-primary">INCOME FROM OTHER SOURCES<button type="button" id="p6"onclick="other1()" class="btn btn-success btn-sm">Show Details</button><button type="button" id="p7"onclick="other2()" class="btn btn-danger btn-sm">Hide Details</button></div>
									<div id="otherForm">
										<div class="row">
											<div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Income From Other Sources</label>
                                                    <input type="text"  class="form-control" id="ifos" name="ifos" readonly=""  value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Interest</label>
                                                    <input type="number" min="0" class="form-control" id="interest" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Commission/Other Income</label>
                                                    <input type="number" min="0" class="form-control"  id="commission"  onchange="house1b()" value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Winnings from Lottery, Crossword Puzzles, etc.</label>
                                                    <input type="number" min="0" class="form-control" id="lottery" onchange="house1b()" value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>
								<!-- Income From Business -->
										<div class="alert alert-primary">INCOME FROM BUSINESS OR PROFESSION<button type="button" id="p8"onclick="bussiness1()" class="btn btn-success btn-sm">Show Details</button><button type="button"id="p9" onclick="bussiness2()" class="btn btn-danger btn-sm">Hide Details</button></div>
									<div id="bussinessForm">
										<div class="row">
											<div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Profits and Gains of Business or Profession (enter profit only)</label>
                                                    <input type="number" min="0" class="form-control" name="ifb" id="ifb" onchange="house1b()" value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>
								<!--Income From Agricultural-->
										<div class="alert alert-primary">INCOME FROM AGRICULTURE<button type="button"id="p10" onclick="agri1()" class="btn btn-success btn-sm">Show Details</button><button type="button" id="p11"onclick="agri2()" class="btn btn-danger btn-sm">Hide Details</button> </div>
									<div id="agriForm">
										<div class="row">
											<div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Agricultural Income</label>
                                                    <input type="number" min="0" class="form-control" name="ifa" onchange="house1b()" id="ifa" value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>
								<!-- Deduction-->
										<div class="alert alert-primary">DEDUCTIONS<button type="button" id="p12"onclick="deductionsa()" class="btn btn-success btn-sm">Show Details</button><button type="button"id="p13" onclick="deductionsb()" class="btn btn-danger btn-sm">Hide Details</button></div>
									<div id="deductionsForm">
										<div class="row">
											<div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>DEDUCTIONS</label>
                                                    <input type="text" min="0" class="form-control" name="deductions"id="deductions" readonly="" value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>UNDER SECTION 80C<h6>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Life Insurance premium paid</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="deductions1"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Payment for annuity plan</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="deductions2"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Contribution toward provident fund / PPF</label>
                                                    <input type="number" min="0" class="form-control" id="deductions3" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Investment in NSC (VIII issue) + Interest</label>
                                                    <input type="number" min="0" class="form-control" id="deductions4" onchange="house1b()"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Contribution toward ULIP</label>
                                                    <input type="number" min="0" class="form-control" id="deductions5"  onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Contribution toward notified pension fund by MF/UTI</label>
                                                    <input type="number" min="0" class="form-control" id="deductions6" onchange="house1b()"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Re-payment of housing loan etc</label>
                                                    <input type="number" min="0" class="form-control" id="deductions7" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Tuition fees paid for children</label>
                                                    <input type="number" min="0" class="form-control"  id="deductions8" onchange="house1b()" value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>5 Years fixed deposit with PO or Schedule Bank</label>
                                                    <input type="number" min="0" class="form-control" id="deductions9" onchange="house1b()"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br><br>Contribution toward NPF</label>
                                                    <input type="number" min="0" class="form-control"  id="deductions10" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Employee's / Self-employed contribution toward NPS (up to 20%) (u/s 80CCD)</label>
                                                    <input type="number" min="0" class="form-control" id="deductions11" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Additional contribution towards NPS [u/s 80CCD(1B)]</label>
                                                    <input type="number" min="0" class="form-control"  id="deductions12" onchange="house1b()" value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Employer's contribution toward NPS (up to 20%) (u/s 80CCD)</label>
                                                    <input type="number" min="0" class="form-control"  id="deductions13" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Long-term infrastructure bonds (u/s 80CCF)</label>
                                                    <input type="number" min="0" class="form-control" id="deductions14" onchange="house1b()"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Investment under equity saving scheme (u/s 80CCG)</label>
                                                    <input type="number" min="0" class="form-control" id="deductions15" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Deposit with Sukanya Samridhi Accounts</label>
                                                    <input type="number" min="0" class="form-control" id="deductions16" onchange="house1b()"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Any other deductable (u/s 80C)</label>
                                                    <input type="number" min="0" class="form-control" id="deductions17" onchange="house1b()"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Total</label>
                                                    <input type="text" min="0" class="form-control"  id="deductiontotal" disabled=""  value="0">
                                                </div>
                                            </div>
											
                                        </div>
										<h6>UNDER SECTION 80D<h6>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br><br>Medi-claim premium (u/s 80D)</label>
                                                    <input type="number" min="0" class="form-control"  id="dd801" onchange="house1b()"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Actual payment towards medical treatment (u/s 80DDB )</label>
                                                    <input type="number" min="0" class="form-control"  id="dd802" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br><br>Donations (u/s 80G)</label>
                                                    <input type="number" min="0" class="form-control" id="dd803" onchange="house1b()" value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Deduction for maintenance / medical treatment of dependent (u/s 80DD)</label>
                                                    <input type="text" id="dd804" class="form-control"  disabled=""  value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="checkbox" id="dd80" onclick="house1b()">  Tick if 80DD is claimed
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="checkbox" id="dd80d" onclick="house1b()">  Tick if severe disability
                                                </div>
                                            </div>
										</div>
										
										<h6>UNDER SECTION 80U<h6>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Interest on loan for higher education (u/s 80E)</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="u801"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>interest on loan taken for Residential House (u/s 80EE)</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="u802"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Deduction in case of a person with disability (u/s 80U)</label>
                                                    <input type="text"  id="u803" class="form-control"  disabled="" value="0">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="checkbox" id="u80" onclick="house1b()">  Tick if 80U is claimed
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="checkbox" id="u80d" onclick="house1b()">  Tick if severe disability
                                                </div>
                                            </div>
										</div>
										<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Interest on deposits in saving account (u/s 80TTA)</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()"  id="deductions18"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label><br>Any other deductions</label>
                                                    <input type="number" min="0" class="form-control" onchange="house1b()" id="deductions19"  value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>
									<!--Gross Income -->
										<div class="alert alert-primary">NET TAXABLE INCOME<button type="button" onclick="gross1()"id="p14" class="btn btn-success btn-sm">Show Details</button><button type="button" id="p15"onclick="gross2()" class="btn btn-danger btn-sm">Hide Details</button> </div>
									<div id="grossForm">
										<div class="row">
											<div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Net Taxable Income</label>
                                                    <input type="number" readonly="" class="form-control" name="gross" id="netTaxableAmount"   value="0">
                                                </div>
                                            </div>
                                        </div>
									</div>
									<!--Calculation -->
										<div class="alert alert-primary">TAX CALCULATION<button type="button" id="p16"onclick="calculation1()" class="btn btn-success btn-sm">Show Details</button><button type="button" id="p17"onclick="calculation2()" class="btn btn-danger btn-sm">Hide Details</button> </div>
									<div id="calculationForm">
										<h6>Income Liable to Tax at Normal Rate ---</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Taxable Amount</label>
                                                    <input type="text" readonly="" name="tax1"class="form-control" id="taxAtNormala"   value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
													<label>Tax</label>
                                                    <input type="text" readonly="" name="tax2"class="form-control"  id="taxAtNormalt"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Short Term Capital Gains (Covered u/s 111A) 15%</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Taxable Amount</label>
                                                    <input type="text" readonly=""name="tax3" class="form-control" id="stcg15a"   value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
													<label>Tax</label>
                                                    <input type="text" readonly=""name="tax4" class="form-control"  id="stcg15t"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Long Term Capital Gains (Charged to tax @ 20%) 20%</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Taxable Amount</label>
                                                    <input type="text" readonly=""name="tax5" class="form-control"  id="ltcg20a"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
													<label>Tax</label>
                                                    <input type="text" readonly="" name="tax6"class="form-control"    id="ltcg20t"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Long Term Capital Gains (Charged to tax @ 10%) 10%</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Taxable Amount</label>
                                                    <input type="text" readonly="" name="tax7"class="form-control"  id="ltcg10a"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
													<label>Tax</label>
                                                    <input type="text" readonly="" name="tax8"class="form-control"  id="ltcg10t"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Winnings from Lottery, Crossword Puzzles, etc) 30%</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Taxable Amount</label>
                                                    <input type="text" readonly=""name="tax9" class="form-control"  id="lottery2"  value="0">
                                                </div>
                                            </div>
											<div class="col-md-3">
                                                <div class="form-group">
													<label>Tax</label>
                                                    <input type="text" readonly="" name="tax10" class="form-control"  id="lotterytax"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Income Tax after relief u/s 87A</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label></label>
                                                    <input type="text" readonly="" name="tax11" class="form-control"  id="a87"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Surcharge</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    
                                                    <input type="text" readonly="" name="tax12"class="form-control" id="surcharge"   value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Education Cess</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    
                                                    <input type="text" readonly="" name="tax13"class="form-control"  id="ecess"  value="0">
                                                </div>
                                            </div>
                                        </div>
										<h6>Secondary and higher education cess</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    
                                                    <input type="text" readonly="" name="tax14"class="form-control"   id="scess" value="0">
                                                </div>
                                            </div>
                                        </div>
								</div>
										<h6>Total Tax Liability</h6>
										<div class="row">
											<div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    
                                                    <input type="text" readonly="" name="tax15" class="form-control" name="totalLiability" id="totalLiability"  value="0">
                                                </div>
                                            </div>
                                        </div>
										 <button type="submit" name="calculate" class="btn btn-info btn-fill pull-right">Submit</button>
                                        <div class="clearfix"></div>
										
							</div>
                                    </form>
                                </div>
								
								<?php } else if($success==1){ ?>
									
									 <div class="col-lg-10 mx-auto text-center"><br>
										<img src="img/tax.png" alt="Tax Calculator and Submission" height="100" width="120"><br><br>
										<h2 class="text-uppercase">
										<strong>Tax Calculator And<br> Submission</strong>
										</h2>
										<hr>
									</div>
								<div class="card-header ">
                                    <h4 class="card-title">Entered Return Details</h4>
								</div>
								<?php if(($ifs==0 and $ifhp==0 and $stcga==0 and $ifb==0 and $ifos==0 and $deductions==0 and $gross==0) and $tax15==0){ ?>
									<div class="alert alert-warning"><b>You have Entered Incorrect Information! Please, try with correct Information...<b><a href="calculator.php" class="btn btn-danger btn-sm pull-right">Go Back<a></div>
								<?php } ?>
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
														<td><?php echo $_SESSION['PAN'] ?></td> 
													</tr>
													<tr>
														<td>Tax Payer</td> 
														<td>Individual</td> 
													</tr>
													<tr>
														<td>Catagory</td> 
														<td><?php echo $catagory?></td> 
													</tr>
													<tr>
														<td>Residance</td> 
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
														<td><b style="color:green">Total Tax Liability</b></td> 
														<td><b style="color:green"><?php echo "&#x20b9;".$tax15 ?><b></td> 
													</tr>
													
											
												</tbody>
												</table>
                                            </div>
                                        </div>
                                </div>
								<div>
									<?php if(($ifs>0 or $ifhp>0 or $stcga>0 or $ifb>0 or $ifos>0 or $deductions>0 or $gross>0) && $tax15>0){?>
									<form class="paypal" action="payments.php" method="post" id="paypal_form">
											<input type="hidden" name="cmd" value="_xclick">
											<input type="hidden" name="lc" value="UK">
											<input type="hidden" name="item_name" value="Tax Calculator and Submission">
											<input type="hidden" name="item_number" value="<?php echo $_SESSION['PAN'];?>">
											
											
											<input type="hidden" name="first_name" value="<?php echo $user['name'];?>" />
											<input type="hidden" name="last_name" value="<?php echo $user['surname'];?>" />
											<input type="hidden" name="payer_email" value="<?php echo $user['email'];?>" />
											<input type="hidden" name="no_note" value="1">
											<input type="hidden" name="amount" value="500.00">
											 
											<input type="hidden" name="currency_code" value="GBP">
											<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
										
											<input type="submit"  name="payment"   class="btn btn-info btn-fill pull-right ">
											<div class="clearfix"> </div>
									</form>
									<?php } else if(($ifs>0 or $ifhp>0 or $stcga>0 or $ifb>0 or $ifos>0 or $deductions>0 or $gross>0) and $tax15==0){ ?>
										<form action="calculator.php" method="post">
											<input type="hidden" name="PAN" value="<?php echo $_SESSION['PAN']; ?>">
											<input type="hidden" name="catagory" value="<?php echo $catagory; ?>">
											<input type="hidden" name="residence" value="<?php echo $residence; ?>">
											
											
											<input type="hidden" name="ifs" value="<?php echo $ifs;?>">
											<input type="hidden" name="ifhp" value="<?php echo $ifhp;?>">
											<input type="hidden" name="stcga" value="<?php echo $stcga;?>">
											<input type="hidden" name="ifb" value="<?php echo $ifb;?>">
											<input type="hidden" name="ifa" value="<?php echo $ifa;?>">
											<input type="hidden" name="ifos" value="<?php echo $ifos;?>">
											<input type="hidden" name="deductions" value="<?php echo $deductions;?>">
											<input type="hidden" name="gross" value="<?php echo $gross;?>">
											
											<input type="hidden" name="tax1" value="<?php echo $tax1;?>" />
											<input type="hidden" name="tax2" value="<?php echo $tax2;?>" />
											<input type="hidden" name="tax3" value="<?php echo $tax3;?>" />
											<input type="hidden" name="tax4" value="<?php echo $tax4;?>" />
											<input type="hidden" name="tax5" value="<?php echo $tax5;?>" />
											<input type="hidden" name="tax6" value="<?php echo $tax6;?>" />
											<input type="hidden" name="tax7" value="<?php echo $tax7;?>" />
											<input type="hidden" name="tax8" value="<?php echo $tax8;?>" />
											<input type="hidden" name="tax9" value="<?php echo $tax9;?>" />
											<input type="hidden" name="tax10" value="<?php echo $tax10;?>" />
											<input type="hidden" name="tax11" value="<?php echo $tax11;?>" />
											<input type="hidden" name="tax12" value="<?php echo $tax12;?>" />
											<input type="hidden" name="tax13" value="<?php echo $tax13;?>" />
											<input type="hidden" name="tax14" value="<?php echo $tax14;?>" />
											<input type="hidden" name="tax15" value="<?php echo $tax15;?>" />
											
											<input type="submit"  name="filereturn" value="Next"  class="btn btn-info btn-fill pull-right ">
											<div class="clearfix"></div>
									</form>
									<?php }  ?>
										
								</div>
								<?php }  ?>
								
								
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