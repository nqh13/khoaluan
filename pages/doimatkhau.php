<div class=" content p-3 frm-changepass ">
    <form action="" method="post" class="doi-pass" id="formChangePass" enctype=" multipart/form-data">
        <input type="hidden" name="sessionUser" id="tokenUser" value="<?php echo $tokenUser ?>">
        <input type="hidden" name="ma_nguoidung" id="ma_nguoidung" value="<?php echo $_SESSION['ma_nguoidung'] ?>">

        <div class="form-group border-bottom" style="width: 100%">
            <h5 class="text-primary text-center ">ĐỔI MẬT KHẨU</h5>
        </div>
        <div class="form-group" style="width: 100%">
            <!-- <label for="">Mật khẩu cũ:</label> -->
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" value=""
                placeholder="Mật khẩu cũ">
            <small id="er_pass" class="form-text"></small>
        </div>
        <div class="form-group" style="width: 100%">
            <!-- <label for="">Mật khẩu mới:</label> -->
            <input type="password" class="form-control" name="newpassword" id="newpassword" aria-describedby="helpId"
                value="" placeholder="Mật khẩu mới">
            <small id="er_newpass" class="form-text"></small>
        </div>
        <div class="form-group" style="width: 100%">
            <!-- <label for="">Nhập lại mật khẩu mới:</label> -->
            <input type="password" class="form-control" name="confirmpassword" id="confirmpass"
                aria-describedby="helpId" value="" placeholder="Nhập lại mật khẩu mới">
            <small id="er_confirmpass" class="form-text"></small>
        </div>
        <div>
            <button name="changePasss" id="" type="submit" class="btn btn-primary" href="">
                Lưu thay đổi
            </button>

        </div>
    </form>

</div>
<script src="../Assets/js/validate.js"></script>
<script>
const validate = () => {
    return Validator({
        form: '#formChangePass',
        errorSelector: '.form-text',
        rules: [
            Validator.isRequired('#password'),
            Validator.isRequired('#newPassword'),
            Validator.isRequired('#confirmpass'),
            Validator.minLength('#newpassword', 8, 'mật khẩu tối thiểu phải có 8 kí tự!'),
            Validator.isConfirmed('#confirmpass', function() {
                return document.querySelector('#formChangePass #newpassword').value;
            }, 'Mật khẩu không khớp nhau!'),
        ],

    }, changePassword);
}
document.addEventListener('DOMContentLoaded', () => {
    validate();
})
</script>