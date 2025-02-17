<?php
//lay du lieu id can xoa

$svid = $_GET['sid'];
//ket noi
require_once 'ketnoi.php';
//cau lenh sql
$xoa_sql = "DELETE FROM sinhvien WHERE id=$svid";

mysqli_query($conn, $xoa_sql);
// echo"<h1>Xoa thanh cong</h1>";
header("Location: lietke.php");
