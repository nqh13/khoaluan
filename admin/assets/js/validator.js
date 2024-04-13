console.log("Hello");
alert("Hello");

// Hàm validator

function Validator(options) {
  var formElement = document.querySelector(options.form);
  console.log(formElement);
}

// Định nghĩa rules
Validator.isRequired = function () {};

Validator.isEmail = function () {};
