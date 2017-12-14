function validateEmail(mail)
{
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  return mail.value.match(mailformat);
}

function checkEmail() { //เปลี่ยนไปใช้ JQUERY ซะ จะได้ใช้ ajax เช็คเมล์ซ้ำใน Database
  var emailInput = document.getElementById("email");
  findEmail(emailInput.value);
  if (emailInput.value == ''){
    $("#email").css('border-color', '#e1e1e1');
  } else {
    if (validateEmail(emailInput)){
      $("#email").css('border-color', 'green');
    } else {
      $("#email").css('border-color', 'red');
    }
  }
}

function checkPassword() {
  var confirmInput = document.getElementById("confirm");
  var passwordInput = document.getElementById("password");
  if (confirmInput.value == passwordInput.value){
    $("#confirm").css('border-color', 'green');
  } else {
    $("#confirm").css('border-color', 'red');
  }
}
