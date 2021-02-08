<?php
$conn = mysqli_connect('localhost','root','','web_banhang') or die('Xin lỗi bạn kết nối thất bại. Vui làm kiểm tra lại.');
$conn->query("SET NAME 'utf8mb4'");
$conn->query("SET CHARACTER SET 'UTF8MB4'");
$conn->query("SET SESSION collation_connection ='utf8mb4_unicode_ci'");
?>