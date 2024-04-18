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
