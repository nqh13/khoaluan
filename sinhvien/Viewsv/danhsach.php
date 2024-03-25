<?php
require_once(__DIR__ . './../../classes/topic.php');
require_once(__DIR__ . './../../classes/signuptopic.php');
$topic = new Topic();
$signUp = new SignUptopic();


$result = $topic->getTopicByStudent($_SESSION['ma_nganh'])->fetchAll(PDO::FETCH_ASSOC);

$checkSignUp = $signUp->checkSignUpTopic($_SESSION['ma_nguoidung'])->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="content mt-2">
    <h5 class="text-center text-primary p-3">DANH SÁCH ĐỀ TÀI KHÓA LUẬN</h5>
    <div class=" p-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col" style="width: 5%">STT</th>
                    <th scope="col" style="width: 10%">TÊN ĐỀ TÀI</th>
                    <th scope="col" style="width: 5%">LOẠI</th>
                    <th scope="col" style="width: 20%">MÔ TẢ</th>
                    <th scope="col" style="width: 20%">YÊU CẦU</th>
                    <th scope="col" style="width: 10%">KIẾN THỨC & KỸ NĂNG</th>

                    <th scope="col" style="width: 15%">GVHD</th>
                    <th scope="col" style="width: 5%">SINH VIÊN ĐĂNG KÝ</th>

                    <th scope="col" style="width: 5%">CHỨC NĂNG</th>
                </tr>
            </thead>
            <tbody>
                <?php


        foreach ($result as $key => $value) {
          $count = $signUp->getCountSignUpTopic($value['ma_detai'])->fetchAll(PDO::FETCH_ASSOC);
          $sldk = $count[0]['Soluongdk'];

          echo '<tr>
              <th class="text-center" scope="row">' . ($key + 1) . '</th>
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
              <td class="text-center font-weight-bold" style="width: 10%"> ' . $sldk . ' / ' . $value['soluong_SV'] . '
              </td>
              <td style="width: 10%">';

          if ($sldk < $value['soluong_SV']) {
            echo '
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
                onclick="signUpTopic(' . $value['ma_detai'] . ', ' . $_SESSION['ma_nguoidung'] . ');">
              <i class="fas fa-edit"></i>Đăng ký</button>
                
                ';
          }



          echo '</td>
            </tr>';
        }



        ?>

            </tbody>
        </table>
    </div>

    <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
    </div>
</div>