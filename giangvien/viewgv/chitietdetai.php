<?php

require_once('../classes/topic.php');
require_once('../classes/report.php');
$topic = new Topic();
$report = new Report();
$id = $_GET['id'];
$detai = $topic->getTopicById($id);
$curentDate = date('Y-m-d\TH:i');




?>

<div class="content">

    <div class="main">

        <h5 class="text-center text-primary p-3 font-weight-bold">CHI TIẾT ĐỀ TÀI </h5>
        <div class=" p-3">
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
                        <th scope="col" style="width: 10%">SỐ LƯỢNG SINH VIÊN</th>
                        <th scope="col" style="width: 5%">TRẠNG THÁI</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;


                    while ($row = $detai->fetch(PDO::FETCH_ASSOC)) {

                        echo '
                    <tr class="">
                        <td scope="col" class="text-center" style="width: 5%">' . $stt++ . '</td>
                        <td scope="col" class="text-center" style="width: 5%">' . $row['ma_detai'] . '</td>
                        <td scope="col" style="width: 10%">' . $row['tendetai'] . '</td>
                        <td scope="col" style="width: 5%">' . $row['tenloai'] . '</td>
                        <td scope="col" style="width: 20%">' . $row['mota'] . '</td>
                        <td scope="col" style="width: 20%">' . $row['yeucau'] . '</td>
                        <td scope="col" style="width: 10%">' . $row['kienthuc'] . '</td>
                        <td scope="col" class="text-center" style="width: 10%">' . $row['soluong_SV'] . '</td>
                        <td scope="col" style="width: 5%">TRẠNG THÁI</td>
                       
                     </tr>
                    
                    
                    
                    ';
                    }



                    ?>


                </tbody>
            </table>
        </div>

    </div>



    <div class="contentbaocao border-top p-2">
        <div class=" p-1 d-flex flex-row">
            <h5 class="text-left text-primary p-3 font-weight-bold">BÁO CÁO </h5>
            <button class="btn btn-primary align-self-center ml-auto" data-toggle="modal" data-target="#ModalBaoCao" data-whatever="@mdo">Tạo báo cáo</button>
        </div>

        <div id="" class="m-0 p-0">
            <ul class="section m-0 p-3 d-block " style="list-style: none" data-for="cmlist">
                <?php
                $items = $report->getReportByIdTopic($id)->fetchAll(PDO::FETCH_ASSOC);

                foreach ($items as $item) {;
                    $timestamp = strtotime($item['ngayhethan']);
                    $formatDate = date("d-m-Y H:i A", $timestamp);
                    echo '
                    <li class="itemBaoCao p-3 mt-2" id="" style="width:80%;">
                        <div class="activity-basis d-flex ">
                            <div class="d-flex flex-column flex-md-row w-100 align-self-start">
                                <div class=" d-flex flex-column">
                                    <div class=" media  modtype_assign position-relative align-self-start">
                                        <div class="activityiconcontainer assessment align-self-start mr-3">
                                            <a href="?page=ctbaocao&id=' . $item['ma_baocao'] . '">
                                                <i class="fa-solid fa-file-arrow-up"
                                                    style="color: #ffffff; font-size: 25px"></i>
                                            </a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <a href="?page=ctbaocao&id=' . $item['ma_baocao'] . '" class="" onclick=""> <span class="text-uppercase font-weight-bold">
                                                ' . strtoupper($item['tieude']) . '
                                            </span> </a>
                                            <div class="d-flex  align-self-start ml-auto">
                                                <span class="text-muted font-italic">Đến hạn: ' . $formatDate . '</span>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="d-flex  align-self-start ml-auto">

                                    <a class="btn btn-primary" title="Chỉnh sửa" href="?page=updatebaocao&idbaocao=' . $item['ma_baocao'] . '" ><i class="fa-solid fa-pen-to-square"></i> </a>

                                </div>
                               
                            </div>
                        </div>
                    </li> 
                
                ';
                }

                ?>
            </ul>
        </div>
    </div>



</div>


<div class="modal fade" id="ModalBaoCao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TẠO BÁO CÁO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="idbaocao">
                    <input type="hidden" name="_token" id="csrf" value="<?php echo $tokenUser ?>">
                    <div class="form-group">
                        <label for="Title" class="col-form-label font-weight-bold">Tiêu đề báo cáo:</label>
                        <input type="text" class="form-control" id="tieudebaocao" value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label font-weight-bold">Ngày tạo:</label>
                        <input type="datetime-local" class="form-control" id="ngaytao" min="<?php echo $curentDate; ?>" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label font-weight-bold">Ngày hết hạn:</label>
                        <input class="form-control" type="datetime-local" value="" min="<?php echo $curentDate; ?>" id="ngayhethan">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Ghi chú:</label>
                        <textarea class="form-control" id="ghichubaocao"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="btnTaoBaoCao" onclick="createReport(<?php echo $id ?>)">Lưu
                </button>
            </div>
        </div>
    </div>
</div>