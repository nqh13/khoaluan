<div class=" content p-3 frm-changepass d-flex flex-column mt-3 ">
    <div class="form-group border-bottom" style="width: 100%">
        <h5 class="text-primary text-center ">ĐỔI MẬT KHẨU</h5>
    </div>
    <form action="" method="post" class="doi-pass" id="formChangePass" enctype=" multipart/form-data">
        <input type="hidden" name="sessionUser" id="tokenUser" value="<?php echo $tokenUser ?>">
        <input type="hidden" name="ma_nguoidung" id="ma_nguoidung" value="<?php echo $_SESSION['ma_nguoidung'] ?>">
        <div class="form-group" style="width: 100%">
            <label for="">Mật khẩu cũ:</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" value="" required>
            <small id="er_pass" class="form-text"></small>
        </div>
        <div class="form-group" style="width: 100%">
            <label for="">Mật khẩu mới:</label>
            <input type="password" class="form-control" id="newpassword" aria-describedby="helpId" value="" required>
            <small id="er_newpass" class="form-text"></small>
        </div>
        <div class="form-group" style="width: 100%">
            <label for="">Nhập lại mật khẩu mới:</label>
            <input type="password" class="form-control" id="confirmpass" aria-describedby="helpId" value="" required>
            <small id="er_confirmpass" class="form-text"></small>
        </div>
        <div>
            <button name="changePasss" id="" type="button" onclick="changePassword(<?php echo $_SESSION['ma_nguoidung'] ?>)" class="btn btn-primary">
                Lưu thay đổi
            </button>

        </div>
    </form>

</div>
<script src="../Assets/js/validate.js"></script>
<script>
    Validator({
        form: '#formChangePass',
        errorSelector: '.form-text',
        rules: [
            Validator.isRequired('#password'),
            Validator.isRequired('#newPassword'),
            Validator.isRequired('#confirmpass'),
            Validator.minLength('#newpassword', 8, 'Mật khẩu tối thiểu phải có 8 kí tự!'),
            Validator.isConfirmed('#confirmpass', function() {
                return document.querySelector('#formChangePass #newpassword').value;
            }, 'Mật khẩu không khớp nhau!'),
        ],

    }, );
</script>