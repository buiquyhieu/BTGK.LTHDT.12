<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kmeans</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h4><a href="viewPC.php" target="_blank" >Xem biểu diễn cụm</a><h4>
            
            <h3 style="color:#5bc0de">Thêm sinh viên</h3>
            <form >
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">Số báo danh</span>
                            <input id="msg" type="text" class="form-control" name="msg" placeholder=" Điền số báo danh" >
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Họ tên</span>
                            <input id="msg" type="text" class="form-control" name="msg" placeholder=" Điền họ và tên" >
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Giới tính</span>
                            <input id="msg" type="text" class="form-control" name="msg" placeholder="Điền giới tính" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">Toán</span>
                            <input id="msg" type="text" class="form-control" name="msg" placeholder="Điểm toán" >
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Văn</span>
                            <input id="msg" type="text" class="form-control" name="msg" placeholder="Điểm văn" >
                        </div>
                        <br>
                        <button type="button" class="btn btn-info">Thêm</button>
                    </div>
                </div>
            </form>
            <br>
            <h3 style="color:green">Tìm kiếm</h3>
            <form >
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input id="msg" type="text" class="form-control" name="msg" placeholder="Ghi số báo danh" style="width: 70%">
                    <button type="button" class="btn btn-success" style="margin-left: 30px">Tìm Kiếm</button>
                </div>
            </form>
            <br>
            <div id="result" ></div>
            <script>
                var mang = new Array();
                $.ajax({
                    url: 'kmean.php',
                    type: 'post',
                    dataType: 'json',
                    success: function (result) {
                        console.log(result);

                        var html = '';
                        html += '<table class="table table-hover" >';
                        html += '<thead style="color:brown"><tr><th>Số báo danh</th><th>Họ tên</th><th>Giới tính</th><th>Toán</th><th>Văn</th><th>Nhóm</th></tr></thead>';
                        $.each(result, function (key, item) {
                            mang.push(item);
                        });
                        for (var i = 0; i < mang.length; i++) {
                            for (var j = 0; j < mang[i]['tamcum'].nhom; j++) {
                                html += '<tbody><tr>';
                                html += '<td>' + mang[i][j].SOBAODANH + '</td>';
                                html += '<td>' + mang[i][j].HO_TEN + '</td>';
                                html += '<td>' + mang[i][j].GIOI_TINH + '</td>';
                                html += '<td>' + mang[i][j].toan + '</td>';
                                html += '<td>' + mang[i][j].van + '</td>';
                                html += '<td>' + mang[i][j].nhom + '</td>';
                                html += '</tr></tbody>';
                            }
                        }

                        //                        console.log(mang[0][0].toan);
                        html += '</table>';
                        $('#result').html(html);
                    }
                });

            </script>

            <?php
            ?>
        </div>
    </body>
</html>
