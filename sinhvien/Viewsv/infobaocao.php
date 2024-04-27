<style>
    .activityiconcontainer.assessment {
        background-color: #007BFF;
    }

    .activityiconcontainer {
        width: 50px;
        height: 50px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 4px;
        padding: 0.7rem;
    }

    .page-context-header {
        overflow: hidden;
        padding: 0.25rem 0;
        display: flex;
    }

    .generaltable {
        width: 100%;
        margin-bottom: 1rem;
        color: #1d2125;
    }
</style>

<?php
require_once(__DIR__ . './../../classes/report.php');
$report = new Report();

if (isset($_GET['idbaocao'])) {
    $encoded_id_received = $_GET['idbaocao'];
    $id_received = base64_decode($encoded_id_received);

    $reportItem = $report->getReportById($id_received)->fetch(PDO::FETCH_ASSOC);

    $timestampStart = strtotime($reportItem['ngaytao']);
    $startDate = date("l, j F Y, g:i A", $timestampStart);

    // format hạn nộp:
    $timestampEnd = strtotime($reportItem['ngayhethan']);
    $endDate = date("l, j F Y, g:i A", $timestampEnd);


    //Lấy ra thông tin nộp bài:

    $detailRepot = $report->getDetailReportById($_SESSION['ma_nguoidung'], $id_received);
    $result = $detailRepot->fetch(PDO::FETCH_ASSOC);

    //Check thời gian nộp báo cáo:

    if ($result) {
        // Tính thời gian còn lại (dùng abs() để đảm bảo kết quả là số dương)
        $time_remaining = $timestampEnd - strtotime($result['thoigiannop']);

        // Chuyển đổi thời gian còn lại thành dạng phút và giây
        $days_remaining = floor($time_remaining / (60 * 60 * 24));
        $hours_remaining = floor(($time_remaining % (60 * 60 * 24)) / (60 * 60));
        $minutes_remaining = floor(($time_remaining % (60 * 60)) / 60);
        $seconds_remaining = $time_remaining % 60;
    }
}






