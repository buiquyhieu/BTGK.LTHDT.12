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
        
        <?php
        session_start();
        ?>
        
        <div class="container">
            <h1 style="text-align: center;color: orange;font-weight: 700">PHÂN LOẠI HỌC SINH</h1>
            <div class="row">
                <div class="col-md-2"><h4><a href="viewPC.php" target="_blank" >Xem biểu diễn cụm</a></h4></div>
                <div class="col-md-8" style="text-align: center;color: green"><h1 style="font-weight: 900">KMEANS</h1></div>
                <div class="col-md-2" style="margin-top: 10px"> <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Thêm sinh viên</button></div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Thông tin sinh viên</h4>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="them.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Số báo danh</span>
                                            <input id="msg" type="text" class="form-control" name="sbd" placeholder=" Điền số báo danh" >
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Họ tên</span>
                                            <input id="msg" type="text" class="form-control" name="hoten" placeholder=" Điền họ và tên" >
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Giới tính</span>
                                            <input id="msg" type="text" class="form-control" name="gioitinh" placeholder="Điền giới tính" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">Toán</span>
                                            <input id="msg" type="text" class="form-control" name="dtoan" placeholder="Điểm toán" >
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon">Văn</span>
                                            <input id="msg" type="text" class="form-control" name="dvan" placeholder="Điểm văn" >
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-info" name="nut">Thêm</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h3 style="color:green">Tìm kiếm</h3>
            <form>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input id="msgTK" type="text" class="form-control" name="msg" placeholder="Ghi số báo danh" style="width: 85%">
                    <button id="tkiem" type="button" class="btn btn-success" style="margin-left: 30px">Tìm Kiếm</button>
                </div>
            </form>
            <br>
            <button id="hienthi" type="button" class="btn btn-primary">Hiển thị danh sách</button>
            <div id="result" ></div>
            <!--Danh sách phân nhóm-->
            <script>
                
                var mang = new Array();
                $('#hienthi').click(function () {
                    
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
                });
            </script>
            <!--Tìm kiếm học sinh-->
            <script>
                
                $('#tkiem').click(function () {
                    mang = new Array();
                    $.ajax({
                        url: 'kmean.php',
                        type: 'post',
                        dataType: 'json',
                        success: function (result) {
                            console.log(result);
                            var tk=$('#msgTK').val();
                            var html = '';
                            html += '<table class="table table-hover" >';
                            html += '<thead style="color:brown"><tr><th>Số báo danh</th><th>Họ tên</th><th>Giới tính</th><th>Toán</th><th>Văn</th><th>Nhóm</th></tr></thead>';
                            $.each(result, function (key, item) {
                                mang.push(item);
                            });
                            for (var i = 0; i < mang.length; i++) {
                                for (var j = 0; j < mang[i]['tamcum'].nhom; j++) {
                                    if (mang[i][j].SOBAODANH===tk) {
                                    html += '<tbody><tr>';
                                    html += '<td>' + mang[i][j].SOBAODANH + '</td>';
                                    html += '<td>' + mang[i][j].HO_TEN + '</td>';
                                    html += '<td>' + mang[i][j].GIOI_TINH + '</td>';
                                    html += '<td>' + mang[i][j].toan + '</td>';
                                    html += '<td>' + mang[i][j].van + '</td>';
                                    html += '<td>' + mang[i][j].nhom + '</td>';
                                    html += '</tr></tbody>';
                                    break;
                                }
                                }
                            }
                            
                            //                        console.log(mang[0][0].toan);
                            html += '</table>';
                            $('#result').html(html);
                        }
                    });
                });
            </script>
            <!--Thêm học sinh-->
            <?php
//                            require_once 'kmean.php';
            if (!$_SESSION['SOBAODANH']) {
                echo "";
            } else {
//                    require_once 'kmean.php';
                echo '<table class="table table-hover" >'
                . '<thead style="color:brown"><tr><th>Số báo danh</th><th>Họ tên</th><th>Giới tính</th><th>Toán</th><th>Văn</th><th>Nhóm</th></tr></thead>'
                . '<tbody><tr>' . '<td>' . $_SESSION['SOBAODANH'] . '</td>' .
                '<td>' . $_SESSION['HO_TEN'] . '</td>' .
                '<td>' . $_SESSION['GIOI_TINH'] . '</td>' .
                '<td>' . $_SESSION['toan'] . '</td>' .
                '<td>' . $_SESSION['van'] . '</td>' .
                '<td>' . $_SESSION['nhom'] . '</td>' .
                '</tr></tbody></table>';
                session_destroy();
            }
            ?>
        </div>
    </body>
</html>
