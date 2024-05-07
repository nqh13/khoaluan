<?php
require_once('../classes/department.php');
require_once('../classes/majors.php');
$department = new Department();
$major = new Majors();

$dataDepartment = $department->getDepartments()->fetchAll(PDO::FETCH_ASSOC);



?>
<style>
  .btnadd {
    display: flex;
    justify-content: flex-end;
    margin-top: 5px;
    margin-right: 55px;
  }
</style>

<div class="col-sm-12">
  <!-- Basic Table starts -->
  <div class="card">
    <div class="card-header">
      <h5 class="card-header-text">QUẢN LÝ KHOA VIỆN</h5>
    </div>
    <div class="btnadd">
      <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#addDepartment"> <i class="fa fa-plus " style="margin-right: 5px;"> </i>THÊM KHOA VIỆN</button>
    </div>
    <div class="card-block">
      <div class="row">
        <div class="col-sm-12 table-responsive">
          <table class="table table-bordered">
            <thead class="bg-primary">
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Mã khoa viện</th>
                <th class="text-center">Tên khoa viện</th>
                <th class="text-center">Số ngành hiện có</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($dataDepartment as $key => $value) {
                $countMajors = $major->countMajorByDepartment($value['ma_khoavien'])->fetchColumn();
                echo '
                                 <tr class="text-center">
                                    <td>' . $key++ . '</td>
                                    <td>' . $value['ma_khoavien'] . '</td>
                                    <td>' . $value['ten_khoavien'] . '</td>
                                    <td>' . $countMajors . '</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm " href="?pages=nganh&khoavien=' . $value['ma_khoavien'] . '" style="color: white;" > Chi tiết</a>
                                        <button class="btn btn-warning btn-sm " style="color: white;" id="btnUpdateDepartment" data-toggle="modal" data-target="#updateDepartment" data-ma_khoavien="' . $value['ma_khoavien'] . '" data-tenkhoavien="' . $value['ten_khoavien'] . '" > Chinh sửa</button>
                                    </td>
                                </tr>
                             
                             ';
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
<!-- Modal Add Department -->
<div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-primary text-center" id="exampleModalLabel">THÊM KHOA VIỆN</h5>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser ?>">
          <div class="form-group">
            <label for="tenkhoavien" class="col-form-label font-weight-bold ">Tên khoa viện:</label>
            <input type="text" class="form-control" id="tenkhoavien">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="button" class=" btn btn-primary" style="margin-left: 10px;" onclick="addDepartment()">Thêm</button>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->
<!-- Modal EditDepartment -->
<div class="modal fade" id="updateDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-primary text-center" id="exampleModalLabel">CẬP NHẬT THÔNG TIN KHOA VIỆN</h5>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser ?>">
          <input type="hidden" class="form-control" id="idKhoaUpdate">
          <div class="form-group">
            <label for="tenkhoavien" class="col-form-label font-weight-bold ">Tên khoa viện:</label>
            <input type="text" class="form-control" id="tenKhoaUpdate">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="button" class=" btn btn-primary" style="margin-left: 10px;" onclick="updateDepartment()">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->

<script>
  document.querySelectorAll('#btnUpdateDepartment').forEach(button => {
    button.addEventListener('click', function() {
        var idKhoaVien = this.getAttribute('data-ma_khoavien');
        var tenKhoaVien = this.getAttribute('data-tenkhoavien');
      
        console.log(idKhoaVien, tenKhoaVien);
        
        document.getElementById('tenKhoaUpdate').value = tenKhoaVien;
        document.getElementById('idKhoaUpdate').value = idKhoaVien;
        
    });
});


</script>