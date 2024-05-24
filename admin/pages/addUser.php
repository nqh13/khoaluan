<?php
include('../classes/department.php');

$d = new Department();

$department = $d->getDepartments();


if (isset($_POST['themUser'])) {
}

?>

<div class="row m-5 " id="formAddUser">
    <div class="col-md-3"></div>
    <div class="card col-md-6  ">
        <div class="card-header border-bottom">
            <h5 class=" text-center">THÊM NGƯỜI DÙNG MỚI</h5>
            <div class="">
                <button class="btn btn-primary btn-sm" style="float: right;" type="button" id="import" data-toggle="modal" data-target="#modalImport"><i class="fa-solid fa-file-import"></i> Import File</button>
            </div>
        </div>
        <div class="card-block">
            <form method="POST" action="" class="" id="formAddUser" style="display: flex; flex-direction: column" enctype="multipart/form-data">
                <input type="hidden" name="token" id="tokenUser" value="<?php echo $tokenUser ?>">
                <div class="form-group">
                    <label class="form-control-label">Mã người dùng:</label>
                    <input name="manguoidung" type="text" class="form-control form-control-success" id="manguoidung" placeholder=" Nhập mã người dùng, nếu bỏ trống hệ thống sẽ tự tạo mã">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Tên người dùng:</label>
                    <input name="hoten" type="text" class="form-control form-control-success" id="hoten" placeholder="Nhập họ tên người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input name="email" type="text" class="form-control form-control-success" id="email" placeholder="Nhập họ tên người dùng" placeholder="Nhập email người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Số điện thoại:</label>
                    <input name="sdt" type="text" class="form-control form-control-success" id="sdt" placeholder="Nhập số điện thoại người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Địa chỉ:</label>
                    <input name="diachi" type="text" class="form-control form-control-success" id="diachi" placeholder="Nhập địa chỉ người dùng">
                    <small class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" class="form-control-label">Khoa:</label>
                    <select class="form-control" id="id_khoa" name="khoa">
                        <option value="" selected></option>
                        <?php

                        foreach ($department as $key => $value) {

                            echo '<option value="' . $value['ma_khoavien'] . '"  >' . $value['ten_khoavien'] . '</option>';
                        }

                        ?>


                    </select>
                    <small class="form-text text-muted"></small>

                </div>

                <div class="form-group">
                    <label for="exampleSelect1" class="form-control-label">Ngành:</label>
                    <select class="form-control" id="id_nganh" name="nganh">

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1" class="form-control-label">Vai Trò:</label>
                    <select class="form-control" id="vaitro" name="vaitro">
                        <option selected value=""></option>
                        <?php
                        $vaitro = $d->getRoles();
                        foreach ($vaitro as $roles) {

                            echo '<option value="' . $roles['ma_vaitro'] . '"  >' . $roles['tenvaitro'] . '</option>';
                        }
                        ?>
                    </select>
                    <small class="form-text text-muted"></small>

                </div>
                <div class="form-group row" id="">
                    <label for="file" class="col-md-2 col-form-label form-control-label">Ảnh:</label>
                    <div class="col-md-9" id="hinhanh">
                        <label for="file" class="custom-file">
                            <input type="file" name="hinhanh" id="file" class="custom-file-input" accept="image/*">
                            <span class="custom-file-control"></span>
                        </label>

                    </div>

                </div>

                <div style="display:flex; justify-content:start; align-items:start">
                    <div class=" d-none" style="position:relative" id="divAnh">
                        <span class=" " style="position:absolute;top:-10px; right:-10px ;font-size: 16px; border-radius: 50%; cursor:pointer; color:red ; font-weight: bold;  " id="btnXoaAnh">x</span>
                        <img src="" alt="" id="imgPreview" width="100px" height="100px">
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" style="margin-top: 10px" type="submit" id="btnThemUser" name="themUser">Thêm người dùng</button>
                </div>

            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row d-none" id="dataTable" style="padding: 20px;">
   
    <table class="table  table-bordered" style="margin-top: 10px;" id="data-table">
        <thead class="thead-dark">

        </thead>
        <tbody id="dataBody">

        </tbody>
    </table>
    <div class="">
        <button class="btn btn-primary btn-sm"  id="btnImport">Thêm người dùng</button>
    </div>
</div>

<!-- Modal Import -->

<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Import danh sách người dùng</h5>
            </div>
            <div class="modal-body">
                <h6>Tải File mẫu</h6>
                <p>File nhập liệu mẫu. <a href="../file_Upload/importUserSample.xlsx" role="button" class="btn btn-secondary popover-test" title="File mẫu" data-content=""><i class="fa fa-download" aria-hidden="true"></i></a></p>
                <hr>
                <h6>Chọn file import</h6>
                <input class="form-control" type="file" name="file" id="fileImport" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="getData">Improt Data</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<script src="assets/js/validator.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script src="excel.js"></script>
