//Đối tượng validator
function Validator(options, callback) {
  var selectorRules = {};
  //Lấy element form
  var formElement = document.querySelector(options.form);
  var isFormValid = true;

  // Thực hiện validate
  function validate(inputElement, rule) {
    var errorMessage;
    var errorElemrent = inputElement.parentElement.querySelector(
      options.errorSelector
    );
    //Lấy các rules của selector
    var rules = selectorRules[rule.selector];

    //Lặp qua các rules và kiểm tra. Dừng ktra khi có lỗi.
    for (var i = 0; i < rules.length; i++) {
      errorMessage = rules[i](inputElement.value);
      if (errorMessage) {
        break;
      }
    }

    if (errorMessage) {
      errorElemrent.innerHTML = errorMessage;
      inputElement.parentElement.classList.add("invalid");
    } else {
      errorElemrent.innerHTML = "";
      inputElement.parentElement.classList.remove("invalid");
    }

    return !errorMessage;
  }

  if (formElement) {
    formElement.onsubmit = function (e) {
      e.preventDefault();

      options.rules.forEach(function (rule) {
        var inputElement = formElement.querySelector(rule.selector);
        var isValid = validate(inputElement, rule);
        console.log(isValid, isFormValid);
        if (!isValid) {
          isFormValid = false;
        } else {
          isFormValid = true;
        }
      });
      if (isFormValid) {
        callback();
      } else {
        alert("Vui lòng kiểm tra lại thông tin!");
      }
    };
    //Xử lý
    options.rules.forEach(function (rule) {
      // Lưu lại các rules
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.test);
      } else {
        selectorRules[rule.selector] = [rule.test];
      }

      var inputElement = formElement.querySelector(rule.selector);
      // Xử lý khi người dùng Blur.
      inputElement.onblur = function () {
        validate(inputElement, rule);
      };

      // Xử lý khi người dùng nhập vào Input.
      inputElement.oninput = function () {
        var errorElemrent = inputElement.parentElement.querySelector(
          options.errorSelector
        );
        errorElemrent.innerHTML = "";
        inputElement.parentElement.classList.remove("invalid");
      };
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
