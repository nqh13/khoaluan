<?php
require_once './../classes/comment.php';
require_once './../classes/signUpTopic.php';

$comment = new Comment();
$signUpTopic = new SignUpTopic();

//Get Discussion by Topic
$idTopic = $signUpTopic->getTopicSignUp($_SESSION['ma_nguoidung'])->fetch(PDO::FETCH_ASSOC)['ma_detai'];



$comments = $comment->getDiscussionByTopicId($idTopic);


// var_dump($comments);



function convertTime($time)
{
    return date('H:i d/m/Y', strtotime($time));
}

?>
<div class="content-component p-3">
    <?php
    if (empty($comments)) {
        echo '
       

                <h5 class="text-center font-weight-bold">
                   Chưa có cuộc thảo luận nào được tạo!
                </h5>
           
        
        ';
    } else {
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
                <div title="" class="text-muted">
                Đăng bởi: <i class="font-weight-bold">' . $comment['hoten'] . '</i>
            </div>
            </header>
        </article>
    </div>
        ';
        }
    }

    ?>




</div>