<?php
require_once('../classes/semester.php');
$semester = new Semester();
$status = 1;
$listSemester = $semester->getSemesterByStatus($status);


?>

<div class="content mt-1">
    <div class="p-3 border-bottom">
        <h5 class="text-primary text-center font-weight-bold ">THÊM ĐỀ TÀI MỚI</h5>
    </div>
    <div class="p-3">
        <form action="" method="post" class="" id="formthemdetai" style="padding:10px;" enctype="multipart/form-data">
            <input type="hidden" name="_token" id="tokenUser" value="<?php echo $tokenUser; ?>">

            <div class="form-group">
                <label class="font-weight-bold" for="">Tên đề tài:</label>
                <input type="text" class="form-control" name="tendetai" id="tendetai" aria-describedby="helpId" value=""
                    placeholder="Tên đề tài">
                <small id="erTen" class="form-text "></small>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="">Mô tả đề tài</label>
                <input type="text" class="form-control" name="mota" id="mota" aria-describedby="helpId"
                    placeholder="Mô tả đề tài" value="">
                <small id="erThanhPhan" class="form-text "></small>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="">Yêu cầu </label>
                <input type="text" class="form-control" name="yeucau" id="yeucau" aria-describedby="helpId"
                    placeholder="Yêu cầu đề tài" value="">
                <small id="erMoTa" class="form-text "></small>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="">Kiến thức & Kỹ Năng</label>
                <input type="text" class="form-control" name="kienthuc" id="kienthuc" aria-describedby="helpId"
                    placeholder="Kiến thức thực hiện đề tài" value="">
                <small id="erGia" class="form-text "></small>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="">Số lượng</label>
                <input type="number" class="form-control" name="soluong_SV" id="soluong_SV"
                    placeholder="Số lượng sinh viên có thể đăng ký" aria-describedby="soluongHelpId">
                <small id="erFile" class="form-text "></small>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="">Loại khóa Luận</label>
                <select class="form-control" name="loai" id="loaidt">
                    <option value="1" selected>KLTN-ĐH</option>
                    <option value="2">KLTN-CĐ</option>

                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="">Học kì</label>
                <select class="form-control" name="hocki" id="hocki">
                    <!-- <option value="1" selected>KLTN-ĐH</option> -->
                    <?php


                    foreach ($listSemester as $key => $value) {

                        echo '<option value="' . $value['ma_hk'] . '">' . $value['tenhocki'] . '</option>';
                    }

                    ?>

                </select>
            </div>
            <button id="btnthemdetai" name="them" type="submit" class="btn btn-primary btndetai">Lưu đề tài</button>


        </form>

    </div>

</div>
<script src="../Assets/js/validate.js"></script>
<script>
const validate = () => {
    return Validator({
        form: '#formthemdetai',
        errorSelector: '.form-text',
        rules: [
            Validator.isRequired('#tendetai'),
            Validator.isRequired('#mota'),
            Validator.isRequired('#yeucau'),
            Validator.isRequired('#kienthuc'),
            Validator.isRequired('#soluong_SV'),
            Validator.isNumber('#soluong_SV'),
            Validator.isNumberQty('#soluong_SV'),
            Validator.checkXSS('#mota'),
            Validator.checkXSS('#yeucau'),
            Validator.checkXSS('#kienthuc'),
            Validator.checkXSS('#tendetai'),
        ]
    }, () => handelAddTopic(<?php echo $_SESSION['ma_nguoidung'] . ',' . $_SESSION['ma_nganh']; ?>));
}
document.addEventListener('DOMContentLoaded', () => {
    validate();
})
</script>