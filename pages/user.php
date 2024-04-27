<?php


require_once('./../classes/user.php');

$user = new User();


$info = $user->getUserInfo($_SESSION['ma_nguoidung'])->fetchAll(PDO::FETCH_ASSOC);







?>
<div class="container-fluid">
    <div class="row profile">
        <!-- <div class="col-lg-4 col-md-4 col-sm-12 prf-left">
            <div>
                <img src="./../Uploads/avt.jpg" alt="" style="height: 180px; width: 180px;">
            </div>
            <div class="form-group">
                <div class="control-label"> <span>Mã số sinh viên: <b>19508461</b> </span> </div>
            </div>
            <div class="form-group">
                <div class="control-label"> <span>Họ và tên: <b> Nguyễn Quang Hà</b> </span> </div>
            </div>


        </div> -->
        <div class="col-lg-4">
            <div class="card">
                <div class="user-block-2">
                    <img class="img-fluid" src="./../Uploads/<?php echo $info[0]['hinhanh']; ?>" style="height: 180px; width:180px" alt="user-header">
                    <h5><?php echo  mb_strtoupper($info[0]['hoten'], 'UTF-8'); ?></h5>
                    <h6><?php echo $info[0]['ma_nguoidung']; ?></h6>
                </div>

            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-12 prf-right">
            <div class="border-bottom">
                <h4 class="text-primary bold ">THÔNG TIN CÁ NHÂN</h4>
            </div>
            <div class="form-group">
                <div class="control-label"> <span>Số điện thoại: <b> <?php echo $info[0]['sodienthoai']; ?> </b> </span>
                </div>
            </div>
            <div class="form-group">
                <div class="control-label"> <span>Email: <b> <?php echo $info[0]['email']; ?></b> </span> </div>
            </div>
            <div class="form-group">
                <div class="control-label"> <span>Địa chỉ: <b><?php echo $info[0]['diachi']; ?> </b> </span> </div>
            </div>
            <div class="form-group">
                <div class="control-label"> <span>Khoa: <b><?php echo $info[0]['ten_khoavien']; ?> </b> </span> </div>
            </div>
            <div class="form-group">
                <div class="control-label"> <span>Chuyên ngành: <b><?php echo $info[0]['ten_nganh']; ?></b> </span>
                </div>
            </div>
            <div class="form-group">
                <div class="control-label"> <span>Chức vụ:
                        <b><?php echo $info[0]['vaitro'] == 2 ? 'Giảng viên' : 'Sinh viên'; ?>
                        </b> </span> </div>
            </div>
            <div>
                <a type="button" class="btn btn-success" href="?page=doithongtin">
                    Cập nhật thông tin
                </a>

            </div>
        </div>

    </div>

</div>