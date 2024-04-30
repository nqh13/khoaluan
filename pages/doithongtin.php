<?php

require_once('./../classes/user.php');

$user = new User();


$info = $user->getUserInfo($_SESSION['ma_nguoidung'])->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="content">
    <div class="container-fluid">
        <div class="row profile">
            <div class="col-lg-4 col-md-4 col-sm-12 prf-left" style="margin-top: 40px;">
                <div class="card">
                    <div class="user-block-2">
                        <img class="img-fluid" src="./../Uploads/<?php echo $info[0]['hinhanh']; ?>" style="height: 180px; width:180px" alt="user-header">
                        <h5><?php echo  mb_strtoupper($info[0]['hoten'], 'UTF-8'); ?></h5>
                        <h6 id="id_user">MSSV: <?php echo $info[0]['ma_nguoidung']; ?></h6>
                    </div>

                </div>




            </div>

            <div class="col-lg-8 col-md-8 col-sm-12 prf-right">
                <div class="border-bottom">
                    <h4 class="text-primary text-center ">CẬP NHẬT THÔNG TIN CÁ NHÂN</h4>
                </div>
                <form action="" method="post" class="" id="formUpdateInfo" style=" padding:50px" enctype="multipart/form-data">
                    <input type="hidden" name="sessionUser" id="sessionUser" value="<?php echo $tokenUser ?>">

                    <div class="form-group">
                        <label for="">Số điện thoại:</label>
                        <input type="text" class="form-control" name="sdt" id="sdt" aria-describedby="helpId" value="<?php echo $info[0]['sodienthoai']; ?>" placeholder="Nhập số điện thoại" required>
                        <small id="erSdt" class="form-text"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" value="<?php echo $info[0]['email']; ?>" placeholder="Nhập email" required>
                        <small id="erEmail" class="form-text "></small>
                    </div>
                    <div class="form-group">
                        <label for="">Nhập địa chỉ</label>
                        <input type="text" class="form-control" name="diachi" id="diachi" aria-describedby="helpId" value="<?php echo $info[0]['diachi']; ?>" placeholder="Nhập địa chỉ mới" required>
                        <small id="ersdt" class="form-text "></small>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="ma_nguoidung" id="ma_nguoidung" value="<?php echo $info[0]['ma_nguoidung']; ?>">
                    </div>
                    <div>
                        <button type="submit" name="updateInfo" class="btn btn-success" href="">
                            Cập nhật thông tin
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


</div>
<script src="../Assets/js/validate.js"></script>
<script>
    const validate = () => {
        return Validator({
            form: '#formUpdateInfo',
            errorSelector: '.form-text',
            rules: [
                Validator.isRequired('#email'),
                Validator.isRequired('#sdt'),
                Validator.isRequired('#diachi'),
                Validator.isEmail('#email'),
                Validator.isNumberPhone('#sdt'),
            ]
        }, updateInfo);
    }
    document.addEventListener('DOMContentLoaded', () => {
        validate();
    })
</script>