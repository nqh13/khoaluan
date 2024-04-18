<?php
require_once './../classes/comment.php';
$comment = new comment();
$data = $comment->getDiscussionById($_GET['id']);
// var_dump($data);


?>

<div class="content-component container-fluid p-3">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 post-main p-3 ">
            <div class="post-content">
                <article class="post-content">
                    <header class="mb-05 border-bottom pb-2">

                        <h3 class="article-content__title">
                            <a href="?page=chitietthaoluan"><?php echo $data['tieude'] ?></a>
                        </h3>
                        <div title="" class="text-muted">
                            Đã đăng vào thg <?php echo $data['ngaytao'] ?>
                        </div>

                    </header>



                    <div class=" my-2 flex-fill">
                        <div class="md-contents" style="font-size: 18px; line-height: 1.75;">
                            <!-- <p>

                                SQL injection là một kỹ thuật tấn công thường gặp trong việc xâm nhập vào hệ thống thông
                                qua các lỗ hổng trong việc xử lý các câu lệnh SQL. Dưới đây là một số biện pháp khắc
                                phục để
                                ngăn chặn SQL injection:

                            </p>
                            <p>
                                Sử dụng Prepared Statements và Parameterized Queries: Thay vì tạo câu truy vấn SQL bằng
                                cách nối chuỗi, hãy sử dụng prepared statements và parameterized queries. Điều này giúp
                                tránh
                                được việc truyền dữ liệu người dùng trực tiếp vào câu lệnh SQL.
                            </p> -->
                            <p>
                                <?php echo $data['noidung'] ?>
                            </p>
                        </div>
                    </div>
                </article>
            </div>



        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card d-flex justify-content-center align-items-center p-2 ">
                <div class=" d-flex flex-row p-1">
                    <img class="img-fluid" src="./../Uploads/avt.jpg" style="height: 80px; width:80px; border-radius: 50%" alt="user-header">
                    <div class="mt-3 ml-2">
                        <h6>NGUYỄN QUANG HÀ</h6>
                        <h6 class="text-center">19508461</h6>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="row">
        <div class="post-comments  mt-3 col-12 ">
            <h3 class="mb-2"><strong>Bình luận</strong></h3>
            <div class="comment-threads">
                <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                    <div class="d-flex flex-start w-100">
                        <img class="rounded-circle shadow-1-strong me-3 mr-3" src="./../Uploads/avt.jpg" alt="avatar" width="50" height="50" />
                        <div class="form-outline w-100">
                            <textarea class="form-control" id="textAreaContent" rows="4" style="background: #fff;"></textarea>
                            <label class="form-label" for="textAreaExample">Message</label>
                        </div>
                    </div>
                    <div class=" mt-2 pt-1 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary  m-1" id="btn_comment" data-ma_cuocthaoluan="<?php echo $data['ma_cuocthaoluan'] ?>" data-ma_nguoidung="<?php echo $_SESSION['ma_nguoidung'] ?>">
                            Bình luận
                        </button>
                        <!-- <button type="button" class="btn btn-outline-primary btn-sm m-1">
                            Cancel
                        </button> -->
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8 ">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4 pb-2">Danh sách bình luận</h4>

                            <div class="row">
                                <div class="col" id="comments">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>