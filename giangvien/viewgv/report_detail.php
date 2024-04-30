<?php
require_once("../classes/report.php");
$report = new Report();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $report->getReportById($id)->fetch(PDO::FETCH_ASSOC);
    // format ngày tạo:
    $timestampStart = strtotime($result['ngaytao']);
    $formattedStartDate = date("l, j F Y, g:i A", $timestampStart);

    // format hạn nộp:
    $timestampEnd = strtotime($result['ngayhethan']);
    $formattedEndDate = date("l, j F Y, g:i A", $timestampEnd);


    //Lấy danh sách sinh viên nộp bài:
    $dataList = $report->getListDetailByReportID($id)->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="content p-3 mt-3">
    <div id="" class="">
        <div class="w-100">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <div class="page-context-header">
                        <div class="page-header-image mr-2">
                            <div class="assessment activityiconcontainer modicon_assign"><img class="icon activityicon" aria-hidden="true" src="https://lms.iuh.edu.vn/theme/image.php/academi/assign/1697014882/monologo" alt="" /></div>
                        </div>
                        <div class="">
                            <div class="text-muted text-uppercase small">BÁO CÁO</div>
                            <h3 class="text-uppercase"><?php echo  strtoupper($result['tieude']) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="d-flex  align-self-start ml-auto">

                    <a class="btn btn-primary" title="Chỉnh sửa" href="?page=updatebaocao&idbaocao=<?php echo $id ?>"><i class="fa-solid fa-pen-to-square"></i> Cập nhật</a>

                </div>
                <?php
                if (!$dataList) {
                    echo '
                        <div class="d-flex  align-self-start ml-2">

                            <a class="btn btn-danger text-white" title="Xóa" onclick="deleteReport(' . $id . ')"><i class="fa-solid fa-cancel"></i> Xóa</a>
    
                        </div>
                        
                        ';
                }

                ?>



            </div>
        </div>
    </div>
    <div class="pb-3 ">
        <div id="">
            <section id="region-main" aria-label="Nội dung">


                <div class="">
                    <table class="table  table-bordered" id="table-report-detail">
                        <thead class="bg-info">
                            <tr>
                                <th class="text-center" style="width: 5%">#</th>
                                <th class="text-center" style="width: 10%">Mã đề tài</th>
                                <th class="text-center" style="width: 20%">Tiêu đề</th>
                                <th class="text-center" style="width: 20%">Ngày tạo</th>
                                <th class="text-center" style="width: 20%">Hạn nộp</th>
                                <th class="text-center" style="width: 20%">Ghi chú</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            echo '
                                    <tr>
                                        <td class="text-center">' . $stt . '</td>
                                        <td class="text-center" id="madetai">' . $result['detai'] . '</td>
                                        <td class="text-center">' . $result['tieude'] . '</td>
                                        <td class="text-center">' . $formattedStartDate . '</td>
                                        <td class="text-center">' . $formattedEndDate . '</td>
                                        <td class="text-center">' . $result['ghichu'] . '</td>
                                     </tr>
                               
                                ';


                            ?>

                        </tbody>
                    </table>
                </div>




            </section>
        </div>

    </div>
</div>
<div class="content p-3 mt-3">
    <h6 class="text-primary font-weight-bold"> QUẢN LÝ BÀI NỘP</h6>

    <table class="table   table-bordered mt-3">
        <thead class="thead-light">
            <tr class="text-center">
                <th>STT</th>
                <th>Tên sinh viên</th>
                <th>Thời gian nộp</th>
                <th>File</th>
                <th>Trạng Thái</th>
                <th></th>


            </tr>
        </thead>
        <?php
        if (!$dataList) {
            echo '
                <td colspan="7" class="text-center font-weight-bold">Chưa có bài nộp nào!</td>
                ';
        } else {
            $stt = 1;
            foreach ($dataList as $key => $value) {
                $timestamp = strtotime($value['thoigiannop']);
                $formattedDate = date("d/m/Y H:i:s", $timestamp);
                echo '
                <tbody>
                        <tr class="text-center">
                            <td>' . $stt++ . '</td>
                            <td>' . $value['hoten'] . '</td>
                            <td>' . $formattedDate . '</td>
                            <td>' . $value['tenFile'] . '</td>
                            <td></td>
                            <td> <a class="btn btn-success" href ="./../file_Upload/' . $value['tenFile'] . '"  download target="_blank"><i class="fa-solid fa-download"></i></a></td>



                        </tr>
                </tbody>
            
            
            ';
            }
        }


        ?>

    </table>


</div>