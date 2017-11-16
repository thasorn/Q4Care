<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
	<title>Full Page Sign In - Bootsnipp.com</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo HTTP_IMAGES_PATH ?>logo.png">
	<link href="<?php echo HTTP_CSS_PATH ?>bootstrap-min.css" rel="stylesheet">
	<link href="<?php echo HTTP_CSS_PATH ?>sign-in.css" rel="stylesheet">
	<script src="<?php echo HTTP_JS_PATH ?>jquery-1.11.1-min.js"></script>
	<script src="<?php echo HTTP_JS_PATH ?>bootstrap-min.js"></script>
</head>
<body>
	<div class="container">
		<center><img src="<?php echo HTTP_IMAGES_PATH ?>logo.png" width="400px" height="auto"></center>
		<div class="row">
			<div class="col-md-12">
				<div class="pr-wrap">
					<div class="pass-reset">
						<label>
							Enter the email you signed up with</label>
							<input type="email" placeholder="Email" />
							<input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
						</div>
					</div>
					<div class="wrap">
						<p class="form-title">Sign In</p>
							<form class="login" method="post" action="<?php echo REAL_PATH ?>/home/loggingIn">
								<input name="username" type="text" placeholder="Username / Email" />
								<input name="password" type="password" placeholder="Password" />
								<input name="loginBt" type="submit" value="login" class="btn btn-success btn-sm" />
								<div class="remember-forgot">
									<div class="row">
										<div class="col-md-6">
											<div class="checkbox">
												<a href="<?php echo REAL_PATH ?>/Home/register" class="forgot-pass">Register</a>
											</div>
										</div>
										<div class="col-md-6 forgot-pass-content">
											<center><a href="javascription:void(0)" class="forgot-pass">Forgot Password</a></center>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!--<script type="text/javascript" src="assets/js/bootstrap.js"></script>-->
		</body>
		</html>
