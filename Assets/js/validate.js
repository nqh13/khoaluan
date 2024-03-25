//Đối tượng validator
function Validator(option) {
  var selectorRules = {};
  function validate(inputElement, rule) {
    var errorElement = inputElement.parentElement.querySelector(
      option.errorSelector
    );
    var errorMessage = rule.test(inputElement.value);

    var rules = selectorRules[rule.selector];
    // console.log(rules);
    for (var i = 0; i < rules.length; ++i) {
      errorMessage = rules[i](inputElement.value);
      if (errorMessage) break;
    }
    if (errorMessage) {
      errorElement.innerHTML = errorMessage;
      inputElement.parentElement.classList.add("invalid");
    } else {
      errorElement.innerHTML = "";
      inputElement.parentElement.classList.remove("invalid");
    }
    return !errorMessage;
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
        formElement.submit();
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
      //   console.log(selectorRules);
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
