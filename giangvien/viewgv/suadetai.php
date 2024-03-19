<div class="content mt-1">
    <div class="p-3 border-bottom">
        <h5 class="text-primary text-center font-weight-bold">CẬP NHẬT THÔNG TIN ĐỀ TÀI</h5>
    </div>
    <form action="" method="post" class="formdetai" id="" style="padding:10px;" enctype="multipart/form-data">


        <div class="form-group">
            <label class="font-weight-bold" for="">Tên đề tài:</label>
            <input type="text" class="form-control" name="tendetai" id="tendetai" aria-describedby="helpId" value="" placeholder="Tên đề tài">
            <small id="erTen" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Mô tả đề tài</label>
            <input type="text" class="form-control" name="mota" id="mota" aria-describedby="helpId" placeholder="Mô tả đề tài" value="">
            <small id="erThanhPhan" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Yêu cầu </label>
            <input type="text" class="form-control" name="yeucau" id="yeucau" aria-describedby="helpId" placeholder="Yêu cầu đề tài" value="">
            <small id="erMoTa" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Kiến thức</label>
            <input type="text" class="form-control" name="kienthuc" id="kienthuc" aria-describedby="helpId" placeholder="Kiến thức thực hiện đề tài" value="">
            <small id="erGia" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Kỹ năng</label>
            <input type="text" class="form-control" name="kynang" id="kynang" aria-describedby="helpId" placeholder="Kỹ năng phục vụ đề tài" value="">
            <small id="erChiPhi" class="form-text "></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="">Số lượng</label>
            <input type="number" class="form-control" name="soluong" id="soluong" placeholder="Số lượng sinh viên có thể đăng ký" aria-describedby="soluongHelpId">
            <small id="erFile" class="form-text "></small>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="">Loại khóa Luận</label>
            <select class="form-control" name="loai" id="">


                <option value="1" selected>KLTN-ĐH</option>
                <option value="2">KLTN-CĐ</option>

            </select>
        </div>
        <button id="btnsuadetai" name="suadetai" class="btn btn-primary btndetai">Lưu cập nhật</button>

    </form>
</div>