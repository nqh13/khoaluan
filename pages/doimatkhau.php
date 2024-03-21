<div class=" content p-3 frm-changepass ">
    <form action="" method="post" class="doi-pass" id="" enctype=" multipart/form-data">
        <div class="form-group border-bottom" style="width: 100%">
            <h5 class="text-primary text-center ">ĐỔI MẬT KHẨU</h5>
        </div>
        <div class="form-group" style="width: 100%">
            <!-- <label for="">Mật khẩu cũ:</label> -->
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" value="" placeholder="Mật khẩu cũ" required>
            <small id="er_pass" class="form-text text-danger"></small>
        </div>
        <div class="form-group" style="width: 100%">
            <!-- <label for="">Mật khẩu mới:</label> -->
            <input type="password" class="form-control" name="newpassword" id="newpassword" aria-describedby="helpId" value="" placeholder="Mật khẩu mới" required>
            <small id="er_newpass" class="form-text text-danger"></small>
        </div>
        <div class="form-group" style="width: 100%">
            <!-- <label for="">Nhập lại mật khẩu mới:</label> -->
            <input type="password" class="form-control" name="confirmpassword" id="confirmpass" aria-describedby="helpId" value="" placeholder="Nhập lại mật khẩu mới" required>
            <small id="er_confirmpass" class="form-text text-danger"></small>
        </div>
        <div>
            <button type="button" name="changePasss" id=" " onclick="changePassword(<?php echo $_SESSION['ma_nguoidung'] ?>)" class="btn btn-primary" href="">
                Lưu thay đổi
            </button>

        </div>
    </form>

</div>