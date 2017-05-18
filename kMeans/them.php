<?php
session_start();
require_once 'connect.php';
$sql='insert into hocsinh (SOBAODANH,HO_TEN,GIOI_TINH,toan,van) values ("'.$_POST['sbd'].'","'.$_POST['hoten'].'","'.$_POST['gioitinh'].'","'.$_POST['dtoan'].'","'.$_POST['dvan'].'")';
$sl='select * from hocsinh where SOBAODANH="'.$_POST['sbd'].'"';
$r=$conn->query($sl);
if ($r->num_rows>0) {
    
    $row=$r->fetch_assoc();
    echo '<h4 style="color:red">Đã có số báo danh này</h4>';
    echo '<table border="1" cellspacing="0" cellpadding="5" style="color:grey">'
                    . '<tr style="color:#337ab7"><th>Số báo danh</th><th>Họ tên</th><th>Giới tính</th><th>Toán</th><th>Văn</th><th>Nhóm</th></tr>'
                           .'<tr>'.'<td>'.$row['SOBAODANH'].'</td>'.
                            '<td>'.$row['HO_TEN'].'</td>'.
                            '<td>'.$row['GIOI_TINH'].'</td>'.
                            '<td>'.$row['toan'].'</td>'.
                            '<td>'.$row['van'].'</td>'.
                            '<td>'.$row['nhom'].'</td>'.
                            '</tr></table>';
}
else{
    $conn->query($sql);
    $_SESSION['them']=$_POST['sbd'];
    header('location:xemNhom.php');
//    echo '<h4>Thêm thành công</h4>';
    
}
$conn->close();

