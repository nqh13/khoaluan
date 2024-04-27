<?php
require_once(__DIR__ . '../../classes/topic.php');
require_once(__DIR__ . '../../classes/signuptopic.php');
$topic = new Topic();
$signUp = new SignUptopic();


if (isset($_GET['key']) && !empty($_GET['key'])) {
    $key = $_GET['key'];
    $result = $topic->searchTopic($key, $_SESSION['ma_nganh'])->fetchAll(PDO::FETCH_ASSOC);
}

?>

<div class="content mt-3 p-3">
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col" style="width: 5%">STT</th>
                <th scope="col" style="width: 10%">MÃ ĐỀ TÀI</th>
                <th scope="col" style="width: 10%">TÊN ĐỀ TÀI</th>
                <th scope="col" style="width: 5%">LOẠI</th>
                <th scope="col" style="width: 20%">MÔ TẢ</th>
                <th scope="col" style="width: 20%">YÊU CẦU</th>
                <th scope="col" style="width: 10%">KIẾN THỨC & KỸ NĂNG</th>
                <th scope="col" style="width: 15%">GVHD</th>
                <th scope="col" style="width: 5%">SINH VIÊN ĐĂNG KÝ</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (!$result) {
                echo '<tr><td colspan="10" class="text-center">Không tìm thấy kết quả</td></tr>';
            } else {
                foreach ($result as $key => $value) {
                    $count = $signUp->getCountSignUpTopic($value['ma_detai'])->fetchAll(PDO::FETCH_ASSOC);
                    $sldk = $count[0]['Soluongdk'];
                    echo '<tr>
                            <th class="text-center" scope="row">' . ($key + 1) . '</th>
                            <td class="text-center" style="width: 5%">' . $value['ma_detai'] . '</td>
                            <td class="text-center" style="width: 5%">' . $value['tendetai'] . '</td>
                            <td class="text-center" style="width: 15%">' . $value['tenloai'] . '</td>
                            <td style="width: 10%">
                            ' . $value['mota'] . '
                            </td>
                            <td style="width: 15%">
                                ' . $value['yeucau'] . '
                            </td>
                            <td class="text-center" style="width: 10%">' . $value['kienthuc'] . '</td>
                            
                            <td class="text-center" style="width: 10%">' . $value['hoten'] . '</td> 
                            <td class="text-center" style="width: 5%">' . $sldk . '/' . $value['soluong_SV'] . '</td>
                           
                        </tr>';
                }
            }

            ?>
        </tbody>
    </table>

</div>