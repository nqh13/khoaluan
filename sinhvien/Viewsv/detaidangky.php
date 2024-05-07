<?php
require_once(__DIR__ . './../../classes/signUpTopic.php');
$sign  = new SignUptopic();
$result = $sign->getTopicSignUp($_SESSION['ma_nguoidung'])->fetchAll(PDO::FETCH_ASSOC);
$ma_nguoidung = $_SESSION['ma_nguoidung'];

// var_dump($result);
$status = $result[0]['trangthaidangky'];

?>
<div class="content">

  <div class="tbl-signUp">
    <h5 class="text-center text-primary p-3">ĐỀ TÀI KHÓA LUẬN ĐÃ ĐĂNG KÝ</h5>
    <div class="p-2">
      <table class="table table-bordered ">
        <thead>
          <tr class="text-center">
            <th style="width: 1%">STT</th>
            <th style="width: 10%">MÃ ĐỀ TÀI</th>
            <th style="width: 10%">TÊN ĐỀ TÀI</th>
            <th style="width: 5%">LOẠI</th>
            <th style="width: 20%">MÔ TẢ</th>
            <th style="width: 20%">YÊU CẦU</th>
            <th style="width: 10%">KIẾN THỨC & KỸ NĂNG</th>
            <th style="width: 15%">GVHD</th>
            <th style="width: 10%">NGÀNH</th>
            <th style="width: 10%">TRẠNG THÁI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($result as $key => $value) {
            $buttonCancel ="";
            if($value['trangthaidangky'] == '1'){
              $buttonCancel = '<button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
              onclick="cancelTopic(' . $value['ma_dangky'] . ');"
            >
              <i class="fas fa-cancel"></i>
              Hủy đăng ký
            </button>';
            }
            else{
              $buttonCancel = "-";
            }
            echo '<tr>
          <th class="text-center" scope="row">' . ($key + 1) . '</th>
          <td class="text-center" style="width: 10%">' . $value['ma_detai'] . '</td>
          <td class="text-center" style="width: 5%">' . $value['tendetai'] . '</td>
          <td class="text-center" style="width: 15%">' . $value['tenloai'] . '</td>
          <td style="width: 10%">
          ' . $value['mota'] . '
          </td>
          <td style="width: 15%">
            ' . $value['yeucau'] . '
          </td>
          <td class="text-center" style="width: 10%">' . $value['kienthuc'] . '</td>
          
          <td class="text-center" style="width: 15%">
            ' . $value['hoten'] . '
          </td>
          <td class="text-center" style="width: 10%"> ' . $value['ten_nganh'] . '
          </td>
          <td class="text-center" style="width: 10%">
            ' . $value['tentrangthai'] . '
          </td>
          <td style="width: 10%">
            '.$buttonCancel.'
          </td>
        </tr>';
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>


  <div class="p-2">
    <h5 class="text-center text-primary p-3">DANH SÁCH ĐĂNG KÝ CHUNG ĐỀ TÀI</h5>


    <table class="table table-striped table-bordered">
      <thead>
        <tr class="text-center">
          <th scope="col" style="width: 5%">STT</th>
          <th scope="col" style="width: 10%">TÊN SINH VIÊN</th>
          <th scope="col" style="width: 5%">SỐ ĐIỆN THOẠI</th>
          <th scope="col" style="width: 20%">EMAIL</th>
          <th scope="col" style="width: 10%">NHÓM</th>
          <th scope="col" style="width: 5%">CHỨC NĂNG</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $idGroup = $sign->getGroup($ma_nguoidung);
        $ma_detai = $result[0]['ma_detai'];
        $getSv = $sign->getStudent($ma_detai)->fetchAll(PDO::FETCH_ASSOC);
        $dem = 1;
        $check = 0;

        
        //Check  quantity member on group




        foreach ($getSv as $students) {

          //Check  quantity member on group
          $quantity = $sign->checkQualityStudent($students['nhom']);

          //Check is User 
          $check = $_SESSION['ma_nguoidung'] == $students['ma_nguoidung'] ? 0 : 1;
          $valueUI = $check == 1 ? '<td><button class="btn btn-outline-primary btn-sm" id="' . $students['nhom'] . '"  onclick ="addGroup(' . $students['nhom'] . ',' . $ma_nguoidung . ' )"> Chọn nhóm</button></td>' : "";
          
          $btnCancelGroup = '<button class="btn btn-outline-danger btn-sm" id="' . $students['nhom'] . '"  onclick ="cancelGroup(' . $students['nhom'] . ',' . $ma_nguoidung . ' )"> Hủy nhóm</button>';
          if($students['trangthaidangky'] == 3|| $check == 1 && $students['nhom'] == $idGroup['nhom']  ){
            $valueUI="-";
          }
          
          if( $check ==0 && $students['nhom'] == $idGroup['nhom'] && $quantity == 2){
            $valueUI = '<td><button class="btn btn-outline-danger btn-sm"  onclick ="cancelGroup('.$students['ma_dangky'].','.$ma_detai.','.$ma_nguoidung.' )"> Hủy nhóm</button></td>';
            
          }
          if($status == 3){
            $valueUI = "-";
          }

          echo ('
                    <tr class="text-center">
                        <td>' . $dem++ . '</td>
                        <td>' . $students['hoten'] . '</td>
                        <td>' . $students['sodienthoai'] . '</td>
                        <td>' . $students['email'] . '</td>
                        <td>' . $students['nhom'] . '</td> 
                        ' . $valueUI  . '
                    </tr>
                  
                  ');
        }


        ?>
      </tbody>
    </table>


  </div>
</div>