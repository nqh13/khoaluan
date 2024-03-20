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

function updateInfoUser(id) {
  var sdt = document.getElementById(id);
  $.ajax({
    type: "POST",
    url: "./../sinhvien/handle/UserHandle.php",
    data: {
      action: "updateInfo",
      id: id,
    },
    success: function (response) {
      alert("Đã cập nhật!");
      window.location.href = "index.php";
    },
  });
}
