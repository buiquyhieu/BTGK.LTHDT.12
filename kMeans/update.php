<?php

function upDate($id, $nhom) {
    $conn = new mysqli('localhost', 'root', '', 'hoc_sinh');
    mysqli_set_charset($conn, 'UTF8');
    if ($conn->connect_error) {
        die('ket noi that bai' . $conn->connect_error);
    }
    $sql = 'update hocsinh set nhom ="' . $nhom . '" where SOBAODANH ="' . $id . '"';
    $conn->query($sql);
}
