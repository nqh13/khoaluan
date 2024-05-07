<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-header-text">QUẢN LÝ ĐỀ TÀI</h5>

            <!-- <p>Basic example <code>without any additional modification</code> classes</p> -->

            <div class="form-group row">
                <div class="col-md-3"><label class="sr-only"></label></div>
                <div class="col-md-5 ">
                    <form action="" method="post" class="" style="margin-top: 12px ;">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <div class="dropdown">
                                    <div type="button" class="btn btn-info addon-btn shadow-none waves-effect waves-light dropdown-toggle addon-btn" id="dropdownMenuButton" data-toggle="dropdown" data-search="madetai" aria-haspopup="true" aria-expanded="false">
                                        Mã đề tài
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <div class="dropdown-item" data-search="tendetai" data-value="Tên đề tài">Tên đề tài</div>
                                        <div class="dropdown-item" data-search="magiangvien" data-value="Mã Giảng viên">Mã Giảng viên</div>
                                        <div class="dropdown-item" data-search="khoa" data-value="Tên khoa">Tên khoa</div>
                                        <div class="dropdown-item" data-search="nganh" data-value="Ngành">Ngành</div>
                                    </div>
                                </div>
                            </div>
                            <input id="keyword" type="text" class="form-control" placeholder="Nhập từ khóa" aria-describedby="btn-addon2">
                            <span class="input-group-btn" id="btn-addon2">
                                <button type="button" class="btn btn-info shadow-none addon-btn waves-effect waves-light" id="searchBtn" onclick="searchTopic()">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    <form action="" method="post">
                        <div class="form-group row d-flex">
                            <span class="col-sm-1  col-form-label ">
                                Học kì:</span>
                            <div class="col-sm-8">

                                <select class="form-control " id="vaitro" name="vaitro">
                                    <option value="">All</option>
                                </select>

                            </div>
                            <button type="button" class="btn btn-info col-sm-2" name="filterRole" style="width: 45px; height: 38px;"><i class="fa-solid fa-filter"></i></button>

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="card-block">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table hover table-bordered">
                        <thead class="">
                            <tr class="bg-info">
                                <th class="text-center">#</th>
                                <th class="text-center">Mã đề tài</th>
                                <th class="text-center">Tên đề tài</th>
                                <th class="text-center">Mô tả </th>
                                <th class="text-center">Yêu cầu</th>
                                <th class="text-center">Giảng viên</th>
                                <th class="text-center">Khoa</th>
                                <th class="text-center">Ngành</th>
                                <th class="text-center">Loại</th>
                                <th class="text-center">Học kì</th>

                            </tr>
                        </thead>
                        <tbody id="tbody">




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function searchTopic() {
        var action = document.getElementById("dropdownMenuButton").getAttribute("data-search");
        var keyword = document.getElementById("keyword").value;
        // Do something with action and keyword
        console.log("Action:", action);
        console.log("Keyword:", keyword);
    }

    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', event => {
            const value = event.target.getAttribute('data-value');
            const search = event.target.getAttribute('data-search');
            document.getElementById('dropdownMenuButton').innerText = value;
            document.getElementById('dropdownMenuButton').setAttribute('data-search', search);
        });
    });
</script>