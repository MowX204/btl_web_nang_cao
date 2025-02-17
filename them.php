<?php
//nhan du lieu tu form
$ht =  $_POST['hoten'];
$masv =  $_POST['masv'];
$lop =  $_POST['lop'];

//ket noi csdl
require_once 'ketnoi.php';

//viet lenh sql de them du lieu
$themsql = "INSERT INTO 
sinhvien (masv, hoten, lop) 
VALUES ('$masv', '$ht', '$lop')";
//echo $themsql; exit;

//thuc thi cau lenh
if(mysqli_query($conn, $themsql)){
    //tro ve trang liet ke
    header("Location: lietke.php");
}


