<?php
require_once('../classes/semester.php');
$semester = new Semester();

// $detaiList = $topic->getTopicByGV($_SESSION['ma_nguoidung']);

$listSemester = $semester->getAllSemesters()->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['hocki']) && $_GET['hocki'] != '') {
    $detaiList = $topic->getTopicBySemesterAndGV($_GET['hocki'], $_SESSION['ma_nguoidung']);
} else {
    $detaiList = $topic->getTopicByGV($_SESSION['ma_nguoidung']);
}

?>

<div class="content">
    <h5 class="text-center text-primary p-3 font-weight-bold">ĐỀ TÀI KHÓA LUẬN</h5>
    <form action="" method="get" class=" mr-3">
        <input type="hidden" name="page" value="danhsachdk">
        <div class="form-group" style="width: 33%; float: right;">
            <label for="" class="form-control-label font-weight-bold" id="lablehocki">HỌC KÌ</label>
            <div class="form-group d-flex ">
                <select class="form-control" name="hocki" id="idhocki">

                    <option value="" <?php echo isset($_GET['hocki']) ? '' : 'selected' ?>>Tất cả học kì</option>
                    <?php
                    $select = '';

                    foreach ($listSemester as $key => $value) {
                        if (isset($_GET['hocki']) && $_GET['hocki'] == $value['ma_hk']) {
                            $select = "selected";
                        } else {
                            $select = "";
                        }
                        echo '<option value="' . $value['ma_hk'] . ' " ' . $select . '>' . $value['tenhocki'] . '</option>';
                    }
                    ?>

                </select>
                <button class="btn btn-primary ml-1" type="submit">Chọn</button>

            </div>

        </div>

    </form>
    <div class=" p-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col" style="width: 10%">MÃ ĐỀ TÀI</th>
                    <th scope="col" style="width: 10%">TÊN ĐỀ TÀI</th>
                    <th scope="col" style="width: 5%">LOẠI</th>
                    <th scope="col" style="width: 20%">MÔ TẢ</th>
                    <th scope="col" style="width: 20%">YÊU CẦU</th>
                    <th scope="col" style="width: 10%">KIẾN THỨC & KỸ NĂNG</th>


                    <th scope="col" style="width: 5%">CHỨC NĂNG</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($detaiList->rowCount() == 0) {
                    echo '<tr><td colspan="8" class="text-center">Không có đề tài trong kì học</td></tr>';
                } else {
                    while ($row = $detaiList->fetch(PDO::FETCH_ASSOC)) {

                        echo '
                            <tr>
                                <th class="text-center" scope="row">' . $row['ma_detai'] . '</th>
                                <td class="text-center" style="width: 5%">' . $row['tendetai'] . '</td>
                                <td class="text-center" style="width: 15%">' . $row['tenloai'] . '</td>
                                <td style="width: 10%">
                                ' . $row['mota'] . '
                                </td>
                                <td style="width: 15%">
                                ' . $row['yeucau'] . '
                                </td>
                                <td class="text-center" style="width: 10%">' . $row['kienthuc'] . '</td>
                              
                                <td style="width: 10%">
                            
                                <button type="button" class="btn_getsv mt-3   btn btn-outline-primary btn-sm" href="" 
                                id=" ' . $row['ma_detai'] . '"onclick="getDataStudentSignUp(' . $row['ma_detai'] . ');"
                                >
                                    <i class="fas fa-list"></i>
                                    Danh sách
        
                                </button>
                            </td>
                            </tr>
                            ';
                    }
                }


                ?>

            </tbody>
        </table>
    </div>


</div>

<div class="content mt-3">
    <h5 class="text-center text-primary p-3 font-weight-bold">DANH SÁCH SINH VIÊN ĐĂNG KÝ ĐỀ TÀI</h5>
    <div class=" p-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col" style="width: 5%">STT</th>
                    <th scope="col" style="width: 10%">MÃ SINH VIÊN</th>
                    <th scope="col" style="width: 10%">HỌ TÊN</th>
                    <th scope="col" style="width: 10%">SỐ ĐIỆN THOẠI</th>
                    <th scope="col" style="width: 10%">EMAIL</th>
                    <th scope="col" style="width: 5%">NHÓM</th>
                    <th scope="col" style="width: 5%">LIÊN HỆ</th>
                </tr>
            </thead>
            <tbody id="dataStudentSignUp">


            </tbody>
        </table>

    </div>
</div>
<div class="pagination mt-3">
    <a href="#">&laquo;</a>
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">6</a>
    <a href="#">&raquo;</a>
</div>