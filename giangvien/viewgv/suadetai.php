<?php

require_once('../classes/typetopic.php');
require_once('../classes/topic.php');
$type = new Typetopic();
$topic  = new Topic();
$getType  = $type->getAllType();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $ketqua = $topic->getTopicById($id);
    $result = $ketqua->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Vui lòng chọn đề tài!";
}















?>

<div class="content mt-1">
    <div class="p-3 border-bottom">
        <h5 class="text-primary text-center font-weight-bold">CẬP NHẬT THÔNG TIN ĐỀ TÀI</h5>
    </div>
    <form action="" method="post" class="formdetai" id="" style="padding:10px;" enctype="multipart/form-data">


        <div class="form-group">
            <label class="font-weight-bold" for="">Tên đề tài:</label>
            <input type="text" class="form-control" name="tendetai" id="tendetai" aria-describedby="helpId"
                value="<?php echo $result['tendetai'] ?>" placeholder="Tên đề tài">
            <small id="erTen" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Mô tả đề tài</label>
            <input type="text" class="form-control" name="mota" id="mota" aria-describedby="helpId"
                placeholder="Mô tả đề tài" value="<?php echo $result['mota'] ?>">
            <small id="erThanhPhan" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Yêu cầu </label>
            <input type="text" class="form-control" name="yeucau" id="yeucau" aria-describedby="helpId"
                placeholder="Yêu cầu đề tài" value="<?php echo $result['yeucau'] ?>">
            <small id="erMoTa" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Kiến thức & Kỹ năng</label>
            <input type="text" class="form-control" name="kienthuc" id="kienthuc" aria-describedby="helpId"
                placeholder="Kiến thức thực hiện đề tài" value="<?php echo $result['kienthuc'] ?>">
            <small id="erGia" class="form-text "></small>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="">Số lượng</label>
            <input type="number" class="form-control" name="soluong_SV" id="soluong"
                value="<?php echo $result['soluong_SV'] ?>" placeholder="Số lượng sinh viên có thể đăng ký"
                aria-describedby="soluongHelpId">
            <small id="erFile" class="form-text "></small>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="">Loại khóa Luận</label>
            <select class="form-control" name="loai" id="loai">
                <?php
                while ($row = $getType->fetch(PDO::FETCH_ASSOC)) {

                    echo "<option value='" . $row['id_loai'] . "'>" . $row['tenloai'] . "</option>";
                }
                ?>



            </select>
        </div>
        <button id="btnsuadetai" name="update" class="btn btn-primary btndetai">Lưu cập nhật</button>

    </form>
</div>