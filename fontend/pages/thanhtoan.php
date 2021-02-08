<?php
if (session_id() === '') {
    session_start();
}

if (!isset($_SESSION['kh_tendangnhap_logged']) || empty($_SESSION['kh_tendangnhap_logged'])) {
    echo "<script>alert('Vui lòng Đăng nhập trước khi Thanh toán! ')</script>";
    echo "<script>location.href = '/nguyenanhthoai/backend/pages/auth/login.php';</script>";
    die;
} else {

    if (!isset($_SESSION['giohang']) || empty($_SESSION['giohang'])) {
        echo "<script>alert('Giỏ hàng rỗng. Vui lòng chọn Sản phẩm trước khi Thanh toán!')</script>";
        echo "<script>location.href = '/nguyenanhthoai/fontend/pages/index.php';</script>";
        die;
    }
}

include_once(__DIR__ . '/../../dbconnect.php');

$kh_tendangnhap = $_SESSION['kh_tendangnhap_logged'];
// var_dump($kh_tendangnhap);die;
$sqlSelectKhachHang = <<<EOT
    SELECT *
    FROM `khachhang` kh
    WHERE kh.kh_tendangnhap = '$kh_tendangnhap'
EOT;
    // var_dump($sqlSelectKhachHang);die;

$resultSelectKhachHang = mysqli_query($conn, $sqlSelectKhachHang);
$dataSelectKhachHang = [];

while ($row = mysqli_fetch_array($resultSelectKhachHang, MYSQLI_ASSOC)) {
    $dataSelectKhachHang []= array(
        'kh_tendangnhap' => $row['kh_tendangnhap'],
        'kh_ten' => $row['kh_ten'],
        'kh_diachi' => $row['kh_diachi'],
        'kh_sdt' => $row['kh_sdt'],
        'kh_ma' => $row['kh_ma']
   
    );
}
$dataKhachHang = $dataSelectKhachHang[0];
$dh_diachi = $dataKhachHang['kh_diachi'];
$dh_kh_ten = $dataKhachHang['kh_ten'];

$giohang = $_SESSION['giohang'];

foreach ($giohang as $item) {
    $sp_ma = $item['sp_ma'];
    $sp_dh_soluong = $item['soluongmua'];
    $sp_dh_dongia = $item['sp_gia'];
    $sp_dh_thanhtien = $item['thanhtien'];

 $sql = "INSERT INTO donhang
(kh_tendanhnhap, kh_ten, dh_diachi, sp_ma, dh_soluongmua, dh_gia, dh_thanhtien, dh_ngaylap)
VALUES ('$kh_tendangnhap','$dh_kh_ten', '$dh_diachi', $sp_ma, $sp_dh_soluong,  $sp_dh_dongia, $sp_dh_thanhtien , NOW())";
    mysqli_query($conn, $sql);
}

unset($_SESSION['giohang']);
echo "<script>alert('Bạn Đã Mua Hàng Thành Công!')</script>";
echo "<script>location.href = '/nguyenanhthoai/fontend/pages/index.php';</script>";


?>