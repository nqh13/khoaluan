<?php
include('../classes/department.php');

$d = new Department();

$department = $d->getDepartments();


if (isset($_POST['themUser'])) {
}

?>

<div class="row m-5 ">
    <div class="col-md-3"></div>
    <div class="card col-md-6  ">
        <div class="card-header border-bottom">
            <h5 class=" text-center">THÊM NGƯỜI DÙNG MỚI</h5>
        </div>

        <div class="card-block">
            <form method="POST" action="" class="" id="formAddUser" style="display: flex; flex-direction: column"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-control-label">Mã người dùng:</label>
                    <input name="manguoidung" type="text" class="form-control form-control-success" id="manguoidung"
                        placeholder=" Nhập mã người dùng, nếu bỏ trống hệ thống sẽ tự tạo mã">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Tên người dùng:</label>
                    <input name="hoten" type="text" class="form-control form-control-success" id="hoten"
                        placeholder="Nhập họ tên người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input name="email" type="text" class="form-control form-control-success" id="email"
                        placeholder="Nhập họ tên người dùng" placeholder="Nhập email người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Số điện thoại:</label>
                    <input name="sdt" type="text" class="form-control form-control-success" id="sdt"
                        placeholder="Nhập số điện thoại người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Địa chỉ:</label>
                    <input name="diachi" type="text" class="form-control form-control-success" id="diachi"
                        placeholder="Nhập địa chỉ người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" class="form-control-label">Khoa:</label>
                    <select class="form-control" id="id_khoa" name="khoa">
                        <option value="" selected></option>
                        <?php

                        foreach ($department as $key => $value) {

                            echo '<option value="' . $value['ma_khoavien'] . '"  >' . $value['ten_khoavien'] . '</option>';
                        }

                        ?>


                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleSelect1" class="form-control-label">Ngành:</label>
                    <select class="form-control" id="id_nganh" name="nganh">

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" class="form-control-label">Vai Trò:</label>
                    <select class="form-control" id="vaitro" name="vaitro">
                        <option selected value=""></option>
                        <?php

                        $vaitro = $d->getRoles();

                        foreach ($vaitro as $roles) {

                            echo '<option value="' . $roles['ma_vaitro'] . '"  >' . $roles['tenvaitro'] . '</option>';
                        }


                        ?>

                    </select>
                </div>
                <div class="form-group row" id="">
                    <label for="file" class="col-md-2 col-form-label form-control-label">Ảnh:</label>
                    <div class="col-md-9" id="hinhanh">
                        <label for="file" class="custom-file">
                            <input type="file" name="hinhanh" id="file" class="custom-file-input" accept="image/*">
                            <span class="custom-file-control"></span>
                        </label>

                    </div>

                </div>

                <div style="display:flex; justify-content:start; align-items:start">
                    <div class=" d-none" style="position:relative" id="divAnh">
                        <span class=" "
                            style="position:absolute;top:-10px; right:-10px ;font-size: 16px; border-radius: 50%; cursor:pointer; color:red ; font-weight: bold;  "
                            id="btnXoaAnh">x</span>
                        <img src="" alt="" id="imgPreview" width="100px" height="100px">
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" style="margin-top: 10px" type="submit" id="btnThemUser"
                        name="themUser">Thêm người dùng</button>
                </div>

            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<script src="assets/js/validator.js"></script>
<script type="module">
import "https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js";

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
        success: function(data) {

            console.log(data);
            async function sendMail() {
                await axios
                    .post("http://localhost:3000/send-email", {
                        from: "nguyenquangha130901@gmail.com",
                        to: email,
                        subject: "Thông báo cấp tài khoản đăng nhập",
                        text: `Mã đăng nhập:  ${data}`,
                    })
                    .then((res) => {
                        console.log(res);
                        alert("Gửi mail thành công");
                    })
                    .catch((err) => console.log(err));
            }

            sendMail();
            $("#formAddUser")[0].reset();
            $("#divAnh").addClass("d-none");
            $("#imgPreview").attr("src", "");
            $("#hinhanh").removeClass("d-none");
            alert("Thêm user thành công");
            window.location.href = "index.php?pages=quanlyUsers";
        },
    });
}
const validate = () => {
    return Validator({
        form: '#formAddUser',
        errorSelector: '.form-text',
        rules: [
            Validator.isRequired('#hoten'),
            Validator.isRequired('#email'),
            Validator.isRequired('#sdt'),
            Validator.isRequired('#diachi'),
            Validator.isEmail('#email'),
            Validator.isNumberPhone('#sdt'),
        ]
    }, themUser);
}
document.addEventListener('DOMContentLoaded', () => {
    validate();
})
</script>