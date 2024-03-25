<div class="col-lg-2  col-md-2 col-sm-12 sidebar min-vh-100">
    <aside id="my-sidebar" class="p-0 retro-noselect" contextmenu="test">
        <nav class="nav navbar-expand-md">
            <div id="navbarSupportedContent" class="navbar-collapse collapse">
                <ul id="myAccordion" class="nav flex-column flex-nowrap retro-link-text w-100">

                    <li class="nav-item border-bottom">
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-house"></i> Trang chủ</a>
                    </li>
                    <li class="nav-item border-bottom">
                        <a class="nav-link accordion-toggle collapsed" data-toggle="collapse" data-target="#item-2"><i class="fas fa-university fa-fw"></i> Quản lý đề tài <i class="fa-solid fa-caret-down"></i></a>
                        <div id="item-2" class="collapse show">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link pl-5 accordion-toggle collapsed <?php echo ($active == "danhsach" ? "active" : "") ?>" href="?page=danhsach" data-parent="#item-2">
                                        Danh sách đề tài</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pl-5 accordion-toggle collapsed <?php echo ($active == "themdetai" ? "active" : "") ?>" href="?page=themdetai" data-parent="#item-2">Thêm đề tài mới</a>

                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item border-bottom">
                        <a class="nav-link accordion-toggle collapsed" data-toggle="collapse" data-target="#item-3">
                            <i class="fas fa-chart-line fa-fw"></i> Quản lý đăng ký đề tài<i class="fa-solid fa-caret-down ml-1"></i></a>
                        <div id="item-3" class="collapse show">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link pl-5 <?php echo ($active == "danhsachdk" ? "active" : "") ?>" href="?page=danhsachdk">Sinh viên đăng ký đề tài</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link pl-5" href="?page=danhgia">Đánh giá từ giảng viên </a>
                                </li> -->

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item border-bottom">
                        <a class="nav-link accordion-toggle collapsed" data-toggle="collapse" data-target="#item-4"><i class="fa-solid fa-user"></i> Tài khoản <i class="fa-solid fa-caret-down"></i></a>
                        <div id="item-4" class="collapse show">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link pl-5 <?php echo ($active == "thongtin" ? "active" : "") ?>" href="?page=thongtin">Xem thông tin</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link pl-5 <?php echo ($active == "doipass" ? "active" : "") ?>" href="?page=doipass">Đổi mật khẩu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pl-5 <?php echo ($active == "doithongtin" ? "active" : "") ?>" href="?page=doithongtin">Đổi thông tin cá nhân</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item border-bottom">
                        <a class="nav-link" href="" target="_blank">
                            <i class="fa-solid fa-newspaper"></i> Tin tức & thông báo</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
</div>