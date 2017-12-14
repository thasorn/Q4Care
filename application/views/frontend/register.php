<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo HTTP_IMAGES_PATH ?>logo02.png">
  <link href="<?php echo HTTP_CSS_PATH ?>bootstrap-min.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>register.css" rel="stylesheet">
  <script src="<?php echo HTTP_JS_PATH ?>jquery-1.11.1-min.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>bootstrap-min.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>main.js"></script>

  <!-- Website Font style -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

  <title><?php echo (empty($user))? 'สมัครสมาชิก': 'แก้ไขบัญชีผู้ใช้งาน'; ?></title>
</head>
<body><?php $username='';$password='';$fname='';$lname='';$email='';
if (isset($user)){
  $username = $user['username'];
  $password = $user['password'];
  $fname = $user['fname'];
  $lname = $user['lname'];
  $email = $user['email'];
}?>
<div class="container">
  <div class="row main">
    <div class="panel-heading">
      <div class="panel-title text-center">
        <h1 class="title"><?php echo (empty($user))? 'สมัครสมาชิก': 'แก้ไขบัญชีผู้ใช้งาน'; ?></h1>
        <hr />
      </div>
    </div>
    <div class="main-login main-center">
      <form class="form-horizontal" method="post" action="<?php echo REAL_PATH;echo (empty($user))?'/UserInfo/registering':'/UserInfo/editedAccount'; ?>">
        <?php if (isset($user)) {?>
          <div class="form-group">
            <label for="email" class="cols-sm-2 control-label">ชื่อบัญชีผู้ใช้งาน</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                <input required type="text" class="form-control" name="username" id="username"  placeholder="กรุณาใส่ชื่อบัญชีผู้ใช้งานของคุณ" value="<?php echo $username ?>" />
              </div>
            </div>
          </div><?php
        }?>

        <div class="form-group">
          <label for="email" class="cols-sm-2 control-label">อีเมล์</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
              <input required type="text" class="form-control" name="email" id="email"  placeholder="กรุณาใส่อีเมล์ของคุณ" value="<?php echo $email ?>" />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="password" class="cols-sm-2 control-label">รหัสผ่าน</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
              <input required type="password" class="form-control" name="password" id="password"  placeholder="กรุณาใส่รหัสผ่าน"/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="confirm" class="cols-sm-2 control-label">ยืนยันรหัสผ่าน</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
              <input required type="password" class="form-control" name="confirm" id="confirm"  placeholder="กรุณายืนยันรหัสผ่านให้ถูกต้อง"/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="fname" class="cols-sm-2 control-label">ชื่อ</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
              <input required type="text" class="form-control" name="fname" id="name"  placeholder="กรุณาใส่ชื่อจริง" value="<?php echo $fname ?>"/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="lname" class="cols-sm-2 control-label">นามสกุล</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
              <input required type="text" class="form-control" name="lname" id="lname"  placeholder="กรุณาใส่นามสกุลของคุณ" value="<?php echo $lname ?>"/>
            </div>
          </div>
        </div>

        <div class="form-group ">
          <input required type="submit" value="<?php echo (empty($user))? 'ลงทะเบียน': 'แก้ไขบัญชี'; ?>" class="btn btn-primary btn-lg btn-block login-button"/>
        </div>
      </form>
      <?php if (empty($user)): ?>
        <div class="login-register">
          <a href="<?php echo REAL_PATH ?>/Home/login">เข้าสู่ระบบ</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>var base_url = "<?php echo REAL_PATH; ?>";var isCreate = <?php echo empty($user)?1:0; ?>;</script>
</body>
</html>
