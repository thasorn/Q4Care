function validateEmail(mail)
{
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  return mail.value.match(mailformat);
}

function triggerEmail(mail) {
  if (mail == ''){
    $("#email").css('border-color', '#e1e1e1');
  } else {
    if (validateEmail(email)){
      alert('คุณใช้งานอีเมล์นี้ได้');
      $("#email").css('border-color', 'green');
    } else {
      $("#email").css('border-color', 'red');
      alert('อีเมล์นี้มีรูปแบบไม่ถูกต้องกรุณาตรวจสอบอีกครั้ง');
      reset($("#email"));
    }
  }
}

function reset(element) {
  element.val('');
}

function checkPassword() {
  var confirmInput = document.getElementById("confirm");
  var passwordInput = document.getElementById("password");
  if (confirmInput.value == passwordInput.value){
    $("#confirm").css('border-color', 'green');
  } else {
    alert('กรุณายืนยันรหัสผ่านให้ถูกต้องอีกครั้ง');
    $("#confirm").css('border-color', 'red');
  }
}

$(document).ready(function(){
  var displayMail = true;
  var displayUn = true;

  $("#username").focusin(function(){
    displayUn = true;
  });

  $("#username").focusout(function(){
    var emailInput = document.getElementById("email");

    //AJAX Query PART
    var path = base_url+'/UserInfo/findUsername';
    var formData = new FormData();
    formData.append('username',  emailInput.value);
    $.ajax( path, {
      type: 'POST',
      data: formData ,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function ( arresult ) {
        var result = arresult.rs;
        if (displayMail){
          if (result){
              alert('ชื่อบัญชีผู้ใช้งาน้ถูกใช้งานไปแล้ว');
              $("#username").css('border-color', '#e1e1e1');
              reset($("#username"));
          } else {
            $("#username").css('border-color', '#0f0');
          }
          displayMail = false;
        }
      }
    });
    //AJAX Query PART

  });


  $("#email").focusin(function(){
    displayMail = true;
  });

  $("#email").focusout(function(){
    var emailInput = document.getElementById("email");

    //AJAX Query PART
    var path = base_url+'/UserInfo/findEmail';
    var formData = new FormData();
    formData.append('email',  emailInput.value);
    $.ajax( path, {
      type: 'POST',
      data: formData ,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function ( arresult ) {
        var result = arresult.rs;
        if (displayMail){
          if (result){
              alert('อีเมล์นี้ถูกใช้งานไปแล้ว');
              $("#email").css('border-color', '#e1e1e1');
              reset($("#email"));
          } else {
            triggerEmail(emailInput.value);
          }
          displayMail = false;
        }
      }
    });
    //AJAX Query PART

  });

  $("#confirm").focusin(function() {
    display = true;
  });

  $("#confirm").focusout(function() {
    checkPassword();
    display = false;
  });

});
