<?php
require_once('../classes/topic.php');
require_once('../classes/semester.php');
$semester = new Semester();
$topic = new Topic();

$topicItem = $topic->getTopicByGV($_SESSION['ma_nguoidung']);

$results = $topicItem->fetchAll(PDO::FETCH_ASSOC);



// $detaiList = $topic->getTopicByGV($_SESSION['ma_nguoidung']);

$listSemester = $semester->getAllSemesters()->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['hocki']) && $_GET['hocki'] != '') {
    $detaiList = $topic->getTopicBySemesterAndGV($_GET['hocki'], $_SESSION['ma_nguoidung']);
} else {
    $detaiList = $topic->getTopicByGV($_SESSION['ma_nguoidung']);
}

?>



<div class="content">
    <div class="row p-3">
        <div class="col-12 border-bottom">
            <h5 class="text-center text-primary font-weight-bold">CHI TIẾT KHÓA LUẬN</h5>

        </div>
        <div class="col-12 col-md-12 col-sm-12 mt-3">
            <form action="" method="get">
                <input type="hidden" name="page" value="baocao">
                <div class="form-group" style="width: 33%; float: right;">
                    <!-- <label for="" class="form-control-label font-weight-bold" id="lablehocki">HỌC KÌ</label> -->
                    <div class="form-group d-flex ">
                        <select class="form-control" name="hocki" id="idhocki">

                            <option value="" <?php echo isset($_GET['hocki']) ? '' : 'selected' ?>>Tất cả học kì
                            </option>
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

        </div>



        <?php
        if ($detaiList->rowCount() == 0) {
            $tenhk = "";
            if (isset($_GET['hocki'])) {
                foreach ($listSemester as $key => $value) {
                    if ($_GET['hocki'] == $value['ma_hk']) {
                        $tenhk = $value['tenhocki'];
                    }
                }
            }
            echo '<div class="col-12 col-md-12 col-sm-12 mt-3">
            <h5 class="text-center ml-3">Không tìm thấy đề tài cho học kỳ: ' . $tenhk . '</h5>
            </div>';
        } else {
            foreach ($results as $row) {
                echo '
            
            <div class="col-md-4 col-sm-12 "> 
            <a href="?page=chitiet&id=' . $row['ma_detai'] . '" style="text-decoration: none;">
                
                    <div class="card mt-2 " style="min-height: 200px; box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;">
                        <div class="card-body">
                            <h4 class="card-title">' . $row['tendetai'] . '</h4>
                            <p class="card-text">' . $row['mota'] . '</p>
                            <a href="?page=chitiet&id=' . $row['ma_detai'] . '" class="btn btn-primary mt-2">Chi tiết</a>
                        </div>
                    </div>
                
            </a>
            </div>
            ';
            }
        }


        ?>






    </div>



</div>