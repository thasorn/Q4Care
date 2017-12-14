$(document).ready(function(){
    $("[name='symp_icon']").click(function(){
      var dep_id = $(this).val();
      $("[name='symptom']").val(dep_id);
      $("#doctor").empty();
      //AJAX Query PART
      var path = base_url+'/Dashboard/getReservDetail/'+dep_id;
      $.ajax( path, {
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function ( arresult ) {
          var result = arresult.rs;
          $("#doctor").append(result);
        }
      });
      //AJAX Query PART
    });

    $("[name='date']").change(function(){
      var input = $("[name='date']");
      var date = input.val().split("/");
      var d = new Date();
      var day = parseInt(date[0]);
      var cday = d.getDate();
      var month = parseInt(date[1]);
      var cmonth = d.getMonth()+1;
      var year = parseInt(date[2]);
      var cyear = d.getFullYear();
      if (cyear > year){
        alert('Wrong year!!!');
        input.val('');
      } else if (cyear == year && cmonth > month) {
        alert('Wrong month!!!');
        input.val('');
      } else if (cyear == year && cmonth == month && cday > day){
        alert('Wrong day!!!');
        input.val('');
      } else {
        var dep_id = $("[name='symptom']").val();
        $("#setTime").empty();
        var inpDate=input.val();
        //AJAX Query PART
        var path = base_url+'/Dashboard/getTime/'+dep_id;
        var formData = new FormData();
        formData.append('date',  inpDate);
        $.ajax( path, {
          type: 'POST',
          data: formData ,
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function ( arresult ) {
            var result = arresult.rs;
            $("#setTime").append(result);
          }
        });
        //AJAX Query PART
      }
    });
});

$('.input-group.date').datepicker({
    format: "dd/mm/yyyy",
    clearBtn: true,
    forceParse: false,
    autoclose: true,
    todayHighlight: true
});
