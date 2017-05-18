<?php
function DB(){
$conn=new mysqli('localhost','root','','hoc_sinh');
mysqli_set_charset($conn, 'UTF8');
if ($conn->connect_error) {
    die('ket noi that bai'.$conn->connect_error);
}

$sql='select * from hocsinh';
$rs=$conn->query($sql);
$result=array();
if ($rs->num_rows>0) {
    while ($row=$rs->fetch_assoc()) {
        $result[]=array(
            'SOBAODANH'=>$row['SOBAODANH'],
            'HO_TEN'=>$row['HO_TEN'],
            'GIOI_TINH'=> $row['GIOI_TINH'],
            'toan'=>$row['toan'],
            'van'=>$row['van'],
            'dia'=>$row['dia'],
            'anh'=>$row['anh'],
            'nhom'=>""
        );
    }
}
return $result;
}