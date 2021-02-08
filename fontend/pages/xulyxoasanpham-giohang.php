<?php
if (session_id() === '') {
    session_start();
}

include_once(__DIR__ . '/../../dbconnect.php');

$sp_ma = $_GET['sp_ma'];

if (isset($_SESSION['giohang'])) {
    $giohang = $_SESSION['giohang'];
    foreach( $giohang as $data ){
        if($data['sp_ma'] == $sp_ma) {
            $key = array_search($data,$giohang);
            unset($_SESSION['giohang'][$key]);                       
        }
    }
}

echo "<script>alert('Xóa sản phẩm thành công!')</script>";
echo "<script>location.href = '/nguyenanhthoai/fontend/pages/card.php';</script>";
?>