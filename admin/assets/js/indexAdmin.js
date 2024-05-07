//
//Xử lý lấy dữ liệu ngành học theo khoa.

$(document).ready(function () {
  $("#id_khoa").change(function () {
    var id_khoa = $(this).val();

    $.ajax({
      type: "POST",
      url: "./adminHandle/handleAddUser.php",
      data: {
        id_khoa: id_khoa,
      },
      success: function (data) {
        // console.log(data);
        $("#id_nganh").html(data);
      },
    });
  });
  //Xử lý lọc theo vai trò.
});
// Add Img
$("#file").change(function () {
  var file = this.files[0];
  $("#divAnh").removeClass("d-none");
  $("#imgPreview").attr("src", URL.createObjectURL(file));
  if (file) {
    $("#hinhanh").addClass("d-none");
  }
});
$("#btnXoaAnh").click(function () {
  $("#divAnh").addClass("d-none");
  $("#imgPreview").attr("src", "");
  $("#hinhanh").removeClass("d-none");
});
// Thêm user
function themUser() {
  var manguoidung = $("#manguoidung").val();
  var hoten = $("#hoten").val();
  var email = $("#email").val();
  var sdt = $("#sdt").val();
  var diachi = $("#diachi").val();
  var khoa = $("#id_khoa").val();
  var nganh = $("#id_nganh").val();
  var vaitro = $("#vaitro").val();
  var fileInput = $("#file")[0].files[0];

  var fd = new FormData();
  fd.append("action", "themUser");
  fd.append("manguoidung", manguoidung);
  fd.append("hoten", hoten);
  fd.append("email", email);
  fd.append("sdt", sdt);
  fd.append("diachi", diachi);
  fd.append("khoa", khoa);
  fd.append("nganh", nganh);
  fd.append("vaitro", vaitro);
  fd.append("file", fileInput); // Thêm tệp vào FormData

  $.ajax({
    type: "POST",
    url: "./adminHandle/handleAddUser.php",
    data: fd,
    processData: false, // không xử lý dữ liệu
    contentType: false, // không đặt header Content-Type
    success: async function (data) {
      console.log(data);
      // reset form
      $("#formAddUser")[0].reset();
      $("#divAnh").addClass("d-none");
      $("#imgPreview").attr("src", "");
      $("#hinhanh").removeClass("d-none");
      alert("Thêm user thành công");

      await axios
        .post("http://localhost:3000/send-mail", {
          from: "nguyenquangha130901@gmail.com",
          to: email,
          subject: "Thông báo cấp tài khoản đăng nhập",
          text: "Mã đăng nhập: 19508461 ",
        })
        .then((res) => {
          console.log(res);
        })
        .catch((err) => console.log(err));
      window.location.href = "index.php?pages=quanlyUsers";
    },
  });
}
// Thay đổi trạng thái Users

// Function Xử lý Semester

// Thêm học kì mới:

function addSemester() {
  var tenhocki = document.getElementById("addtenhocki").value;
  var tokenUser = document.getElementById("tokenUser").value;
  var trangthai = document.getElementById("addtrangthai").value;

  // console.log(mahk, tenhocki, tokenUser, trangthai);
  $.ajax({
    type: "POST",
    url: "./adminHandle/handle.php",
    data: {
      action: "addSemester",
      tenhocki: tenhocki,
      tokenUser: tokenUser,
      trangthai: trangthai,
    },
    success: function (response) {
      alert(response);
      window.location.reload();
    },
  });
}

// Cập nhật thông tin học kì:
function updateSemester() {
  var ma_hk = document.getElementById("ma_hk").value;
  var tenhocki = document.getElementById("tenhocki").value;
  var tokenUser = document.getElementById("tokenUser").value;
  var trangthai = document.getElementById("trangthai").value;

  // console.log(mahk, tenhocki, tokenUser, trangthai);
  $.ajax({
    type: "POST",
    url: "./adminHandle/handle.php",
    data: {
      action: "updateSemester",
      ma_hk: ma_hk,
      tenhocki: tenhocki,
      tokenUser: tokenUser,
      trangthai: trangthai,
    },
    success: function (response) {
      alert(response);
      window.location.reload();
    },
  });
}
// Thêm khoa viện admin.

function addDepartment() {
  var tenkhoavien = document.getElementById("tenkhoavien").value;
  var tokenUser = document.getElementById("tokenUser").value;

  if (tenkhoavien == "") {
    alert("Vui lòng nhập đầy đủ thông tin");
  } else {
    $.ajax({
      type: "POST",
      url: "./adminHandle/handle.php",
      data: {
        action: "addDepartment",
        tenkhoavien: tenkhoavien,
        tokenUser: tokenUser,
      },
      success: function (response) {
        alert(response);
        window.location.reload();
      },
    });
  }
}
// Cập nhật thông tin khoa viện.

function updateDepartment() {
  var tenKhoaVien = document.getElementById('tenKhoaUpdate').value;
  var tokenUser = document.getElementById('tokenUser').value;
  var maKhoa = document.getElementById('idKhoaUpdate').value;

  if(tenKhoaVien == ""){
    alert("Vui lòng nhập đầy đủ thông tin");
  }
  else{
      $.ajax({
    type: "POST",
    url: "./adminHandle/handle.php",
    data: { action: "updateDepartment", 
    tenkhoavien: tenKhoaVien, 
    tokenUser: tokenUser, 
    id: maKhoa 
  },
  success: function (response) {
    alert(response);
    window.location.reload();
  },
})
  }
}
//Thêm ngành học mới.
function addMajor(idkhoa) {
  var ten_nganh = document.getElementById("tenNganhMoi").value;
  var tokenUser = document.getElementById("tokenUser").value;

  if(ten_nganh ==""){
    alert("Vui lòng nhập tên ngành học!");
  }
  else{
  $.ajax({
    type: "POST",
    url: "./adminHandle/handle.php",
    data: {
      action: "addMajor",
      ten_nganh: ten_nganh,
      tokenUser: tokenUser,
      khoavien : idkhoa
    },
    success: function (response) {
      alert(response);
      window.location.reload();
    },
  });
  }

}
//Cập nhật thông tin ngành học.

function updateMajor() {
  var idNganhUpdate = document.getElementById("idNganhUpdate").value;
  var tenNganhUpdate = document.getElementById("tenNganhUpdate").value;
  var tokenUser = document.getElementById("tokenUser").value;
  
  if(tenNganhUpdate == ""){
    alert("Vui lòng nhập tên ngành!");
  }
  else{
  $.ajax({
    type: "POST",
    url: "./adminHandle/handle.php",
    data: {
      action: "updateMajor",
      id: idNganhUpdate,
      ten_nganh: tenNganhUpdate,
      tokenUser: tokenUser,
    },
    success: function (response) {
      alert(response);
      window.location.reload();
    },
  });
  }
}


// Thay đổi trạng thái Users
function changeStatusUser() {
  var manguoidung = document.getElementById("iduser").value;
  var trangthai = document.getElementById("trangthai").value;
  var tokenUser = document.getElementById("tokenUser").value;
  var checkconfirm = confirm("Bạn có muốn thay đổi trang thái này?");
  if (checkconfirm == true) {
    $.ajax({
      type: "POST",
      url: "./adminHandle/handleAddUser.php",
      data: {
        action: "changeStatusUser",
        ma_nguoidung: manguoidung,
        trangthai: trangthai,
        tokenUser: tokenUser,
      },
      success: function (response) {
        alert(response);
        window.location.reload();
      },
    });
  }
}
