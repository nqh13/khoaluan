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
                <div class="d-flex  align-self-start ml-2">

                    <a class="btn btn-danger text-white" title="Xóa" onclick="deleteReport(<?php echo $id ?>)"><i class="fa-solid fa-cancel"></i> Xóa</a>

                </div>


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