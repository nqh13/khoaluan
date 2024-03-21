jQuery(function ($) {
  $(".sidebar-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if ($(this).parent().hasClass("active")) {
      $(".sidebar-dropdown").removeClass("active");
      $(this).parent().removeClass("active");
    } else {
      $(".sidebar-dropdown").removeClass("active");
      $(this).next(".sidebar-submenu").slideDown(200);
      $(this).parent().addClass("active");
    }
  });

  $("#close-sidebar").click(function () {
    $(".page-wrapper").removeClass("toggled");
  });
  $("#show-sidebar").click(function () {
    $(".page-wrapper").addClass("toggled");
  });
});
//Sweat alert.
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});

//Xóa đề tài.

function handelDeleteTopic(id) {
  var option = confirm("Bạn có muốn xoá đề tài này không?");
  if (option === true) {
    $.ajax({
      url: "./../handle/xuly.php",
      method: "Post",
      data: {
        id: id,
        action: "delete",
      },
      success: function (data) {
        Toast.fire({
          icon: "success",
          title: "xóa đề tài thành công!",
        });
        setTimeout(function () {
          window.location.reload();
        }, 2000);
      },
    });
  }
}

// Đăng ký đề tài
function signUpTopic(id, ma_SV) {
  $.ajax({
    type: "POST",
    url: "./../sinhvien/handle/SignUpTopic.php",
    data: {
      action: "signUpTopic",
      ma_detai: id,
      ma_SV: ma_SV,
    },
    success: function (response) {
      alert("Đăng ký thành công!");
      window.location.href = "index.php?page=detai";
    },
  });
}

// Hủy đề tài đã đăng ký.
function cancelTopic(id) {
  var cofirm = confirm("Bạn chắc chắn muốn hủy đề tài này?");
  if (cofirm === true) {
    $.ajax({
      type: "POST",
      url: "./../sinhvien/handle/SignUpTopic.php",
      data: {
        action: "cancelTopic",
        ma_dangky: id,
      },
      success: function (response) {
        alert("Đã hủy đăng ký đề tài!");
        window.location.href = "index.php";
      },
    });
  }
}

//Cập nhật thông tin cá nhân.

// function updateInfoUser(id) {
//   var sdt = document.getElementById(id);
//   $.ajax({
//     type: "POST",
//     url: "./../sinhvien/handle/UserHandle.php",
//     data: {
//       action: "updateInfo",
//       id: id,
//     },
//     success: function (response) {
//       alert("Đã cập nhật!");
//       window.location.href = "index.php";
//     },
//   });
// }

// Đổi mật khẩu.
function validateForm() {
  var password = document.getElementById("password").value;
  var newPassword = document.getElementById("newpassword").value;
  var confirmPassword = document.getElementById("confirmpass").value;
  var errorElement = document.getElementById("er_pass");
  var errorNewPassword = document.getElementById("er_newpass");
  var errorConfirmPassword = document.getElementById("er_confirmpass");

  // Regex pattern để kiểm tra tính hợp lệ của mật khẩu
  var passwordPattern =
    /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+}{":;'?\/><,.\[\]\\\-]).{8,}$/;

  // Kiểm tra tính hợp lệ của mật khẩu cũ
  if (password.trim() === "") {
    errorElement.innerText = "Vui lòng nhập mật khẩu cũ!";
    return false;
  } else {
    errorElement.innerText = "";
  }

  // Kiểm tra tính hợp lệ của mật khẩu mới
  if (!passwordPattern.test(newPassword)) {
    errorNewPassword.innerText =
      "Mật khẩu mới không hợp lệ! Mật khẩu phải chứa ít nhất 8 ký tự, bao gồm ít nhất một chữ số, một chữ thường, một chữ hoa và một ký tự đặc biệt.";
    return false;
  } else {
    errorNewPassword.innerText = "";
  }

  // Kiểm tra xác nhận mật khẩu
  if (newPassword !== confirmPassword) {
    errorConfirmPassword.innerText =
      "Mật khẩu mới và xác nhận mật khẩu không khớp!";
    return false;
  } else {
    errorConfirmPassword.innerText = "";
  }

  return true;
}
function changePassword(id) {
  if (!validateForm()) return alert("Điền đầy đủ thông tin!");
  var password = document.getElementById("password").value;
  var newPassword = document.getElementById("newpassword").value;
  $.ajax({
    type: "POST",
    url: "./../sinhvien/handle/UserHandle.php",
    data: {
      action: "changePassword",
      id_user: id,
      password: password,
      newPassword: newPassword,
    },
    success: function (response) {
      alert(response);
      console.log(response);
    },
  });
}
