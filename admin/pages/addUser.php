<?php
include('../classes/department.php');

$d = new Department();

$department = $d->getDepartments();




?>

<div class="row m-5 ">
    <div class="col-md-3"></div>
    <div class="card col-md-6  ">
        <div class="card-header">
            <h5 class=" text-center">THÊM NGƯỜI DÙNG MỚI</h5>
        </div>

        <div class="card-block">
            <form method="" action="" class="" style="display: flex; flex-direction: column">

                <div class="form-group">
                    <label class="form-control-label">Tên người dùng:</label>
                    <input name="" type="text" class="form-control form-control-success" id="txt_ten"
                        placeholder="Nhập họ tên người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input name="" type="text" class="form-control form-control-success" id="txt_email"
                        placeholder="Nhập họ tên người dùng" placeholder="Nhập email người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Số điện thoại:</label>
                    <input name="" type="text" class="form-control form-control-success" id="txt_sdt"
                        placeholder="Nhập số điện thoại người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Địa chỉ:</label>
                    <input name="" type="text" class="form-control form-control-success" id="txt_diachi"
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
                    <select class="form-control" id="id_vaitro" name="vaitro">
                        <option selected value=""></option>
                        <?php
                        // $u = new User();
                        $vaitro = $d->getRoles();

                        foreach ($vaitro as $roles) {

                            echo '<option value="' . $roles['ma_vaitro'] . '"  >' . $roles['tenvaitro'] . '</option>';
                        }


                        ?>

                    </select>
                </div>


                <div class="form-group text-center">
                    <button class="btn btn-primary mt-3" type="button" name="them">Thêm người
                        dùng</button>

                </div>

            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>