?>
<div class="content p-3 mt-3">
    <header id="page-header" class="header-maxwidth d-print-none">
        <div class="w-100">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <div class="page-context-header">
                        <div class="page-header-image mr-2">
                            <div class="assessment activityiconcontainer modicon_assign">
                                <i class="fa-solid fa-file fa-lg" style="color: white;"></i>
                            </div>
                        </div>
                        <div class="page-header-headings">
                            <div class="text-muted text-uppercase small line-height-3">KHÓA LUẬN 2023 - 2024</div>
                            <h3 class="text-uppercase"><?php echo  strtoupper($reportItem['tieude']) ?> </h3>
                        </div>
                    </div>
                </div>
                <div class=" header-actions-container ml-auto" data-region="header-actions-container">
                </div>
            </div>
        </div>
    </header>
    <div id="page-content" class="pb-3 d-print-block">
        <div id="region-main-box">
            <section id="region-main" aria-label="Nội dung">

                <span class="notifications" id="user-notifications"></span>
                <span id="maincontent"></span>
                <div class="activity-header" data-for="page-activity-header">
                    <span class="sr-only">Các yêu cầu hoàn thành</span>
                    <div data-region="activity-information" data-activityname="NOP BAI TAP CA NHAN NGAY 1/3/24" class="activity-information">


                        <div data-region="activity-dates" class="activity-dates">
                            <div class="description-inner">
                                <div>
                                    <strong>Ngày tạo: </strong> <?php echo $startDate ?>
                                </div>
                                <div>
                                    <strong>Hạn nộp: </strong> <?php echo $endDate ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="activity-description" id="intro">
                        <div class="box py-3 generalbox boxaligncenter"></div>
                    </div>
                </div>
                <div role="main">

                    <div class="submissionstatustable">
                        <h3>Trạng thái bài nộp</h3>
                        <div class="box py-3 boxaligncenter submissionsummarytable">
                            <div class="table-responsive">
                                <table class="table table-bordered ">
                                    <tbody>
                                        <tr class="">
                                            <th class="cell c0" scope="row">Trạng thái bài nộp</th>
                                            <td class="font-weight-bold">
                                                <?php if ($result) {
                                                    $count = $detailRepot->rowCount();
                                                    if ($count > 0) {
                                                        echo "Đã nộp báo cáo";
                                                    } else {
                                                        echo "Chưa nộp báo cáo";
                                                    }
                                                } else {
                                                    echo " Chưa nộp báo cáo";
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <tr class="">
                                            <th class="cell c0" scope="row">Thời gian còn lại</th>
                                            <td class="">
                                                <?php
                                                if ($result) {
                                                    echo $status = $time_remaining > 0 ? "Nộp Sớm: " : "Nộp trễ: ";
                                                    echo $days_remaining . " ngày " . $hours_remaining . " giờ " . $minutes_remaining . " phút " . $seconds_remaining . " giây";
                                                } else {
                                                    $now = date('Y-m-d H:i:s');
                                                    $timestamp = strtotime($now);

                                                    $time_remaining = $timestampEnd - $timestamp;

                                                    // Chuyển đổi thời gian còn lại thành dạng phút và giây
                                                    $days_remaining = floor($time_remaining / (60 * 60 * 24));

                                                    $hours_remaining = floor(($time_remaining % (60 * 60 * 24)) / (60 * 60));

                                                    $minutes_remaining = floor(($time_remaining % (60 * 60)) / 60);

                                                    $seconds_remaining = $time_remaining % 60;

                                                    echo $days_remaining . " ngày " . $hours_remaining . " giờ " . $minutes_remaining . " phút " . $seconds_remaining . " giây";
                                                }


                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <th class="cell c0" scope="row">Chỉnh sửa lần cuối</th>
                                            <td class="cell c1 lastcol">
                                                <?php
                                                if ($result) {
                                                    if ($result['thoigiancapnhat'] === NULL) {
                                                        echo '-';
                                                    } else {
                                                        $timestampUpdate = strtotime($result['thoigiancapnhat']);
                                                        if ($timestampUpdate !== false) {
                                                            $update = date("l, j F Y, g:i A", $timestampUpdate);
                                                            echo $update;
                                                        } else {
                                                            echo "Không có dữ liệu chỉnh sửa cuối cùng";
                                                        }
                                                    }
                                                }

                                                ?>

                                            </td>
                                        </tr>
                                        <tr class="">
                                            <th class="cell c0" scope="row">Nộp tập tin</th>
                                            <td class="cell c1 lastcol">
                                                <div class="box py-3">
                                                    <div id="">
                                                        <ul>
                                                            <li style="list-style: none;">
                                                                <div>
                                                                    <div class=""><img class="icon" alt="" title="" src="" />
                                                                        <a target="_blank" href="">
                                                                            <?php
                                                                            if ($result) {
                                                                                echo $result['tenFile'];
                                                                            } ?>

                                                                        </a>
                                                                    </div>

                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mb-4 d-flex justify-content-center">
                        <div class="row ">
                            <?php
                            if ($result) {
                                echo '
                                    <div class="col-xs-6 mr-3">
                                        <div class="">
                                            <form method="get" action="?page=thembai">
                                                <input type="hidden" name="id" value="">
                                                <input type="hidden" name="action" value="">
                                                <button type="submit" class="btn btn-warning" id="">Sửa bài nộp</button>
                                            </form>
                                        </div>
                                    </div>          
                                    ';
                            } else {
                                echo '
                                    <div class="col-xs-6">
                                        <div class="ml-3">
        
                                            <a href="?page=thembai&idbaocao= ' . $id_received . ' " class="btn btn-success">Thêm bài nộp</a>
        
                                        </div>
                                    </div>
                                   
                                    ';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>