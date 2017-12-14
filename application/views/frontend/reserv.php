<!DOCTYPE html>
<html lang="en">
<head>
  <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
  <title>เลือกอาการป่วย</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-type" value="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo HTTP_IMAGES_PATH ?>logo02.png">
  <link href="<?php echo HTTP_CSS_PATH ?>bootstrap-min.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>reserv.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>main.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>bootstrap-datepicker3.standalone.css" rel="stylesheet">
  <script src="<?php echo HTTP_JS_PATH ?>jquery-1.11.1-min.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>bootstrap-min.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>bootstrap-datepicker.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>bootstrap-datepicker.min.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>bootstrap-datepicker.en-AU.min.js"></script>

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
          <li><a href="<?php echo REAL_PATH ?>/Dashboard/reservQue"><span class="hidden-xs hidden-sm">จองคิว</span></a></li>
          <li><a href="<?php echo REAL_PATH ?>/Dashboard/myReserv"><span class="hidden-xs hidden-sm">คิวปัจจุบัน</span></a></li>
          <li><a href="<?php echo REAL_PATH."/Home/logout" ?>"><span class="hidden-xs hidden-sm">ออกจากระบบ</span></a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h5 class="gallery-title">อาการป่วยตามจุดต่าง ๆ ของร่างกาย</h5>
      </div>

      <?php foreach ($departments as $row): ?>
        <!-- Trigger the modal with a button -->
        <button type="button" name="symp_icon" value="<?php echo $row['id']; ?>" style="background-color:transparent" class="btn gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe" data-toggle="modal" data-target="#timeModal">
          <img src="<?php echo HTTP_IMAGES_PATH.$row['picture']; ?>" alt="<?php echo $row['name'] ?>">
        </button>
      <?php endforeach; ?>

      <!-- Modal -->
      <div id="timeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <form action="<?php echo REAL_PATH.'/Dashboard/reservTransaction' ?>" method="post">
            <input type="hidden" name='symptom'>
            <div class="modal-content gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">เลือกคิว</h4>
              </div>
              <div class="modal-body">
                <div>
                  เลือกหมอ : <select name="doctor" class="form-control" id="doctor">
                  </select>
                </div>
                เลือกวัน :
                <div class="input-group date">
                  <input type="text" name="date" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div><br>
                <div id="setTime">
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo HTTP_JS_PATH ?>reserv.js"></script>
<script type="text/javascript">var base_url = '<?php echo REAL_PATH; ?>';</script>
</body>
</html>
