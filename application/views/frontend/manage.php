<!DOCTYPE html>
<html lang="en">
<head>
  <title>ยินดีต้อนรับเข้าสู่ระบบ</title>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="60">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo HTTP_IMAGES_PATH ?>logo02.png">
  <link href="<?php echo HTTP_CSS_PATH ?>bootstrap-min.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>reserv.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>main.css" rel="stylesheet">
  <link href="<?php echo HTTP_CSS_PATH ?>list.css" rel="stylesheet">
  <script src="<?php echo HTTP_JS_PATH ?>jquery-1.11.1-min.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>bootstrap-min.js"></script>
  <script src="<?php echo HTTP_JS_PATH ?>list.js"></script>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">


  <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="container">
    <br>
    <div class="row clearfix">
      <div class="col-md-12 table-responsive">
        <div style="float:left">
          <a id="add_row" class="btn btn-primary addnewrow pull-left">เพิ่มคิว
            <span class="glyphicon glyphicon-plus"></span>
          </a>
        </div><hr>
        <table class="table table-bordered table-hover table-sortable" id="tab_logic">
          <thead>
            <tr >
              <th class="text-center">
                ID
              </th>
              <th class="text-center">
                ชื่อ
              </th>
              <th class="text-center">
                วัน
              </th>
              <th class="text-center">
                เวลา
              </th>
              <th class="text-center">
                แพทย์ที่ทำการรักษา
              </th>
              <th class="text-center">
                เช็คเอาท์ หรือ ยกเลิก
              </th>
            </tr>
          </thead>
          <tbody>
            <tr id='addr0' data-id="0" class="hidden">
              <form class="form-control" action="<?php REAL_PATH."/Dashboard/createWalk" ?>" method="post">
                <td data-name="button">
                  <center><span id="que">x</span></center>
                </td>
                <td data-name="name">
                  <input type="text" name='user'  placeholder='Name' class="form-control"/>
                </td>
                <td data-name="date">
                  <input type="text" name='date' value="<?php echo $now; ?>"  placeholder='Date' class="form-control"/>
                </td>
                <td data-name="time">
                  <input type="text" name='time'  placeholder='Time' class="form-control"/>
                </td>
                <td data-name="doctor">
                  <select  name='doc'  placeholder='Doctor Name' class="form-control">
                    <?php foreach ($doctors as $row): ?>
                      <?php print_r($row); ?>
                      <option value="<?php echo $row['id'] ?>"><?php echo $row['fname'].' '.$row['lname'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
              </form>
              <td data-name="del">
                <center><button name"del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button></center>
              </td>
            </tr>
            <?php foreach ($queLists as $row): ?>
              <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['user'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['time'] ?></td>
                <td><?php echo $row['doc'] ?></td>
              <td data-name="del">
                <a href="<?php echo REAL_PATH.'Dashboard/cancelReserv/'.$row['id'] ?>"><center><button name"del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button></center></a>
              </td>
            <?php endforeach; ?>
          </tbody>
        </table>
        <table name="errortitle">

        </table>
      </div>
    </div>
  </div>
</body>
</html>
