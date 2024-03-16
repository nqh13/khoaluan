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




    /* 
    .path-mod-assign .gradingsummarytable,
    .path-mod-assign .feedbacktable,
    .path-mod-assign .lockedsubmission,
    .path-mod-assign .submissionsummarytable {
        margin-top: 1em;
    } */



    .generaltable {
        width: 100%;
        margin-bottom: 1rem;
        color: #1d2125;
    }
</style>
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
                            <h1 class="h2">NỘP BÁO CÁO KHÓA LUẬN </h1>
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
                    <span class="sr-only">Các yêu cầu hoàn thành</span>
                    <div data-region="activity-information" data-activityname="NOP BAI TAP CA NHAN NGAY 1/3/24" class="activity-information">


                        <div data-region="activity-dates" class="activity-dates">
                            <div class="description-inner">
                                <div>
                                    <strong>Opened:</strong> Friday, 1 March 2024, 12:00 AM
                                </div>
                                <div>
                                    <strong>Due:</strong> Friday, 1 March 2024, 11:30 AM
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
                                            <th class="cell c0" style="" scope="row">Trạng thái bài nộp</th>
                                            <td class="submissionstatussubmitted cell c1 lastcol" style="">Đã nộp để
                                                chấm
                                                điểm</td>
                                        </tr>
                                        <tr class="">
                                            <th class="cell c0" style="" scope="row">Trạng thái chấm điểm</th>
                                            <td class="submissionnotgraded cell c1 lastcol" style="">Chưa chấm điểm</td>
                                        </tr>
                                        <tr class="">
                                            <th class="cell c0" style="" scope="row">Thời gian còn lại</th>
                                            <td class="earlysubmission cell c1 lastcol" style="">Bài tập đã được gửi sớm
                                                1
                                                phút 6 giây</td>
                                        </tr>
                                        <tr class="">
                                            <th class="cell c0" style="" scope="row">Chỉnh sửa lần cuối</th>
                                            <td class="cell c1 lastcol" style="">Friday, 1 March 2024, 11:28 AM</td>
                                        </tr>
                                        <tr class="">
                                            <th class="cell c0" style="" scope="row">Nộp tập tin</th>
                                            <td class="cell c1 lastcol" style="">
                                                <div class="box py-3 boxaligncenter plugincontentsummary summary_assignsubmission_file_2848697">
                                                    <div id="assign_files_tree65f4efe2371ed6">
                                                        <ul>
                                                            <li yuiConfig='{"type":"html"}'>
                                                                <div>
                                                                    <div class=""><img class="icon icon" alt="19508461_NguyenQuanHa_Tuan3.rar" title="" src="#" />
                                                                        <a target="_blank" href="#">19508461_NguyenQuanHa_Tuan3.rar</a>
                                                                    </div>
                                                                    <div class="">1 March 2024,
                                                                        11:28 AM</div>
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
                            <div class="col-xs-6 mr-3">
                                <div class="">
                                    <form method="get" action="?page=thembai">
                                        <input type="hidden" name="id" value="">
                                        <input type="hidden" name="action" value="">
                                        <button type="submit" class="btn btn-warning" id="single_button65f4efe2371ed4">Sửa
                                            bài làm</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="">
                                    <form method="get" action="">
                                        <input type="hidden" name="id" value="">
                                        <input type="hidden" name="action" value="">
                                        <button type="submit" class="btn btn-danger" id="">Loại bỏ bài nộp</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="ml-3">

                                    <a href="?page=thembai" class="btn btn-success">Thêm bài nộp</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </section>
        </div>
    </div>
</div>