<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
	<title>เข้าสู่ระบบ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo HTTP_IMAGES_PATH ?>logo02.png">
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
						<p class="form-title">เข้าสู่ระบบ</p>
						<form class="login" method="post" action="<?php echo REAL_PATH ?>/home/loggingIn">
							<input name="username" type="text" placeholder="ชื่อบัญชีผู้ใช้งาน / อีเมล์" />
							<input name="password" type="password" placeholder="รหัสผ่าน" />
							<input name="loginBt" type="submit" value="เข้าสู่ระบบ" class="btn btn-success btn-sm" />
							<div class="remember-forgot">
								<div class="row">
									<div class="col-md-6">
										<div class="checkbox">
											<a href="<?php echo REAL_PATH ?>/UserInfo/register" class="forgot-pass">สมัครสมาชิก</a>
										</div>
									</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
