<?php include('server.php'); 
		//IF user is  logged in,then you cannot access this page
		if(!empty($_SESSION['temp_PAN'])){
		if(((time() - $_SESSION['loggedin_time']) > $temp_session)){ 
			unset($_SESSION['temp_PAN']);
			header('location: login.php');
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
        <link rel="shortcut icon" href="img/logo.png">
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
								<a  href="signup.php" style="color:White; font-size:90%;"><b>SIGN UP</b></a>
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
                            <h1><strong>Password </strong>Recovery Form</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	
                        	<form role="form" action="" method="post" class="registration-form">
                        		<?php if($success==0){?>
                        		<fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 1 / 3</h3>
		                            		<p>Enter Your User ID</p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-user"></i>
		                        		</div>
		                            </div>
									
		                            <div class="form-bottom">
										<!--Display Validation Errors here-->
										<?php include('errors.php'); ?>
				                    	<div class="form-group">
				                    		<label for="form-first-name">User ID</label>
				                        	<input type="text" name="PAN" placeholder="PAN" class="form-first-name form-control" required=""id="form-first-name">
				                        </div>
				                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				                        <button type="submit" class="btn btn-next" name="sendotp">Send OTP</button>
				                    </div>
			                    </fieldset>
			                    <?php } else if ($success==1) {?>
			                    <fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 2 / 3</h3>
		                            		<p>Check Your Email for OTP: <b style="color: Green"><?php echo $_SESSION['temp_PAN']?></b></p>
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
				                        	<input type="text" name="otp" placeholder="One Time Password" class="form-first-name form-control" required="">
				                        </div>
				                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-next"name="otpsubmit">Verify OTP</button>
				                    </div>
			                    </fieldset>
			                    <?php } else if ($success==2) {?>
			                    <fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 3 / 3</h3>
		                            		<p>Enter New Passwords:<b style="color: Green"><?php echo $_SESSION['temp_PAN']?></b></p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-key"></i>
		                        		</div>
		                            </div>
									
		                            <div class="form-bottom">
										<!--Display Validation Errors here-->
										<?php include('errors.php'); ?>
				                    	<div class="form-group">
				                    		<label >New Password</label>
				                        	<input type="password" name="password1" placeholder="New Password" class="form-facebook form-control" required="">
				                        </div>
				                        <div class="form-group">
				                        	<label  >Confirm Password</label>
				                        	<input type="password" name="password2" placeholder="Confirm Password" class="form-twitter form-control" required="">
				                        </div>
				                        <button type="submit" class="btn" name="recoverpass">Recover Password</button>
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