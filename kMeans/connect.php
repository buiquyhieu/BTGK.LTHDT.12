<?php
$conn = new mysqli('localhost', 'root', '', 'hoc_sinh');
mysqli_set_charset($conn, 'UTF8');
if ($conn->connect_error) {
        die('ket noi that bai' . $conn->connect_error);
    }
