<?php
require_once './../classes/comment.php';
$comment = new comment();
$data = $comment->getDiscussionById($_GET['id']);

$checkDiscussion = $comment->checkDiscussion($_GET['id'], $_SESSION['ma_nguoidung']);




?>

<div class="content-component container-fluid p-3">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 post-main p-3 ">
            <div class="post-content">

                <article class="post-content ">

                    <header class="mb-05 border-bottom pb-2">

                        <h3 class="article-content__title">
                            <a href=""><?php echo $data['tieude'] ?></a>
                        </h3>
                        <div title="" class="text-muted">
                            <p>Đã đăng vào thg <?php echo $data['ngaytao'] ?></p>
                        </div>
                        <div title="" class="text-muted">
                            <i>Đăng bời: <b><?php echo $data['hoten'] ?></b></i>

                            <?php
                            if ($checkDiscussion == true) {
                                echo '
                                    <button class="btn btn-sm btn-primary ml-2" title="Cập nhật"
                                    style="height: 30px; width: 35px" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa-solid fa-pen-to-square"  style="font-size: 13px;"></i>
                                </button>
                                    
                                    
                                    ';
                            }
                            ?>

                        </div>

                    </header>
                    <div class=" my-2 flex-fill">
                        <div class="md-contents" style="font-size: 18px; line-height: 1.75;">
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

                    <img class="img-fluid mt-2" src="https://ui-avatars.com/api/?name=<?php echo $data['hoten'] ?>&background=random" style="height: 50px; width:50px; border-radius: 50%" alt="user-header">
                    <div class="mt-3 ml-2">
                        <h6 class="text-uppercase"><?php echo strtoupper($data['hoten']); ?></h6>
                        <h6 class="text-center"><?php echo $data['ma_nguoidung']; ?></h6>
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
                        <img class="rounded-circle shadow-1-strong me-3 mr-3" src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['hoten'] ?>&background=random" alt="avatar" width="30px" height="30px" alt=" avatar" width="50" height="50" />
                        <form class="form-outline w-100">
                            <textarea class="form-control" id="textAreaContent" rows="4" style="background: #fff;" placeholder="Nhập nội dung bình luận..."></textarea>
                            <label class="form-label" for="textAreaExample"></label>
                        </form>
                    </div>
                    <div class=" mt-2 pt-1 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary  m-1" id="btn_comment" data-ma_cuocthaoluan="<?php echo $data['ma_cuocthaoluan'] ?>" data-ma_nguoidung="<?php echo $_SESSION['ma_nguoidung'] ?>" data-hoten="<?php echo $_SESSION['hoten'] ?>">
                            Bình luận
                        </button>
                        <!-- <button type="button" class="btn btn-outline-primary btn-sm m-1">
                            Cancel
                        </button> -->
                    </div>
                    <div class="card mt-3">
                        <div class="card-body p-2">
                            <h4 class="text-center text-primary p-2">Danh sách bình luận</h4>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Cập nhật nội dung:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser ?>">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label font-weight-bold">Tiêu đề:</label>
                        <input type="text" class="form-control" value="<?php echo $data['tieude'] ?>" id="titleUpdate">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label font-weight-bold">Nội dung:</label>
                        <textarea class="form-control" id="contentUpdate"><?php echo $data['noidung'] ?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="updateDiscussion(<?php echo $data['ma_cuocthaoluan'] ?>)">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->