<?php
include_once(__DIR__ . '/../../../dbconnect.php');

$dh_ma = $_GET['dh_ma'];
// $data = $dataSanPham[0];

$sqlDelete = "DELETE FROM donhang WHERE dh_ma=$dh_ma";
$resultDelete = mysqli_query($conn, $sqlDelete);
mysqli_close($conn);
echo "<script>alert('Bạn xóa đơn hàng thành công')</script>";
echo "<script>location.href = 'index.php';</script>";
