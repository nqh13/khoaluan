<?php
require_once(__DIR__ . './../../classes/signUpTopic.php');
require_once(__DIR__ . './../../classes/report.php');
$sign  = new SignUptopic();
$report = new Report();
$result = $sign->getTopicSignUp($_SESSION['ma_nguoidung'])->fetchAll(PDO::FETCH_ASSOC);
$ma_nguoidung = $_SESSION['ma_nguoidung'];


$ma_detai = $result[0]['ma_detai'];



?>
<div class="content">

    <div class="tbl-signUp">
        <h5 class="text-center text-primary p-3">ĐỀ TÀI KHÓA LUẬN ĐÃ ĐĂNG KÝ</h5>
        <div class="p-2">
            <table class="table table-bordered ">
                <thead>
                    <tr class="text-center">
                        <th style="width: 1%">STT</th>
                        <th style="width: 10%">TÊN ĐỀ TÀI</th>
                        <th style="width: 5%">LOẠI</th>
                        <th style="width: 20%">MÔ TẢ</th>
                        <th style="width: 20%">YÊU CẦU</th>
                        <th style="width: 10%">KIẾN THỨC & KỸ NĂNG</th>
                        <th style="width: 15%">GVHD</th>
                        <th style="width: 10%">TRẠNG THÁI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key => $value) {
                        echo '<tr>
          <th class="text-center" scope="row">' . ($key + 1) . '</th>
          <td class="text-center" style="width: 5%">' . $value['tendetai'] . '</td>
          <td class="text-center" style="width: 15%">' . $value['tenloai'] . '</td>
          <td style="width: 10%">
          ' . $value['mota'] . '
          </td>
          <td style="width: 15%">
            ' . $value['yeucau'] . '
          </td>
          <td class="text-center" style="width: 10%">' . $value['kienthuc'] . '</td>
          
          <td class="text-center" style="width: 15%">
            ' . $value['hoten'] . '
          </td>
          <td class="text-center" style="width: 10%">
            ' . $value['tentrangthai'] . '
          </td>
          <td style="width: 10%">
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"
              onclick="cancelTopic(' . $value['ma_dangky'] . ');"
            >
              <i class="fas fa-cancel"></i>
              Hủy đăng ký
            </button>
          </td>
        </tr>';
                    }
                    ?>
                    <!-- <tr>
                    <th class="text-center" scope="row">1</th>
                    <td class="text-center" style="width: 5%">ĐỀ TÀI 1</td>
                    <td class="text-center" style="width: 5%">KLTN - ĐH</td>
                    <td style="width: 10%">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut nam
                        fugiat accusamus quam beatae provident laudantium nobis, mollitia
                        sapiente in veritatis totam, hic vitae amet ipsam quia asperiores
                        minima qui.
                    </td>
                    <td style="width: 15%">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum rem
                        commodi tenetur dicta, libero quisquam ipsum quod totam amet
                        similique quasi quis excepturi delectus id alias velit debitis
                        asperiores. Quae?L
                    </td>
                    <td class="text-center" style="width: 10%">PHP, MySQL</td>
                    <td style="width: 15%">
                        Hệ thống website xử lý công việc có độ bảo mật caoL
                    </td>
                    <td class="text-center" style="width: 15%">GVHD 1</td>
                    <td style="width: 10%">

                        <i class="fas fa-lock"></i>
                        <span>Đã khóa</span>

                    </td>
                </tr> -->

                </tbody>
            </table>
        </div>
    </div>


    <div class="p-2">


        <h3 class="text-primary">NỘP BÁO CÁO</h3>
        <div id="" class=" ">


            <ul class="section m-0 p-3 d-block " style="list-style: none" data-for="cmlist">
                <?php
                $itemResport = $report->getReportByIdTopic($ma_detai)->fetchAll(PDO::FETCH_ASSOC);


                foreach ($itemResport as $key => $value) {
                    $timestampEnd = strtotime($value['ngayhethan']);
                    $formattedEndDate = date("l, j F Y, g:i A", $timestampEnd);
                    //Mã hóa id:
                    $encoded_id = base64_encode($value['ma_baocao']);
                    echo '
                    <li class="itemBaoCao p-3 mt-3" id="" style="width:80%;">
                    <div class="activity-basis d-flex ">
                        <div class="d-flex flex-column flex-md-row w-100 align-self-start">
                            <div class=" d-flex flex-column">
                                <div class=" media  modtype_assign position-relative align-self-start">
                                    <div class="activityiconcontainer assessment align-self-start mr-3">
                                        <a href="?page=nopbaocao">
                                            <i class="fa-solid fa-file-arrow-up" style="color: #ffffff; font-size: 25px"></i>
                                        </a>
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="text-uppercase small">
                                            <h6>BÁO CÁO</h6>
                                        </div>
                                        <div class="">
                                            <a href="?page=nopbaocao&idbaocao=' . urlencode($encoded_id) . '" class="" onclick=""> 
                                            <span class="text-uppercase">' . strtoupper($value['tieude']) . '</span> </a>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="d-flex  align-self-start ml-auto">
                                <span class="text-muted font-italic">Đến hạn: ' . $formattedEndDate . '</span>

                            </div>



                        </div>

                    </div>



                </li>

                    
                    
                    
                    
                    ';
                }


                ?>
                <!-- <li class="itemBaoCao p-3" id="" style="width:80%;">
                    <div class="activity-basis d-flex ">
                        <div class="d-flex flex-column flex-md-row w-100 align-self-start">
                            <div class=" d-flex flex-column">
                                <div class=" media  modtype_assign position-relative align-self-start">
                                    <div class="activityiconcontainer assessment align-self-start mr-3">
                                        <a href="?page=nopbaocao">
                                            <i class="fa-solid fa-file-arrow-up"
                                                style="color: #ffffff; font-size: 25px"></i>
                                        </a>
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="text-uppercase small">
                                            <h6>BÁO CÁO</h6>
                                        </div>
                                        <div class="">
                                            <a href="?page=nopbaocao" class="" onclick=""> <span class="">NỘP BÁO
                                                    CÁO TUẦN 1
                                                </span> </a>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="d-flex  align-self-start ml-auto">
                                <span class="text-muted font-italic">Đến hạn 23:59 30 thg 4</span>

                            </div>



                        </div>

                    </div>



                </li> -->

            </ul>

        </div>


    </div>
</div>