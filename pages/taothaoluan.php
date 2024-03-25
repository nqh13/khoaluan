<?php
require_once '../classes/comment.php';

$comment = new Comment();

if (isset($_POST['title'])) {
    $_POST['user_id'] = $_SESSION['ma_nguoidung'];
    var_dump($_POST);
    $comment->createDiscussion($_POST);
    // header('location:../pages/doithongtin.php');
}

?>
<div class="content p-3">
    <h4 class="text-center text-primary"> TẠO THẢO LUẬN MỚI</h4>
    <form action="" method="post">
        <table class="table table-striped table-bordered">
            <colgroup>
                <col class="w200">
                <col>
            </colgroup>
            <tbody>
                <tr>
                    <td><strong>Tiêu đề</strong>: <sup class="required">(∗)</sup></td>
                    <td><input type="text" maxlength="250" value="" id="idtitle" name="title" class="form-control" style="width:350px"><span class="text-middle"> Số ký tự: <span id="titlelength" class="text-danger">0</span>. Nên nhập tối đa 65 ký tự </span></td>
                </tr>
                <tr>
                    <td><strong>Mã đề tài</strong>: <sup class="required">(∗)</sup></td>
                    <td><input type="text" maxlength="250" value="13" id="idtitle" name="post_id" class="form-control" style="width:350px">
                    </td>
                </tr>
                <tr>
                    <td><strong>Nội dung: </strong></td>
                    <td> <textarea id="description" name="content" rows="5" cols="75" style="font-size:14px; width: 100%; height:100px;" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <button class="btn btn-primary" type="submit" name="submit">
                            TẠO THẢO LUẬN
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>


    </form>

</div>