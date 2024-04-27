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
//Thêm đề tài GV

function handelAddTopic(ma_nguoidung, ma_nganh) {
  var tendetai = $("#tendetai").val();
  var mota = $("#mota").val();
  var yeucau = $("#yeucau").val();
  var kienthuc = $("#kienthuc").val();
  var soluong_SV = $("#soluong_SV").val();
  var loaidt = $("#loaidt").val();
  $.ajax({
    type: "POST",
    url: "./../handle/xuly.php",
    data: {
      ma_GV: ma_nguoidung,
      ma_nganh: ma_nganh,
      action: "addTopic",
      tendetai: tendetai,
      mota: mota,
      yeucau: yeucau,
      kienthuc: kienthuc,
      soluong_SV: soluong_SV,
      loai: loaidt,
    },
    success: function (response) {
      alert(response);
      window.location.href = "index.php?page=danhsach";
    },
  });
}

//Sửa đề tài GV.

//Xóa đề tài GV.

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
      success: function (response) {
        alert(response);
        window.location.href = "index.php?page=danhsach";
      },
    });
  }
}

// Đăng ký đề tài
function signUpTopic(id, ma_SV) {
  $confirm = confirm("Bạn chắc chắn muốn chọn đặt ký đề tài này?");
  if ($confirm === true) {
    $.ajax({
      type: "POST",
      url: "./../sinhvien/handle/SignUpTopic.php",
      data: {
        action: "signUpTopic",
        ma_detai: id,
        ma_SV: ma_SV,
      },
      success: function (response) {
        alert(response);
        window.location.href = "index.php?page=detai";
      },
    });
  }
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

//Chọn nhóm.
function addGroup(id_nhom, ma_SV) {
  $comfirm = confirm("Bạn chắc chắn muốn chọn nhóm này?");
  if ($comfirm === true) {
    $.ajax({
      type: "POST",
      url: "./../sinhvien/handle/SignUpTopic.php",
      data: {
        action: "addGroup",
        nhom: id_nhom,
        ma_SV: ma_SV,
      },
      success: function (response) {
        alert(response);
        // console.log(response);
        window.location.reload();
      },
    });
  }
}

//Cập nhậtthông tin
function updateInfo() {
  var id = document.getElementById("ma_nguoidung").value;
  var email = document.getElementById("email").value;
  var sdt = document.getElementById("sdt").value;
  var diachi = document.getElementById("diachi").value;

  $.ajax({
    type: "POST",
    url: "./../sinhvien/handle/UserHandle.php",
    data: {
      action: "updateInfo",
      sdt: sdt,
      email: email,
      diachi: diachi,
    },
    success: function (response) {
      alert(response);
      window.location.href = "index.php?page=thongtin";
    },
  });
}

// Lấy thông tin sinh viên đăng ký đề tài.
function getDataStudentSignUp(id_topic) {
  $.ajax({
    type: "POST",
    url: "./../handle/xuly.php",
    data: {
      action: "getDataStudentSignUp",
      id_topic: id_topic,
    },
    success: function (response) {
      $("#dataStudentSignUp").html(response);
      console.log(response);
    },
  });
}
//Lấy thời gian hiện tại

var now = new Date();
// Chuyển múi giờ của ngày hiện tại sang múi giờ của máy tính cá nhân của người dùng
var localTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000);

document.getElementById("ngaytao").value = localTime.toISOString().slice(0, 16);

// Tạo báo cáo:

function createReport(id_topic) {
  var tieude = document.getElementById("tieudebaocao").value;
  var ngaytao = document.getElementById("ngaytao").value;
  var ngayhethan = document.getElementById("ngayhethan").value;
  var ghichu = document.getElementById("ghichubaocao").value;

  $.ajax({
    type: "POST",
    url: "./../handle/xuly.php",
    data: {
      action: "createReport",
      detai: id_topic,
      tieude: tieude,
      ngaytao: ngaytao,
      ngayhethan: ngayhethan,
      ghichu: ghichu,
    },
    success: function (response) {
      alert(response);
      window.location.href = "index.php?page=chitiet&id=" + id_topic;
    },
  });
}

// Cập nhật thông tin báo cáo GV:
function updateInforReport(id) {
  var tieude = document.getElementById("tieude").value;
  var ngaytao = document.getElementById("ngaytao").value;
  var ngayhethan = document.getElementById("ngayhethan").value;
  var ghichu = document.getElementById("ghichu").value;

  $.ajax({
    type: "POST",
    url: "./../handle/xuly.php",
    data: {
      action: "updateInforReport",
      ma_baocao: id,
      tieude: tieude,
      ngaytao: ngaytao,
      ngayhethan: ngayhethan,
      ghichu: ghichu,
    },
    success: function (response) {
      alert(response);
      window.location.href = "index.php?page=ctbaocao&id=" + id;
    },
  });
}

function deleteReport(idReport) {
  var table = document.getElementById("table-report-detail");
  // Lấy ô cụ thể trong bảng, ví dụ: hàng 1, cột 0 (đếm từ 0)
  var cell = table.rows[1].cells[1];
  // Lấy giá trị của ô
  var valueIDTopic = cell.innerHTML;

  var option = confirm("Bạn có muốn xoá báo cáo này không?");
  if (option === true) {
    $.ajax({
      url: "./../handle/xuly.php",
      method: "Post",
      data: {
        ma_baocao: idReport,
        action: "deleteReport",
      },
      success: function (response) {
        alert(response);
        window.location.href = "index.php?page=chitiet&id=" + valueIDTopic;
      },
    });
  }
}

// Hiển thị + Ân Password

function showPassword() {
  var x = document.getElementById("password");
  var icon = document.getElementById("showpass");
  if (x.type === "password") {
    x.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    x.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}

//File upload
