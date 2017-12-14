<!DOCTYPE html>
<html lang="en">
<head>
  <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
  <title>ยินดีต้อนรับเข้าสู่ระบบ</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-type" value="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo HTTP_IMAGES_PATH ?>logo02.png">
  <link href="<?php echo HTTP_CSS_PATH ?>bootstrap-min.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>reserv.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>main.css" rel="stylesheet">
  <script src="<?php echo HTTP_JS_PATH ?>jquery-1.11.1-min.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>bootstrap-min.js"></script>

  <!-- Website Font style -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="container-fluid display-table">
    <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
      <div class="logo">
        <img src="<?php echo HTTP_IMAGES_PATH ?>logo02.png"><br>
        Q4care
      </div>
      <div class="navi">
        <ul>
          <li><a href="<?php echo REAL_PATH ?>"><span class="hidden-xs hidden-sm">หน้าหลัก</span></a></li>
          <?php if (empty($user['role'])): ?>
            <li><a href="<?php echo REAL_PATH ?>/Dashboard/reservQue"><span class="hidden-xs hidden-sm">จองคิว</span></a></li>
            <li><a href="<?php echo REAL_PATH ?>/Dashboard/myReserv"><span class="hidden-xs hidden-sm">คิวปัจจุบัน</span></a></li>
          <?php endif; ?>
          <li><a href="<?php echo REAL_PATH."/Home/logout" ?>"><span class="hidden-xs hidden-sm">ออกจากระบบ</span></a></li>
        </ul>
      </div>
    </div>
    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <iframe style="margin-top:0%;margin-left:-1%;width:200vh;border:none;height:100vh" src="<?php echo REAL_PATH ?>/Dashboard/queing" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    </div>
  </div>
</body>
</html>
