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

var logoutTimer;
var logoutTimeLimit = 1 * 60 * 1000; // 30 phút
var userActive = false; // Biến để kiểm tra người dùng có đang tương tác không

// Hàm bắt đầu đếm thời gian đăng xuất
function startLogoutTimer() {
  logoutTimer = setTimeout(logout, logoutTimeLimit);
}

// Hàm reset đếm thời gian đăng xuất
function resetLogoutTimer() {
  clearTimeout(logoutTimer);
  startLogoutTimer();
}

// Hàm đăng xuất
function logout() {
  console.log("Thời gian đăng nhập đã hết. Đã thực hiện đăng xuất.");
  // Thực hiện hành động đăng xuất ở đây
}

// Lắng nghe sự kiện khi người dùng chuyển tab hoặc cửa sổ mới
document.addEventListener("visibilitychange", function () {
  if (document.visibilityState === "visible") {
    userActive = true;
    resetLogoutTimer();
  } else {
    userActive = false;
  }
});

// Bắt đầu đếm thời gian đăng xuất khi trang được tải
startLogoutTimer();

//Thêm đề tài GV

function handelAddTopic(ma_nguoidung, ma_nganh) {
  var tokenUser = $("#tokenUser").val();
  var tendetai = $("#tendetai").val();
  var mota = $("#mota").val();
  var yeucau = $("#yeucau").val();
  var kienthuc = $("#kienthuc").val();
  var soluong_SV = $("#soluong_SV").val();
  var loaidt = $("#loaidt").val();
  var hocki = $("#hocki").val();
  $.ajax({
    type: "POST",
    url: "./../handle/xuly.php",
    data: {
      ma_GV: ma_nguoidung,
      ma_nganh: ma_nganh,
      tokenUser: tokenUser,
      action: "addTopic",
      tendetai: tendetai,
      mota: mota,
      yeucau: yeucau,
      kienthuc: kienthuc,
      soluong_SV: soluong_SV,
      loai: loaidt,
      hocki: hocki,
    },
    success: function (response) {
      alert(response);
      window.location.href = "index.php?page=danhsach";
    },
  });
}

//Sửa đề tài GV.
function handelUpdateTopic(idTopic) {
  var tokenUser = $("#tokenUser").val();
  var tendetai = $("#tendetai").val();
  var mota = $("#mota").val();
  var yeucau = $("#yeucau").val();
  var kienthuc = $("#kienthuc").val();
  var soluong = $("#soluong").val();
  var loai = $("#loai").val();
  var hocki = $("#hocki").val();
  $.ajax({
    type: "POST",
    url: "./../handle/xuly.php",
    data: {
      idTopic: idTopic,
      action: "updateTopic",
      tendetai: tendetai,
      tokenUser: tokenUser,
      mota: mota,
      yeucau: yeucau,
      kienthuc: kienthuc,
      soluong: soluong,
      loai: loai,
      hocki: hocki,
    },
    success: function (response) {
      alert(response);
      window.location.href = "index.php?page=danhsach";
    },
  });
}

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

function changePassword(id) {
  var password = document.getElementById("password").value;
  var newPassword = document.getElementById("newpassword").value;
  var passwordConfirm = document.getElementById("confirmpass").value;
  var token = document.getElementById("tokenUser").value;
  if (password != "" && newPassword != "" && passwordConfirm != "") {
    if (newPassword != passwordConfirm) {
      alert("Mật khẩu nhập lại không đúng!");
    } else {
      $.ajax({
        type: "POST",
        url: "./../sinhvien/handle/UserHandle.php",
        data: {
          action: "changePassword",
          id_user: id,
          tokenUser: token,
          password: password,
          newPassword: newPassword,
        },
        success: function (response) {
          alert(response);
          window.location.reload();
        },
      });
    }
  } else {
    alert("Vui lòng điền đầy đủ thông tin!");
  }
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

// Hủy nhóm đăng ký đề tài.
function cancelGroup(id_dk, id_topic,ma_SV){

  var cofirm = confirm("Bạn chắc chắn muốn hủy nhóm đăng ký đề tài này?");
  if(cofirm === true){
    $.ajax({
      type: "POST",
      url: "./../sinhvien/handle/SignUpTopic.php",
      data: {
        action: "cancelGroup",
        ma_dangky: id_dk,
        ma_detai: id_topic,
        ma_SV: ma_SV,

      },
      success: function (response) {
        alert(response);
        window.location.reload();
      },
    });
  }


} 



//Cập nhậtthông tin
function updateInfo() {
  var sessionUser = document.getElementById("sessionUser").value;
  var id = document.getElementById("ma_nguoidung").value;
  var email = document.getElementById("email").value;
  var sdt = document.getElementById("sdt").value;
  var diachi = document.getElementById("diachi").value;

  $.ajax({
    type: "POST",
    url: "./../sinhvien/handle/UserHandle.php",
    data: {
      action: "updateInfo",
      sessionUser: sessionUser,
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
  
  if(tieude == "" || ngaytao == "" || ngayhethan == ""){
    alert("Vui lòng điền đầy đủ thông tin!");
    
  }
  else{
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

//Tạo cuộc thảo luận SV.

function createDiscussion(idUser) {
  var tieude = document.getElementById("tieude").value;
  var noidung = document.getElementById("noidung").value;
  var madetai = document.getElementById("madetai").value;
  var tokenUser = document.getElementById("tokenUser").value;

  if (tieude == "" || noidung == "") {
    alert("Vui lòng điền đầy đủ thông tin");
  } else {
    $.ajax({
      type: "POST",
      url: "./../handle/xuly.php",
      data: {
        action: "createDiscussion",
        tieude: tieude,
        noidung: noidung,
        madetai: madetai,
        tokenUser: tokenUser,
        ma_nguoidung: idUser,
      },
      success: function (response) {
        alert(response);
        window.location.reload();
      },
    });
  }
}

// Update thảo luận.

function updateDiscussion(idDiscussion) {
  var tieude = document.getElementById("titleUpdate").value;
  var noidung = document.getElementById("contentUpdate").value;
  var tokenUser = document.getElementById("tokenUser").value;
  $.ajax({
    type: "POST",
    url: "./../handle/xuly.php",
    data: {
      action: "updateDiscussion",
      tieude: tieude,
      noidung: noidung,
      tokenUser: tokenUser,
      mathaoluan: idDiscussion,
    },
    success: function (response) {
      alert(response);
      window.location.reload();
    },
  });
}

// 


