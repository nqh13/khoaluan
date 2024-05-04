<?php
require_once('../classes/semester.php');
$semester = new Semester();

$dataSemester = $semester->getAllSemesters()->fetchAll(PDO::FETCH_ASSOC);

// var_dump($dataSemester);



?>
<style>
.btnadd {
    display: flex;
    justify-content: flex-end;
    margin-top: 30px;
    margin-right: 55px;
}
</style>
<div class="col-sm-12 bg-white">
    <div class="row ">

        <div class="col-sm-12 groupadd">
            <div class="btnadd">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addSemester" type="button">
                    Thêm học kì
                </button>
            </div>
        </div>


        <div class="col-sm-12 table-responsive p-5">

            <h4 class="text-center text-primary " style="margin-top: 15px; margin-bottom: 15px">DANH SÁCH HỌC KỲ
            </h4>
            <table class="table  table-bordered mt-5">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">Mã học kỳ</th>
                        <th class="text-center">Tên học kỳ</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($dataSemester as $key => $value) {
                            echo '<tr class="text-center">
                                <td>' . $key . '</td>
                                <td>' . $value['ma_hk'] . '</td>
                                <td>' . $value['tenhocki'] . '</td>
                                <td>' . ($value['trangthai'] == 0 ? 'Đã khóa' : 'Đang mở') . '</td>
                                <td>
                                <button type="button" class="btn btn-primary btn-sm btn-update" data-toggle="modal" data-target="#updateSemester"  
                                data-mahk="' . $value['ma_hk'] . '" data-tenhocki="' . $value['tenhocki'] . '"
                                 data-trangthai="' . $value['trangthai'] . '" title="Cập nhật" style="margin-right: 5px"> 
                                <i class="fa-solid fa-edit" style="margin-right: 5px" ></i>Cập nhật
                            </button>
                            
                                </td>
                            </tr>';
                        }


                        ?>


                </tbody>
            </table>
        </div>


    </div>
    <!-- Modal -->

    <div class="modal fade" id="updateSemester" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-primary text-center" id="exampleModalLabel">CẬP NHẬT THÔNG TIN HỌC KỲ
                    </h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser ?>">
                        <input type="hidden" name="ma_hk" id="ma_hk">
                        <div class="form-group">
                            <label for="tenhocki" class="col-form-label font-weight-bold ">Tên học kỳ:</label>
                            <input type="text" class="form-control" id="tenhocki">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label font-weight-bold">Trạng thái:</label>
                            <select class="form-control" name="" id="trangthai">
                                <option value="0" <?php echo $value['trangthai'] == 0 ? 'selected' : '' ?>>Đã khóa
                                </option>
                                <option value="1" <?php echo $value['trangthai'] == 1 ? 'selected' : '' ?>>Đang mở
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class=" btn btn-primary" style="margin-left: 10px;"
                        onclick="updateSemester()">Cập
                        nhật</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSemester" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-primary text-center" id="">THÊM HỌC KỲ MỚI
                    </h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser ?>">
                        <div class="form-group">
                            <label for="tenhocki" class="col-form-label font-weight-bold ">Tên học kỳ:</label>
                            <input type="text" class="form-control" id="addtenhocki">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label font-weight-bold">Trạng thái:</label>
                            <select class="form-control" name="" id="addtrangthai">
                                <option value="0">Đã khóa</option>
                                <option value="1" selected>Đang mở</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class=" btn btn-primary" style="margin-left: 10px;"
                        onclick="addSemester()">Thêm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <script type="text/javascript">
    document.querySelectorAll('.btn-update').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var ma_hk = this.getAttribute('data-mahk');
            var tenhocki = this.getAttribute('data-tenhocki');
            var trangthai = this.getAttribute('data-trangthai');

            // Đặt giá trị cho các trường input trong modal
            document.getElementById('tenhocki').value = tenhocki;
            document.getElementById('trangthai').value = trangthai;
            document.getElementById('ma_hk').value = ma_hk;
        });
    });
    </script>