<script type="module">
    import "https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js";

    function themUser() {
        var token = $("#tokenUser").val();
        var manguoidung = $("#manguoidung").val();
        var hoten = $("#hoten").val();
        var email = $("#email").val();
        var sdt = $("#sdt").val();
        var diachi = $("#diachi").val();
        var khoa = $("#id_khoa").val();
        var nganh = $("#id_nganh").val();
        var vaitro = $("#vaitro").val();
        var fileInput = $("#file")[0].files[0];

        var fd = new FormData();
        fd.append("tokenUser", token);
        fd.append("action", "themUser");
        fd.append("manguoidung", manguoidung);
        fd.append("hoten", hoten);
        fd.append("email", email);
        fd.append("sodienthoai", sdt);
        fd.append("diachi", diachi);
        fd.append("khoa", khoa);
        fd.append("nganh", nganh);
        fd.append("vaitro", vaitro);
        fd.append("file", fileInput); // Thêm tệp vào FormData

        if (fileInput == undefined) {
            alert("Vui lý chọn hình ảnh");
        } else {
            $.ajax({
                type: "POST",
                url: "./adminHandle/handleAddUser.php",
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {

                    console.log(data);
                    async function sendMail() {
                        await axios
                            .post("http://localhost:3000/send-email", {
                                from: "nguyenquangha130901@gmail.com",
                                to: email,
                                subject: "Thông báo cấp tài khoản đăng nhập",
                                text: `${data}`,
                            })
                            .then((res) => {
                                console.log(res);
                                alert("Gửi mail thành công");
                            })
                            .catch((err) => console.log(err));
                    }

                    if (data != "Thêm tài khoản thất bại" || data != "") {
                        sendMail();
                    }
                    $("#formAddUser")[0].reset();
                    $("#divAnh").addClass("d-none");
                    $("#imgPreview").attr("src", "");
                    $("#hinhanh").removeClass("d-none");
                    alert(data);
                    window.location.href = "index.php?pages=quanlyUsers";
                },
            });
        }


    }
    const validate = () => {
        return Validator({
            form: '#formAddUser',
            errorSelector: '.form-text',
            rules: [
                Validator.isRequired('#hoten'),
                Validator.isRequired('#email'),
                Validator.isRequired('#sdt'),
                Validator.isRequired('#diachi'),
                Validator.isRequired('#id_khoa'),
                Validator.isRequired('#vaitro'),
                Validator.isEmail('#email'),
                Validator.isNumberPhone('#sdt'),
            ]
        }, themUser);
    }
    document.addEventListener('DOMContentLoaded', () => {
        validate();
    })

    const checkedData = []; // Array to store checked data

function handleCheck(rowData, event) {
    const checkbox = event.target;

    if (checkbox.checked) {
        checkedData.push(rowData);
    } else {
        const index = checkedData.findIndex(row => row === rowData);
        if (index !== -1) {
            checkedData.splice(index, 1);
        }
    }

    console.log('Checked data:', checkedData); // Display checked data in console
}

function handleCheckAll(XL_row_object, $table, event) {
    const checkbox = event.target;
    const isChecked = checkbox.checked;
    const checkboxes = $table.find('tbody input:checkbox');
    checkboxes.prop('checked', isChecked);

    if (isChecked) {
        checkboxes.each(function(index, checkbox) {
            handleCheck(XL_row_object[index], {
                target: checkbox
            });
        });
    } else {
        checkedData.length = 0; // Clear checked data array when "Check All" is unchecked
    }
}

    $(document).ready(function() {
        $("#getData").click(function() {
        var selectedFile = $("#fileImport")[0].files[0];
        // close modal
        $("#modalImport").modal("hide");
        var reader = new FileReader();
        reader.onload = function(event) {
            var data = event.target.result;
            var workbook = XLSX.read(data, {
                type: "binary",
            });
            workbook.SheetNames.forEach(function(sheetName) {
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(
                    workbook.Sheets[sheetName]
                );
                var json_object = JSON.stringify(XL_row_object);
                console.log(XL_row_object);
                // if the file is not empty then hide formAddUser and show table
                $("#formAddUser").addClass("d-none");
                $("#dataTable").removeClass("d-none");

                // Convert XL_row_object to a table structure using jQuery
                const $table = $("#data-table");
                const $headerRow = $("<tr></tr>").appendTo($table.find("thead"));
                const $body = $table.find("tbody");

                // Generate header row with Check All checkbox
                const $selectAllCheckbox = $("<input type='checkbox' id='selectAllCheckbox'>").appendTo($headerRow);
                $selectAllCheckbox.change(handleCheckAll.bind(null, XL_row_object, $table));

                // Generate header row for remaining columns
                $.each(XL_row_object[0], function(key, value) {
                    $("<th>" + key + "</th>").appendTo($headerRow);
                });

                // Generate table rows with checkboxes
                $.each(XL_row_object, function(index, row) {
                    const $row = $("<tr></tr>").appendTo($body);

                    // Add checkbox to the beginning of the row
                    const $checkbox = $("<input type='checkbox'>").appendTo($row);
                    $checkbox.change(handleCheck.bind(null, row));

                    // Add remaining table cells
                    $.each(row, function(key, value) {
                        $("<td>" + value + "</td>").appendTo($row);
                    });
                });
            });
        };
        reader.onerror = function(event) {
            console.error("File could not be read! Code " + event.target.error.code);
        };
        reader.readAsBinaryString(selectedFile);
    });
    $("#btnImport").click(function() {
        console.log(checkedData);
        $.ajax({
            type: "POST",
            url: "adminHandle/importUser.php",
            data: {
                checkedData: JSON.stringify(checkedData)
            },
            success: function(response) {
                console.log(response);
                alert(response);
            }
        });
    });

});


</script>