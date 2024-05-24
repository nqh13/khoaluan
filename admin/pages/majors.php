<?php
require_once('../classes/department.php');
require_once('../classes/majors.php');
$department = new Department();
$major = new Majors();


if(isset($_GET['khoavien']) && $_GET['khoavien'] != ""){

  $dataMajors = $major->getMajorByDepartment($_GET['khoavien']);
  $dataDepartment = $department->getDepartmentById($_GET['khoavien'])->fetch(PDO::FETCH_ASSOC);
  
}


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
      <h5 class="card-header-text">QUẢN LÝ NGÀNH HỌC <?php echo $dataDepartment['ten_khoavien']?></h5>
    </div>
    <div class="btnadd">
      <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#addMajor"> <i class="fa fa-plus " style="margin-right: 5px;"> </i>THÊM NGÀNH MỚI</button>
    </div>
    <div class="card-block">
      <div class="row">
        <div class="col-sm-12 table-responsive">
          <table class="table table-bordered">
            <thead class="bg-primary">
              <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Mã ngành học</th>
                <th class="text-center">Tên ngành học</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $dem = 1;
              foreach ($dataMajors as $key => $value) {
                // $countMajors = $major->countMajorByDepartment($value['ma_khoavien'])->fetchColumn();
                echo '
                                 <tr class="text-center">
                                    <td>' . $dem++ . '</td>
                                    <td>' . $value['ma_nganh'] . '</td>
                                    <td>' . $value['ten_nganh'] . '</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm " style="color: white;" id="btnUpdateMajor" data-toggle="modal" data-target="#updateMajor" data-ma_nganh="' . $value['ma_nganh'] . '" data-tennganh="' . $value['ten_nganh'] . '" > Chinh sửa</button>
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
<div class="modal fade" id="addMajor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-primary text-center" id="exampleModalLabel">THÊM NGÀNH MỚI</h5>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser ?>">
          <div class="form-group">
            <label for="tenkhoavien" class="col-form-label font-weight-bold ">Tên Ngành:</label>
            <input type="text" class="form-control" id="tenNganhMoi" placeholder="Nhập tên ngành mới">
          </div>
        </form>
      </div>
      <div class="modal-footer ">
        <button type="button" class=" btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="button" class=" btn btn-primary" style="margin-left: 10px;" onclick="addMajor(<?php echo $_GET['khoavien']?>)">Thêm</button>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->
<!-- Modal EditDepartment -->
<div class="modal fade" id="updateMajor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-primary text-center" id="exampleModalLabel">CẬP NHẬT THÔNG TIN NGÀNH HỌC</h5>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser ?>">
          <input type="hidden" class="form-control" id="idNganhUpdate">
          <div class="form-group">
            <label for="tenkhoavien" class="col-form-label font-weight-bold ">Tên ngành:</label>
            <input type="text" class="form-control" id="tenNganhUpdate">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="button" class=" btn btn-primary" style="margin-left: 10px;" onclick="updateMajor()">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->

<script>
  document.querySelectorAll('#btnUpdateMajor').forEach(button => {
    button.addEventListener('click', function() {
        var idNganh= this.getAttribute('data-ma_nganh');
        var tenNganh = this.getAttribute('data-tennganh');
        
        document.getElementById('tenNganhUpdate').value = tenNganh;
        document.getElementById('idNganhUpdate').value = idNganh;
        
    });
});


</script>