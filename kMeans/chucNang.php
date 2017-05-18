<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'hoc_sinh');
mysqli_set_charset($conn, 'UTF8');
if ($conn->connect_error) {
    die('ket noi that bai' . $conn->connect_error);
}
$sql = 'select * from hocsinh WHERE SOBAODANH="' . $_POST['msg'] . '"';
$rs = $conn->query($sql);
$result = array();
if ($rs->num_rows > 0) {
    $row = $rs->fetch_assoc();
    
        $_SESSION['SOBAODANH'] = $row['SOBAODANH'];
        $_SESSION['HO_TEN'] = $row['HO_TEN'];
        $_SESSION['GIOI_TINH'] = $row['GIOI_TINH'];
        $_SESSION['toan'] = $row['toan'];
        $_SESSION['van'] = $row['van'];
        $_SESSION['nhom'] = $row['nhom']; 
    header('location:index.php');
}
else{
    echo 'Không tồn tại';
}
