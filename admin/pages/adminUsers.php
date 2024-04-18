<?php
require_once('../classes/user.php');
$user = new User();

if (isset($_POST['searchMaNguoiDung']) && $_POST['searchMaNguoiDung'] != "") {

    $searchMaNguoiDung = $_REQUEST['searchMaNguoiDung'];

    $dataUser = $user->searchUserByID($searchMaNguoiDung);

    $result =  $dataUser->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_POST['filterRole']) && $_POST['vaitro'] != "") {
    $role = $_POST['vaitro'];
    $dataUser = $user->filterForRole($role);
    $result =  $dataUser->fetchAll(PDO::FETCH_ASSOC);
} else {
    $dataUser = $user->getAllUsers();
    $result =  $dataUser->fetchAll(PDO::FETCH_ASSOC);
}









?>
<div class="col-sm-12">
    <!-- Basic Table starts -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-header-text">DANH SÁCH TÀI KHOẢN</h5>

            <!-- <p>Basic example <code>without any additional modification</code> classes</p> -->
            <div class="">
                <div class="form-group row">
                    <div class="col-md-4"><label class="sr-only"></label></div>
                    <div class="col-md-4">
                        <div class="input-group" id="dropdown2">

                            <div class="input-group-btn">
                                <button type="button" class="btn btn-info shadow-none addon-btn waves-effect waves-light dropdown-toggle addon-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                </button>
                                <div class="dropdown-menu dropdown-menu-left" style="width: 300px;">
                                    <input type="text" class="form-control" id="searchName" name="username" value="" placeholder="Tên người dùng">
                                    <input type="text" class="form-control" id="searchEmail" name="email" value="" placeholder="Email">
                                    <input type="text" class="form-control" id="searchSdt" name="sdt" value="" placeholder="Số điện thoại">
                                    <button class="btn btn-info form-control" name="search">Tìm kiếm</button>
                                </div>
                            </div>
                            <form action="" method="POST" class="input-group">
                                <input type="text" class="form-control" name="searchMaNguoiDung" value="<?php if (isset($_POST['searchMaNguoiDung'])) echo ($_POST['searchMaNguoiDung']) ?>" placeholder="Mã người dùng">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-info  addon-btn" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>


                            </form>


                            <!-- <div class="input-group-btn">
                                <button type="submit" class="btn btn-info  addon-btn" name="search">Tìm</button>
                            </div> -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label ">
                                    Vai trò:</label>
                                <div class="col-sm-8">

                                    <select class="form-control " id="vaitro" name="vaitro">
                                        <option value="">All
                                        </option>
                                        <?php
                                        $vaitro = $user->getRoles();

                                        foreach ($vaitro as $roles) {
                                            if ($roles['ma_vaitro'] < 3) {
                                                $check = ($roles['ma_vaitro'] == $_POST['vaitro']) ? 'selected' : '';
                                                echo '<option ' . $check . ' value="' . $roles['ma_vaitro'] . '"  >' . $roles['tenvaitro'] . '</option>';
                                            }
                                        }


                                        ?>

                                    </select>


                                </div>
                                <button type="submit" class="btn btn-info col-sm-2" name="filterRole" style="width: 45px; height: 38px;"><i class="fa-solid fa-filter"></i></button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>


        <div class="card-block">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table hover table-bordered">
                        <thead class="">
                            <tr class="bg-info">
                                <th class="text-center">#</th>
                                <th class="text-center">Mã người dùng</th>
                                <th class="text-center">Tên người dùng</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Số điện thoại</th>
                                <th class="text-center">Địa chỉ</th>
                                <th class="text-center">Khoa</th>
                                <th class="text-center">Ngành</th>
                                <th class="text-center">Vai trò</th>
                                <th class="text-center">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php

                            $dem = 1;
                            foreach ($result as $key => $value) {

                                echo ('
                                    <tr>
                                
                                        <td>' . $dem++ . '</td>
                                        <td>' . $value['ma_nguoidung'] . '</td>
                                        <td>' . $value['hoten'] . '</td>
                                        <td>' . $value['email'] . '</td>
                                        <td>' . $value['sodienthoai'] . '</td>
                                        <td>' . $value['diachi'] . '</td>
                                        <td>' . $value['ten_khoavien'] . '</td>
                                        <td>' . $value['ten_nganh'] . '</td>
                                        <td>' . $value['tenvaitro'] . '</td>
                                        <td class="text-center">

                                            <a style="margin: 3px;" class="btn btn-sm btn-inverse-warning " href="?pages=updateUser&ma_nguoidung=' . $value['ma_nguoidung'] . '"  >Cập nhật</a>
                                            <a style="margin: 3px;" class=" btn btn-sm btn-inverse-danger " href="?pages=deleteUser&ma_nguoidung=' . $value['ma_nguoidung'] . '"> </i>Xóa</a>


                                        </td>
                                    </tr>
                                    
                                    ');
                            }


                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Table ends -->
</div>