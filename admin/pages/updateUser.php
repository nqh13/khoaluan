<?php
require_once('../classes/department.php');
require_once('../classes/user.php');
$user = new User();
$d = new Department();
$department = $d->getDepartments();



if (isset($_GET['ma_nguoidung'])) {
    $ma_nguoidung = $_GET['ma_nguoidung'];

    $dataUser = $user->searchUserByID($ma_nguoidung);
    $result =  $dataUser->fetchAll(PDO::FETCH_ASSOC)[0];
}
// var_dump($result);




?>

<div class="row m-5 ">
    <div class="col-md-3"></div>
    <div class="card col-md-6  ">
        <div class="card-header border-bottom">
            <h5 class=" text-center">CẬP NHẬT THÔNG TIN NGƯỜI DÙNG</h5>
        </div>

        <div class="card-block">
            <form method="POST" action="" class="" id="formUpdateUser" style="display: flex; flex-direction: column" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-control-label">Mã người dùng:</label>
                    <input name="manguoidung" type="text" class="form-control form-control-success" id="manguoidung" value="<?php echo $result['ma_nguoidung']; ?>" placeholder=" Nhập mã người dùng, nếu bỏ trống hệ thống sẽ tự tạo mã">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Tên người dùng:</label>
                    <input name="hoten" type="text" class="form-control form-control-success" id="hoten" value="<?php echo $result['hoten']; ?>" placeholder="Nhập họ tên người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input name="email" type="text" class="form-control form-control-success" id="email" value="<?php echo $result['email']; ?>" placeholder="Nhập họ tên người dùng" placeholder="Nhập email người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Số điện thoại:</label>
                    <input name="sdt" type="text" class="form-control form-control-success" id="sdt" value="<?php echo $result['sodienthoai']; ?>" placeholder="Nhập số điện thoại người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Địa chỉ:</label>
                    <input name="diachi" type="text" class="form-control form-control-success" id="diachi" value="<?php echo $result['diachi']; ?>" placeholder="Nhập địa chỉ người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" class="form-control-label">Khoa:</label>
                    <select class="form-control" id="id_khoa" name="khoa">
                        <option value="<?php echo $result['ma_khoavien']; ?>" selected>
                            <?php echo $result['ten_khoavien']; ?></option>
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

                        <option value="<?php echo $result['ma_nganh']; ?>" selected>
                            <?php echo $result['ten_nganh']; ?></option>
                        <?php



                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" class="form-control-label">Vai Trò:</label>
                    <select class="form-control" id="vaitro" name="vaitro">
                        <option selected value="<?php echo $result['ma_vaitro']; ?>">
                            <?php echo $result['tenvaitro']; ?></option>
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
                    <div class="<?= $result['hinhanh'] != "" ? "" : " d-none" ?>" style="position:relative" id="divAnh">
                        <span class=" " style="position:absolute;top:-10px; right:-10px ;font-size: 16px; border-radius: 50%; cursor:pointer; color:red ; font-weight: bold;  " id="btnXoaAnh">x</span>
                        <img src="../Uploads/<?php echo $result['hinhanh']; ?>" alt="" id="imgPreview" width="100px" height="100px">
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" style="margin-top: 10px" type="submit" id="btnThemUser" name="updateUser">Cập nhật</button>

                </div>

            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>