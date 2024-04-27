<style>
.form-file {
    padding-bottom: 10px;
}

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

.container {
    height: 100vh;
    width: 100%;
    align-items: center;
    display: flex;
    justify-content: center;
    background-color: #fcfcfc;
}

.card {
    border-radius: 10px;
    box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.3);
    width: auto;
    height: 260px;
    background-color: #ffffff;
    padding: 10px 30px 40px;
}

.card h3 {
    font-size: 22px;
    font-weight: 600;

}

.drop_box {
    margin: 10px 0;
    padding: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    border: 3px dotted #a3a3a3;
    border-radius: 5px;
    min-height: 150px;
}

.drop_box h4 {
    font-size: 16px;
    font-weight: 400;
    color: #2e2e2e;
}

.drop_box p {
    margin-top: 10px;
    margin-bottom: 20px;
    font-size: 12px;
    color: #a3a3a3;
}

.btn {
    text-decoration: none;
    background-color: #005af0;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    outline: none;
    transition: 0.3s;
}

.btn:hover {
    text-decoration: none;
    background-color: #ffffff;
    color: #005af0;
    padding: 10px 20px;
    border: none;
    outline: 1px solid #010101;
}

.form input {
    margin: 10px 0;
    width: 100%;
    background-color: #e2e2e2;
    border: none;
    outline: none;
    padding: 12px 20px;
    border-radius: 4px;
}
</style>

<?php

require_once(__DIR__ . './../../classes/signUpTopic.php');
require_once(__DIR__ . './../../classes/report.php');

$sign  = new SignUptopic();
$report = new Report();

if (isset($_GET['idbaocao'])) {
    $idbaocao = $_GET['idbaocao'];
    $info = $sign->getTopicSignUp($_SESSION['ma_nguoidung']);
    $dataInfo = $info->fetch(PDO::FETCH_ASSOC);

    // echo $dataInfo['nhom'];

    $reportItem = $report->getReportById($idbaocao)->fetch(PDO::FETCH_ASSOC);

    $timestampStart = strtotime($reportItem['ngaytao']);
    $startDate = date("l, j F Y, g:i A", $timestampStart);

    // format hạn nộp:
    $timestampEnd = strtotime($reportItem['ngayhethan']);
    $endDate = date("l, j F Y, g:i A", $timestampEnd);
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
                            <h1 class="h2"><?php echo $reportItem['tieude'] ?> </h1>
                        </div>
                    </div>
                </div>
                <div class="header-actions-container ml-auto" data-region="header-actions-container">
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

                    <div data-region="activity-information" data-activityname="NOP BAI TAP CA NHAN NGAY 1/3/24"
                        class="activity-information">


                        <div data-region="activity-dates" class="activity-dates">
                            <div class="description-inner">
                                <div>
                                    <strong>Opened:</strong> <?php echo $startDate ?>
                                </div>
                                <div>
                                    <strong>Due:</strong> <?php echo $endDate ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="activity-description" id="intro">
                        <div class="box py-3 generalbox boxaligncenter"></div>
                    </div>
                </div>
                <div role="main">

                    <!-- <div class="">
                        <h3>THÊM BÀI NỘP</h3>
                        <div class="box py-3 boxaligncenter submissionsummarytable">
                            <div class="">
                                <label for="formFile" class="form-label">Chọn tệp bài nộp</label>
                                <input class="form-control " type="file" id="formFile">
                                <br>
                            </div>

                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-12">
                            <!-- <div class="col-xs-6 mr-3">
                                <div class="">
                                    <form method="get" action="">

                                        <button type="submit" class="btn btn-success" id="">Nộp báo cáo</button>
                                    </form>
                                </div>
                            </div> -->
                            <form class="" id="form-nopbai" action="../handle/UserHandle.php" method="post"
                                enctype="multipart/form-data">
                                <div class="card">
                                    <h3>THÊM BÀI NỘP</h3>
                                    <div class=" position-relative drop_box  ">

                                        <header class="parent">
                                            <h4>Select File here</h4>
                                        </header>
                                        <p class="parent">Files Supported: PDF, TEXT, DOC , DOCX</p>
                                        <input type="hidden" name="ma_baocao" id="mabaocao"
                                            value="<?php echo $idbaocao ?>">
                                        <input type="hidden" name="nhom" value="<?php echo $dataInfo['nhom'] ?>">
                                        <input type="hidden" name="ma_nguoidung"
                                            value="<?php echo $_SESSION['ma_nguoidung'] ?>">

                                        <input type="hidden" name="action" id="" value="addDetailReport">

                                        <input type="file" hidden accept=".doc,.docx,.pdf" class="" id="fileID"
                                            style="display:none;">

                                        <label for="fileID" class="form-label btn parent">
                                            Choose File
                                        </label>
                                        <div class="p-5  position-absolute w-100 h-100 d-none align-items-center justify-content-center left-0 top-0"
                                            id="drop_box1">
                                        </div>

                                    </div>
                                </div>

                            </form>



                        </div>
                    </div>

                </div>



            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
const dropArea = document.querySelector("#drop_box");
document.getElementById("fileID").addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;

    let filedata = `
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <a href="${URL.createObjectURL(e.target.files[0])}" target="_blank" class="d-block">${fileName}</a>
                        <button class="btn btn-success border " name="nopbaocao"
                                            type="button" id="btnSubmit" onclick="uploadFile()">Thêm
                                            bài nộp</button>
                    </div>
                `;
    if (fileName) {
        // document.getElementById("btnSubmit").classList.remove("d-none");
        document.getElementById("drop_box1").classList.remove("d-none");
        console.log(document.querySelectorAll('.parent'));
        document.querySelectorAll('.parent').forEach((value) => {
            value.hidden = true
        })
    } else {
        // document.getElementById("btnSubmit").classList.add("d-none");
        document.getElementById("drop_box1").classList.add("d-none");
        document.querySelectorAll('.parent').forEach((value) => {
            value.hidden = false;
        })

    }
    document.getElementById("drop_box1").innerHTML = filedata;

})


//
function uploadFile() {
    alert("Please enter");
    var idbaocao = document.getElementById("mabaocao").value;
    const formData = new FormData($("#form-nopbai")[0]);
    // Thêm file vào FormData
    const file = $("#fileID")[0].files[0];
    console.log(file);
    formData.append("file", file);

    // Sử dụng Ajax của jQuery để gửi dữ liệu
    $.ajax({
        url: "./handle/UserHandle.php",
        type: "POST",
        data: formData,
        processData: false, // Không xử lý dữ liệu trước khi gửi
        contentType: false, // Không đặt lại header "Content-Type"
        success: function(response) {
            // Xử lý phản hồi từ máy chủ
            alert(response);
            window.location.href = "index.php?page=nopbaocao&idbaocao=" + idbaocao;
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi
            console.error("Upload failed with status", xhr.status);
        },
    });
}
</script>