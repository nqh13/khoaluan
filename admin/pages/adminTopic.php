<?php
require_once('../classes/topic.php');
require_once('../classes/semester.php');
$semster = new  Semester();
$topic = new Topic();
// Phân trang.
$pre_page = 4;
if (isset($_GET['trang'])) {
    $trang  = $_GET['trang'];
} else {
    $trang = 1;
}

if ($trang == "" || $trang == 1) {
    $star = 0;
} else {
    $star = ($trang * $pre_page) - $pre_page;
}
$getTopic = $topic->getAllTopic()->fetchAll(PDO::FETCH_ASSOC);
$total_record = count($getTopic);
$maxpage = ceil($total_record / $pre_page);
//

$listSemester = $semster->getAllSemesters()->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_GET['hocki'])  || $_GET['hocki'] == "") {
    $listTopic = $topic->getTopicForAdmin($star, $pre_page)->fetchAll(PDO::FETCH_ASSOC);
    
}else{
    $count = $topic->countTopicForAdminBySemester($_GET['hocki'])->fetch(PDO::FETCH_ASSOC);
    
    $maxpage = ceil($count['total'] / $pre_page);
    $listTopic = $topic->getTopicForAdminBySemester($_GET['hocki'], $star, $pre_page)->fetchAll(PDO::FETCH_ASSOC);
}




?>

<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-header-text">QUẢN LÝ ĐỀ TÀI</h5>

            <!-- <p>Basic example <code>without any additional modification</code> classes</p> -->

            <div class="form-group row">
                <div class="col-md-3"><label class="sr-only"></label></div>
                <div class="col-md-5 ">
                    <form action="" method="post" class="" style="margin-top: 12px ;" id = "formSearchTopic">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <div class="dropdown">
                                    <div type="button" class="btn btn-info addon-btn shadow-none waves-effect waves-light dropdown-toggle addon-btn" id="dropdownMenuButton" data-toggle="dropdown" data-search="madetai" aria-haspopup="true" aria-expanded="false">
                                        Mã đề tài
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <div class="dropdown-item" data-search="tendetai" data-value="Tên đề tài">Tên đề tài</div>
                                        <div class="dropdown-item" data-search="magiangvien" data-value="Mã Giảng viên">Mã Giảng viên</div>
                                        <div class="dropdown-item" data-search="khoa" data-value="Tên khoa">Tên khoa</div>
                                        <div class="dropdown-item" data-search="nganh" data-value="Ngành">Ngành</div>
                                    </div>
                                </div>
                            </div>
                            <input id="keyword" type="text" class="form-control" name="" placeholder="Nhập từ khóa" aria-describedby="btn-addon2">
                            <span class="input-group-btn" id="btn-addon2">
                                <button type="submit" class="btn btn-info shadow-none addon-btn waves-effect waves-light" id="searchBtn" onclick="searchTopic()">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    <form action="" method="Get">
                        <div class="form-group row d-flex">
                            <span class="col-sm-1  col-form-label ">
                                Học kì:</span>
                            <div class="col-sm-8">
                                <input type="hidden" name="pages" value="quanlydetai">

                                <select class="form-control " id="hocki" name="hocki">
                                    <option value="">All</option>
                                    <?php
                                    foreach ($listSemester as $key => $value) {
                                        $selected = ($value['ma_hk'] == $_GET['hocki']) ? 'selected' : '';

                                        echo '<option value="' . $value['ma_hk'] . '" ' . $selected . ' >' . $value['tenhocki'] . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>
                            <button type="submit" class="btn btn-info col-sm-2" name="" style="width: 45px; height: 38px;"><i class="fa-solid fa-filter"></i></button>

                        </div>
                    </form>
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
                                <th class="text-center">Mã đề tài</th>
                                <th class="text-center">Tên đề tài</th>
                                <th class="text-center">Giảng viên</th>
                                <th class="text-center">Khoa</th>
                                <th class="text-center">Ngành</th>
                                <th class="text-center">Loại</th>
                                <th class="text-center">Học kì</th>
                                <th class="text-center">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php
                            
                            foreach ($listTopic as $key => $value) {
                                echo '
                                    <tr class="">
                                        <td class="text-center">' . ($key + 1) . '</td>
                                        <td class="text-center">' . $value['ma_detai'] . '</td>
                                        <td class="text-center">' . $value['tendetai'] . '</td>
                                        <td class="text-center">' . $value['hoten'] . '</td>
                                        <td class="text-center">' . $value['ten_khoavien'] . '</td>
                                        <td class="text-center">' . $value['ten_nganh'] . '</td>
                                        <td class="text-center">' . $value['tenloai'] . '</td>
                                        <td class="text-center">' . $value['tenhocki'] . '</td>
                                        <td class="text-center"> 
                                            <a href="?pages=chitietdetaic&ma_detai=' . $value['ma_detai'] . '" class="btn btn-info btn-sm"><i class="fa-solid fa-list" title="Xem chi tiết"></i></a>
                                        </td>
                                    </tr>
                                    
                                    ';
                            }

                            ?>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="pagination d-flex justify-content-center align-items-center">
            <a href="<?php echo '?pages=quanlydetai&trang=' . $trang - 1 ?>">&laquo;</a>
            <?php for ($i = 1; $i <= $maxpage; $i++) {
                echo '<a' . ($i == $trang ? ' class="active"' : '') . ' href="?pages=quanlydetai&trang=' . $i . '">' . $i . '</a>';
            } ?>

            <a href="<?php echo '?pages=quanlydetai&trang=' . $trang + 1 ?>">&raquo;</a>
        </div>
        </div>

       

    </div>


</div>
<script>

    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', event => {
            const value = event.target.getAttribute('data-value');
            const search = event.target.getAttribute('data-search');
            document.getElementById('dropdownMenuButton').innerText = value;
            document.getElementById('dropdownMenuButton').setAttribute('data-search', search);
        });
    });
</script>