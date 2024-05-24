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
            <h5 class="text-primary text-center" style=" padding: 20px;">DANH SÁCH NGƯỜI DÙNG</h5>

            <!-- <p>Basic example <code>without any additional modification</code> classes</p> -->
            <div class="">
                <div class="form-group row">

                    <div class="col-md-5">
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

                    <div class="col-md-5">
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

                    <div class="col-md-2"><label class="sr-only"></label>
                        <form action="./pages/exportUser.php" method="post">
                            <input type="hidden" name="user_role" value="<?php if (isset($_POST['vaitro'])) echo ($_POST['vaitro'])?>">
                            <button type="submit" class="btn btn-success" name="<?php echo !isset($_POST['filterRole']) ? 'exportUser' : 'exportUserFilter'; ?>" style="width: 100px; height: 38px;"><i class="fa-solid fa-file-export"></i>Xuất File</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>


        <div class="card-block">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table hover table-bordered" id ="data-table">
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
                                $bg = ($value['trangthai'] == 1) ? '' : 'bg-default';
                                echo ('
                                    <tr class="' . $bg . '">
                                
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
                                            
                                            <button type="button" class="btn btn-inverse-danger btn-sm" id="changeStatusButton" data-toggle="modal" data-target="#changeStatusUser"  
                                            data-iduser="' . $value['ma_nguoidung'] . '" data-nameuser="' . $value['hoten'] . '" data-trangthai="' . $value['trangthai'] . '" title="Cập nhật trạng thái" style="margin-right: 5px"> Đổi trạng thái
                                        </button>
                                        
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

<div class="modal fade" id="changeStatusUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-primary text-center" id="exampleModalLabel">ĐỔI TRẠNG THÁI NGƯỜI DÙNG
                </h5>

            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser ?>">
                    <input type="hidden" class="form-control" id="iduser">
                    <div class="form-group">
                        <label for="hoten" class="col-form-label font-weight-bold ">Họ tên:</label>
                        <input type="text" class="form-control" id="nameuser">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label font-weight-bold">Trạng thái:</label>
                        <select class="form-control" name="" id="trangthai">
                            <option value="1" <?php echo $value['trangthai'] == 1 ? 'selected' : '' ?>>Đang hoạt động
                            </option>
                            <option value="2" <?php echo $value['trangthai'] == 2 ? 'selected' : '' ?>>Đã khóa
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class=" btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class=" btn btn-primary" style="margin-left: 10px;" onclick="changeStatusUser()">Lưu</button>
            </div>
        </div>
    </div>
</div>
<script type="">
    document.querySelectorAll('#changeStatusButton').forEach(button => {
    button.addEventListener('click', function() {
        var idUser = this.getAttribute('data-iduser');
        var nameUser = this.getAttribute('data-nameuser');
        var trangThai = this.getAttribute('data-trangthai');
        
        // console.log(idUser, nameUser, trangThai);
        
        document.getElementById('iduser').value = idUser;
        document.getElementById('nameuser').value = nameUser;
        document.getElementById('trangthai').value = trangThai;
    });
});






</script>