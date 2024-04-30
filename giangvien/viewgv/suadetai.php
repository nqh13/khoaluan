<?php

require_once('../classes/typetopic.php');
require_once('../classes/topic.php');
require_once('../classes/semester.php');
$type = new Typetopic();
$topic  = new Topic();
$semester = new Semester();
$getType  = $type->getAllType();
$getSemesters = $semester->getSemesterByStatus(1);
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
    <form action="" method="post" class="" id="formUpdateTopic" style="padding:10px;" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser; ?>">
        <div class="form-group">
            <label class="font-weight-bold" for="">Tên đề tài:</label>
            <input type="text" class="form-control" name="tendetai" id="tendetai" value="<?php echo $result['tendetai'] ?>" placeholder="Tên đề tài">
            <small id="erTen" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Mô tả đề tài</label>
            <input type="text" class="form-control" name="mota" id="mota" placeholder="Mô tả đề tài" value="<?php echo $result['mota'] ?>">
            <small id="erThanhPhan" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Yêu cầu </label>
            <input type="text" class="form-control" name="yeucau" id="yeucau" placeholder="Yêu cầu đề tài" value="<?php echo $result['yeucau'] ?>">
            <small id="erMoTa" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Kiến thức & Kỹ năng</label>
            <input type="text" class="form-control" name="kienthuc" id="kienthuc" placeholder="Kiến thức thực hiện đề tài" value="<?php echo $result['kienthuc'] ?>">
            <small id="erGia" class="form-text "></small>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="">Số lượng</label>
            <input type="number" class="form-control" name="soluong_SV" id="soluong" value="<?php echo $result['soluong_SV'] ?>" placeholder="Số lượng sinh viên có thể đăng ký" aria-describedby="soluongHelpId">
            <small id="erFile" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Loại khóa Luận</label>
            <select class="form-control" name="hocki" id="hocki">
                <?php

                while ($kq = $getSemesters->fetch(PDO::FETCH_ASSOC)) {

                    echo "<option value='" . $kq['hocki'] . "'>" . $kq['tenhocki'] . " </option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Loại khóa Luận</label>
            <select class="form-control" name="loai" id="loai">
                <?php
                $selectedType = "";
                while ($row = $getType->fetch(PDO::FETCH_ASSOC)) {
                    if ($result['loaidetai'] == $kq['id_loai']) {
                        $selectedType = "selected";
                    }
                    echo "<option value='" . $row['id_loai'] . "'>" . $row['tenloai'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button id="btnsuadetai" name="update" class="btn btn-primary btndetai" type="submit">Lưu cập nhật</button>

    </form>
</div>


<script src="../Assets/js/validate.js"></script>

<script>
    const validate = () => {
        return Validator({
            form: '#formUpdateTopic',
            errorSelector: '.form-text',
            rules: [
                Validator.isRequired('#tendetai'),
                Validator.isRequired('#mota'),
                Validator.isRequired('#yeucau'),
                Validator.isRequired('#kienthuc'),
                Validator.isRequired('#soluong'),
                Validator.isNumber('#soluong'),
                Validator.isNumberQty('#soluong'),
                Validator.checkXSS('#mota'),
                Validator.checkXSS('#yeucau'),
                Validator.checkXSS('#kienthuc'),
                Validator.checkXSS('#tendetai'),
            ]
        }, () => handelUpdateTopic(<?php echo $id; ?>));
    }
    document.addEventListener('DOMContentLoaded', () => {
        validate();
    })
</script>