<?php include('server.php'); 
		//IF user is  logged in,then you cannot access this page
	if(!empty($_SESSION['temp_PAN'])){
		if(((time() - $_SESSION['loggedin_time']) > $temp_session)){ 
			unset($_SESSION['temp_PAN']);
			header('location: signup.php');
			session_destroy();
		} }
	
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tax Calculator and Submission</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets2/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets2/css/form-elements.css">
        <link rel="stylesheet" href="assets2/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="img/tax.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets2/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets2/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets2/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets2/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a  href="index.php" style="color:White; font-size:120%;"><b>TAX CALCULATOR AND SUBMISSION</b></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li> 
							<span class="li-social">
								<a  href="index.php" style="color:White; font-size:90%;"><b>HOME</b></a>
								<a  href="login.php" style="color:White; font-size:90%;"><b>SIGN IN </b></a>
								<a  href="admin_login.php" style="color:White; font-size:90%;"><b>ADMIN LOGIN</b></a>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</nav>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>New User</strong> Registration Form</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	
                        	<form role="form" action="signup.php" method="post" class="registration-form" autocomplete="on" enctype="multipart/form-data">
                        		<?php if($success==0){?>
                        		<fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 1 / 5</h3>
		                            		<p>Basic Details</p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-envelope"></i>
		                        		</div>
		                            </div>
		                            <div class="form-bottom">
										<!--Display Validation Errors here-->
										<?php include('errors.php'); ?>
				                    	<div class="form-group">
				                    		<label  >PAN</label>
				                        	<input type="text" name="PAN" placeholder="PAN" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]" oninvalid="setCustomValidity('Please Match the format ABCDE1234F ')"onchange="try{setCustomValidity('')}catch(e){}" id="pan"class="form-first-name form-control" >
				                        </div>
				                        <div class="form-group">
				                        	<label>DATE OF BIRTH</label>
				                        	<input type="date" name="dob"  id="dob" class="form-google-plus form-control"  required="" >
				                        </div>
				                        <div class="form-group">
				                        	<label  >Email Address</label>
				                        	<input type="email" name="email" placeholder="Email Address" class="form-last-name form-control" >
				                        </div>
										<div class="form-group">
				                        	<label  >Mobile Number</label>
				                        	<input type="text" name="mobile" id="mobile" placeholder="Mobile Number" pattern="[789][0-9]{9}"  oninvalid="setCustomValidity('Please Enter 10 digits of Mobile Number ')"onchange="try{setCustomValidity('')}catch(e){}"class="form-last-name form-control" >
				                        </div>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn " name="signupotp" >Next</button>
				                    </div>
			                    </fieldset>
			                    <?php } else if ($success==1) {?>
			                    <fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 2 / 5</h3>
		                            		<p>Check your Email for OTP: <b style="color: Green"><?php echo $_SESSION['temp_PAN']?></b></p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-pencil"></i>
		                        		</div>
		                            </div>
									
		                            <div class="form-bottom">
									<!--Display Validation Errors here-->
										<?php include('errors.php'); ?>
				                        <div class="form-group">
				                    		<label >OTP</label>
				                        	<input type="text" name="otp" placeholder="One Time Password"  class="form-first-name form-control" required="">
				                        </div>
				                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-next"name="signupotpsubmit">Verify OTP</button>
				                    </div>
			                    </fieldset>
			                    <?php } else if ($success==2) {?>
			                    <fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 3 / 5</h3>
		                            		<p>Personal Details:<b style="color: Green"><?php echo $_SESSION['temp_PAN']?></b></p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-user"></i>
		                        		</div>
		                            </div>
		                            <div class="form-bottom">
									<!--Display Validation Errors here-->
										<?php include('errors.php'); ?>
											<div class="form-group"  >
				                        	<label>Sex</label> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				                        	 <!--<select name="sex" required>
													<option>Select</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>-->
												<input type="radio" name="sex" value="Male" checked=""> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="radio" name="sex" value="Female"> Female
										</div>
				                    	<div class="form-group">
				                    		<label >Name</label>
				                        	<input type="text" name="name" placeholder="Name" class="form-facebook form-control" required="" >
				                        </div>
				                        <div class="form-group">
				                        	<label>Surname</label>
				                        	<input type="text" name="surname" placeholder="Surname" class="form-facebook form-control"  required="">
				                        </div>
				                        <div class="form-group">
				                        	<label>Father's Name</label>
				                        	<input type="text" name="fname" placeholder="Father's Name" class="form-google-plus form-control" required="">
				                        </div>
										<div class="form-group">
				                        	<label>Father's Surname</label>
				                        	<input type="text-area" name="fsurname" placeholder="Father's Surname" class="form-google-plus form-control"  >
				                        </div>
									
										
				                        <button type="button" class="btn btn-next">Next</button>
				                    </div>
			                    </fieldset>
								<fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 4 / 5</h3>
		                            		<p>Contact Details:<b style="color: Green"><?php echo $_SESSION['temp_PAN']?></b></p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-envelope"></i>
		                        		</div>
		                            </div>
		                            <div class="form-bottom">
				                    	<div class="form-group">
				                    		<label>Address</label>
				                        	<input type="text" name="address" placeholder="Address" class="form-facebook form-control" required="">
				                        </div>
				                        <div class="form-group">
										
				                        	<label>Password</label>
											
				                        	<input type="password" name="password1" placeholder="Password" class="form-google-plus form-control" required="">
				                        </div>
										<div class="form-group">
				                        	<label>Confirm Password</label>
				                        	<input type="password" name="password2" placeholder="Confirm Password" class="form-google-plus form-control" required="" >
				                        </div>
				                        <button type="button" class="btn btn-previous">Previous</button>
				                        <button type="button" class="btn btn-next">Next</button>
				                    </div>
			                    </fieldset>
								<fieldset>
		                        	<div class="form-top">
									
		                        		<div class="form-top-left">
		                        			<h3>Step 5 / 5</h3>
		                            		<p>Profile Picture: <b style="color: Green"><?php echo $_SESSION['temp_PAN']?></b></p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-camera"></i>
		                        		</div>
		                            </div>
		                            <div class="form-bottom">
				                    	<div class="form-group">
				                    		<label>Profile Picture</label>
										<div class="input-group">
										<input type="file" name="image" required=""/>
									</div>
				                        </div>
				                        <button type="button" class="btn btn-previous">Previous</button>
				                        <button type="submit" class="btn" name="signup">Final Submit</button>
				                    </div>
			                    </fieldset>
								<?php } ?>
		                    </form>
		                    
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav>
                        <p class="copyright text-center" style="color:White; font-size:120%;">
                           Copyright &copy; Tax Calculator And Submission 2018
                        </p>
                    </nav>
                </div>
            </footer>
        </div>


        <!-- Javascript -->
        <script src="assets2/js/jquery-1.11.1.min.js"></script>
        <script src="assets2/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets2/js/jquery.backstretch.min.js"></script>
        <script src="assets2/js/retina-1.1.0.min.js"></script>
        <script src="assets2/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets2/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>