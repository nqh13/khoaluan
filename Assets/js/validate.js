//Đối tượng validator
function Validator(option, callback) {
  var selectorRules = {};

  function validate(inputElement, rule) {
    var errorElement = inputElement.parentElement.querySelector(
      option.errorSelector
    );
    var errorMessage = rule.test(inputElement.value);

    var rules = selectorRules[rule.selector];

    for (var i = 0; i < rules.length; ++i) {
      errorMessage = rules[i](inputElement.value);
      if (errorMessage) break;
    }

    if (errorMessage) {
      errorElement.innerHTML = errorMessage;
      inputElement.parentElement.classList.add("invalid");
      return false; // Trả về false nếu có lỗi
    } else {
      errorElement.innerHTML = "";
      inputElement.parentElement.classList.remove("invalid");
      return true; // Trả về true nếu không có lỗi
    }
  }

  var formElement = document.querySelector(option.form);

  if (formElement) {
    formElement.onsubmit = function (e) {
      e.preventDefault();
      var isFormValid = true;

      option.rules.forEach(function (rule) {
        var inputElement = formElement.querySelector(rule.selector);
        var isValid = validate(inputElement, rule);
        if (!isValid) {
          isFormValid = false;
        }
      });

      if (isFormValid) {
        callback();
      } else {
        alert("Vui lòng kiểm tra lại thông tin!");
      }
    };

    option.rules.forEach(function (rule) {
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.test);
      } else {
        selectorRules[rule.selector] = [rule.test];
      }
      var inputElement = document.querySelector(rule.selector);
      if (inputElement) {
        inputElement.onblur = function () {
          validate(inputElement, rule);
        };
        inputElement.oninput = function () {
          var errorElement = inputElement.parentElement.querySelector(
            option.errorSelector
          );
          errorElement.innerHTML = "";
          inputElement.parentElement.classList.remove("invalid");
        };
      }
      // console.log(selectorRules);
    });
  }
}

//Định nghĩa rules
Validator.isRequired = function (selector) {
  return {
    selector: selector,
    test: function (value) {
      return value.trim() ? undefined : "Vui lòng nhập trường này!";
    },
  };
};

Validator.isEmail = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regex.test(value)
        ? undefined
        : message || "Trường này phải là email";
    },
  };
};

Validator.isNumberPhone = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var phoneNumberRegex = /^(0[3|5|7|8|9])+([0-9]{8})\b/;
      return phoneNumberRegex.test(value)
        ? undefined
        : message || "Vui lòng nhập đúng số điện thoại! ";
    },
  };
};

Validator.minLength = function (selector, min, message) {
  return {
    selector: selector,
    test: function (value) {
      return value.length >= min
        ? undefined
        : message || `Vui lòng nhập tối thiểu ${min} kí tự`;
    },
  };
};

Validator.isNumber = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^(-?[0-9]+)$/;
      return regex.test(value)
        ? undefined
        : message || "Vui lòng nhập đúng số lượng!";
    },
  };
};
// Kiểm tra số lượng
Validator.isNumberQty = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      return value > 0 ? undefined : message || "Số lượng phải > 0!";
    },
  };
};

//Check XSS
Validator.checkXSS = function (selector) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /<("[^"]*"|'[^']*'|[^'">])*>/;
      return regex.test(value) ? "Vui lòng nhập các tag HTML!" : undefined;
    },
  };
};
// Check Password Confirm
Validator.isConfirmed = function (selector, getConfirmValue, message) {
  return {
    selector: selector,
    test: function (value) {
      return value === getConfirmValue()
        ? undefined
        : message || "Giá trị nhập vào không chính xác";
    },
  };
};
