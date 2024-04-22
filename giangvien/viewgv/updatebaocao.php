<?php
require_once("../classes/report.php");
$report = new Report();

if (isset($_GET['idbaocao'])) {

    $idbaocao = $_GET['idbaocao'];
    $dataRepost = $report->getReportById($idbaocao)->fetch(PDO::FETCH_ASSOC);
}



?>


<div class="content  p-3 mt-3">
    <div class="card-block ">
        <h4 class="card-title text-center">CẬP NHẬT BÁO CÁO</h4>
        <div class="card-block">
            <form class="d-flex flex-column " id="formUpdateReport">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-control-label font-weight-bold">Tiêu đề báo cáo:</label>
                    <input type="Tiêu đề báo cáo" class="form-control" id="tieude" placeholder=""
                        value="<?php echo $dataRepost['tieude']; ?>">
                    <small id="er_tieude" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="example-datetime-local-input" class=" form-control-label font-weight-bold">Ngày
                        tạo:</label>

                    <input class="form-control" type="datetime-local" value="<?php echo $dataRepost['ngaytao']; ?> "
                        id="ngaytao">
                    <small id="er_ngaytao" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="example-datetime-local-input" class=" form-control-label font-weight-bold">Ngày hết
                        hạn:</label>
                    <input class="form-control" type="datetime-local" value="<?php echo $dataRepost['ngayhethan']; ?>"
                        id="ngayhethan">
                    <small id="er_ngayhethan" class="form-text text-muted"></small>
                </div>


                <div class="form-group">
                    <label for="exampleTextarea" class="form-control-label font-weight-bold">Ghi chú:</label>
                    <textarea class="form-control" id="ghichu" rows="4"
                        placeholder="Mời nhập ghi chú!"><?php echo $dataRepost['ghichu']; ?></textarea>
                </div>



                <button type="button" class="btn btn-primary align-self-center"
                    onclick="updateInforReport(<?php echo $idbaocao ?>)">Cập nhật</button>
            </form>
        </div>
    </div>
</div>