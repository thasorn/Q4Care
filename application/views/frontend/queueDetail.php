<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="60">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
  .table-sortable tbody tr {
    cursor: move;
  }
  input.add {
    -moz-border-radius: 4px;
    border-radius: 4px;
    background-color:#6FFF5C;
    -moz-box-shadow: 0 0 4px rgba(0, 0, 0, .75);
    box-shadow: 0 0 4px rgba(0, 0, 0, .75);
  }
  </style>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12 table-responsive">
        <center><h2>คิวของคุณ</h2></center></div>
        <?php if (sizeof($detail) > 0) :?>
        <table class="table table-bordered table-hover table-sortable" id="tab_logic">
          <thead>
            <tr >
              <th class="text-center">
                ID
              </th>
              <th class="text-center">
                วัน
              </th>
              <th class="text-center">
                เวลา
              </th>
              <th class="text-center">
                อาการป่วย
              </th>
              <th class="text-center">
                แพทย์ที่ทำการรักษา
              </th>
            </tr>
          </thead>
            <?php $counter = 1 ?>
            <?php foreach ($detail as $row): ?>
              <tbody>
                <td data-name="id">
                  <center><?php echo $counter; ?></center>
                </td>
                <td data-name="date">
                  <center><?php echo explode(" ", $row['time'])[0]; ?></center>
                  <!--<textarea type="text" name='massage' placeholder='Date' class="form-control"></textarea>-->
                </td>
                <td data-name="time">
                  <center><?php echo explode(" ", $row['time'])[1]; ?></center>
                  <!--<textarea type="text" placeholder="Time" class="form-control"></textarea>-->
                </td>
                <td data-name="sel">
                  <center><?php echo $row['dep_id']; ?></center>
                </td>
                <td data-name="doctor">
                  <input disabled type="text" name='name0'  placeholder='Doctor Name' class="form-control" value="<?php echo $row['doctor'] ?>"/>
                </td>
              </tr>
            </tbody>
            <?php $counter++; ?>
          <?php endforeach; ?>
        <?php else:?>
          <center><h2>ไม่มีคิวเข้ารับการรักษา</h2></center>
        <?php endif; ?>
      </table>
      <table name="errortitle">

      </table>
    </div>
  </div>
</div>
<script>
</script>

<script type="text/javascript">
$(document).ready(function() {
  $("#add_row").on("click", function() {
    // Dynamic Rows Code

    // Get max row id and set new id
    var newid = 0;
    $.each($("#tab_logic tr"), function() {
      if (parseInt($(this).data("id")) > newid) {
        newid = parseInt($(this).data("id"));
      }
    });
    newid++;
    var tr = $("<tr></tr>", {
      id: "addr"+newid,
      "data-id": newid
    });

    // loop through each td and create new elements with name of newid
    $.each($("#tab_logic tbody tr:nth(0) td"), function() {
      var cur_td = $(this);

      var children = cur_td.children();

      // add new td and element if it has a nane
      if ($(this).data("name") != undefined) {
        var td = $("<td></td>", {
          "data-name": $(cur_td).data("name")
        });

        var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
        c.attr("name", $(cur_td).data("name") + newid);
        c.appendTo($(td));
        td.appendTo($(tr));
      } else {
        var td = $("<td></td>", {
          'text': $('#tab_logic tr').length
        }).appendTo($(tr));
      }
    });


    // add delete button and td
    /*
    $("<td></td>").append(
    $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
    .click(function() {
    $(this).closest("tr").remove();
  })
).appendTo($(tr));
*/

// add the new row
$(tr).appendTo($('#tab_logic'));


$(tr).find("td button.row-remove").on("click", function() {
  $(this).closest("tr").remove();
});

$('#tab_logic').on('click', "td button.row-remove", function() {
  var current = $(this).parents("tr");

  if(current.attr('id')){
    // Parent
    while(true){
      var next = current.next();
      if(next.length == 0 || next.attr('id')){
        break;
      }

      next.remove();
    }
    current.remove();
  }else{
    //child
    current.remove();
  }
});

$(tr).find('td button.row-addsub').on("click", function() {
  $( "tr" ).has( this ).after( '<tr><td></td><td><input type="text"/></td><td><input type="text"/></td><td>YOUR CODE HERE</td><td>YOUR CODE HERE</td><td>YOUR CODE HERE</td><td>YOUR CODE HERE</td><td>YOUR CODE HERE</td><td>YOUR CODE HERE</td><td><button class="btn btn-danger glyphicon glyphicon-remove row-remove"></button></td></tr>' );
});
});


// Sortable Code
var fixHelperModified = function(e, tr) {
  var $originals = tr.children();
  var $helper = tr.clone();

  $helper.children().each(function(index) {
    $(this).width($originals.eq(index).width())
  });

  return $helper;
};

$(".table-sortable tbody").sortable({
  helper: fixHelperModified
}).disableSelection();

$(".table-sortable thead").disableSelection();



$("#add_row").trigger("click");
})

</script>
</body>
</html>
