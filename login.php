<?php include('server.php'); 
		//IF user is  logged in,then you cannot access this page
	if(!empty($_SESSION['PAN'])){
		header('location: dashboard.php');
	}
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
								<a  href="signup.php" style="color:White; font-size:90%;"><b>SIGN UP</b></a>
								<a  href="admin_login.php" style="color:White; font-size:90%;"><b>ADMIN LOGIN </b></a>
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
                            <h1><strong>Existing User</strong> SignIn Form</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	
                        	<form role="form" action="login.php" method="post" class="registration-form">
                        		
                        		<fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3> Authenticate Yourself</h3>
		                            		<p>Tell us who you are:</p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-user"></i>
		                        		</div>
		                            </div>
									
		                            <div class="form-bottom">
										<!--Display Validation Errors here-->
										<?php include('errors.php'); ?>
				                    	<div class="form-group">
				                    		<label  for="form-first-name">User ID</label>
				                        	<input type="text" name="PAN" placeholder="PAN" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]" oninvalid="setCustomValidity('Please Match the format ABCDE1234F ')"onchange="try{setCustomValidity('')}catch(e){}"  class="form-first-name form-control" id="pan">
				                        </div>
				                        <div class="form-group">
				                        	<label  for="form-last-name">Password</label>
				                        	<input type="password" name="password" placeholder="Password" class="form-last-name form-control" id="form-last-name">
				                        </div>
										<a href="forgot.php" class="btn btn-danger" >Forgot Password </a>
				                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										 <button type="submit" name="login" class="btn" >Sign In</button>
				                    </div>
			                    </fieldset>
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