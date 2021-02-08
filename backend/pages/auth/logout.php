<?php
if (session_id() === '') {
    session_start();
}

if(isset($_SESSION['kh_tendangnhap_logged'])) {
    
    setcookie('kh_tendangnhap_logged', '', time()- (86400 * 31) ,'/');
    unset($_SESSION['kh_tendangnhap_logged']);
    unset($_COOKIE['kh_tendangnhap_logged']);

    // setcookie('kh_tendangnhap_logged', $kh_tendangnhap, time() + (86400 * 30), '/');
    echo 'đã xóa session!';
    echo 'đã xóa cookie!'; 
    // header('location:nguyenanhthoai/.php');
    echo "<script>alert('Bạn đã đăng xuất thành công')</script>";
    echo '<script>location.href = "/nguyenanhthoai/fontend/pages/index.php";</script>';
    
}
else {
    echo 'Người dùng chưa đăng nhập. Không thể đăng xuất dược!'; die;
}