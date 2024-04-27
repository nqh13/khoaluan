<?php
require_once(__DIR__ . './../../classes/signUpTopic.php');
$sign  = new SignUptopic();
$result = $sign->getTopicSignUp($_SESSION['ma_nguoidung'])->fetchAll(PDO::FETCH_ASSOC);
$ma_nguoidung = $_SESSION['ma_nguoidung'];


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
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
              onclick="cancelTopic(' . $value['ma_dangky'] . ');"
            >
              <i class="fas fa-cancel"></i>
              Hủy đăng ký
            </button>
          </td>
        </tr>';
          }
          ?>
                    <!-- <tr>
                    <th class="text-center" scope="row">1</th>
                    <td class="text-center" style="width: 5%">ĐỀ TÀI 1</td>
                    <td class="text-center" style="width: 5%">KLTN - ĐH</td>
                    <td style="width: 10%">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut nam
                        fugiat accusamus quam beatae provident laudantium nobis, mollitia
                        sapiente in veritatis totam, hic vitae amet ipsam quia asperiores
                        minima qui.
                    </td>
                    <td style="width: 15%">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum rem
                        commodi tenetur dicta, libero quisquam ipsum quod totam amet
                        similique quasi quis excepturi delectus id alias velit debitis
                        asperiores. Quae?L
                    </td>
                    <td class="text-center" style="width: 10%">PHP, MySQL</td>
                    <td style="width: 15%">
                        Hệ thống website xử lý công việc có độ bảo mật caoL
                    </td>
                    <td class="text-center" style="width: 15%">GVHD 1</td>
                    <td style="width: 10%">

                        <i class="fas fa-lock"></i>
                        <span>Đã khóa</span>

                    </td>
                </tr> -->

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
        $ma_detai = $result[0]['ma_detai'];
        $getSv = $sign->getStudent($ma_detai)->fetchAll(PDO::FETCH_ASSOC);
        $dem = 1;
        $check = 0;


        foreach ($getSv as $students) {
          $check = $_SESSION['ma_nguoidung'] == $students['ma_nguoidung'] ? 0 : 1;
          $valueUI = $check == 1 ? '<td><button class="btn btn-outline-primary btn-sm" id="' . $students['nhom'] . '"  onclick ="addGroup(' . $students['nhom'] . ',' . $ma_nguoidung . ' )"> Chọn nhóm</button></td>' : "";
          echo ('
                    <tr class="text-center">
                        <td>' . $dem++ . '</td>
                        <td>' . $students['hoten'] . '</td>
                        <td>' . $students['sodienthoai'] . '</td>
                        <td>' . $students['email'] . '</td>
                        <td>' . $students['nhom'] . '</td> 
                        ' . $valueUI . '
                    </tr>
                  
                  ');
        }



        ?>

                <!-- <tr class="text-center">
                    <td>2</td>
                    <td>BBBBB</td>
                    <td>0968896032</td>
                    <td>email.com</td>
                    <td><button class="btn btn-outline-primary btn-sm"> Chọn nhóm</button></td>
                </tr> -->

            </tbody>
        </table>


    </div>
</div>