<?php
require_once './../classes/comment.php';

$comment = new Comment();

$comments = $comment->getAllDiscussion();

function convertTime($time)
{
    return date('H:i d/m/Y', strtotime($time));
}

?>
<div class="content-component p-3">
    <?php
    foreach ($comments as $comment) {
        echo '
        <div class="post-body__main post-content">
        <article class="post-content">
            <header class="mb-05 border-bottom pb-2">

                <h3 class="article-content__title">
                    <a href="?page=chitietthaoluan&id=' . $comment['ma_cuocthaoluan'] . '">' . $comment['tieude'] . '</a>
                </h3>
                <div title="" class="text-muted">
                    Đã đăng vào thg ' . convertTime($comment['ngaytao']) . '
                </div>
            </header>
        </article>
    </div>
        ';
    }
    ?>
    <!-- <div class="post-body__main post-content">
        <article class="post-content">
            <header class="mb-05 border-bottom pb-2">

                <h3 class="article-content__title">
                    <a href="?page=chitietthaoluan">Khắc phục lỗi SQL Injection</a>
                </h3>
                <div title="" class="text-muted">
                    Đã đăng vào thg 03 19, 2024 11:15 CH
                </div>
            </header>



        

        </article>
    </div> -->


    <!-- <div class="post-comments">
        <h3 class="mb-2"><strong>Bình luận</strong></h3>
        <div class="comment-threads">

        </div>
    </div> -->



</div>