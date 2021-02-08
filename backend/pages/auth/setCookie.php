<?php 

function showDebug($thongbao)
{
    echo '<script type="text/javascript">alert("' . $thongbao . '");</script>';
}

if (session_id() === '') {
    session_start();
}

$cookieValue = $_SESSION['kh_tendangnhap_logged'];
setcookie('kh_tendangnhap_logged', $cookieValue, time() + (60*60*24*30*12) , '/', '', 0);

echo '<script>location.href = "/nguyenanhthoai/fontend/pages/index.php";</script>';

?>