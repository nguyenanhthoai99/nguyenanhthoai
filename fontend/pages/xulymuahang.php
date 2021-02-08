<?php 
if (session_id() === '') {
    session_start();
}

include_once(__DIR__ .'/../../dbconnect.php');
$sp_ma = $_GET["sp_ma"];
$soluongmua = $_POST['soluongmua'];


$sql = <<<OTE
    SELECT sp.sp_ma, sp.sp_ten,sp.sp_hinh, sp.lsp_ma, sp.sp_gia, sp.sp_giacu, km.km_qua, (sp.sp_gia * $soluongmua ) as thanhtien
    FROM sanpham sp
    JOIN khuyenmai km ON km.km_ma = sp.km_ma
    WHERE sp.sp_ma = $sp_ma;
OTE;
$result  = mysqli_query($conn, $sql);
$datamuahang = [];
while ($row  = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $datamuahang[] = array(
        'sp_ma' => $row['sp_ma'],
        'sp_ten' => $row['sp_ten'],
        'sp_gia' => $row['sp_gia'],
        // 'sp_giacu' => $row['sp_giacu'],
        'sp_hinh' => $row['sp_hinh'],
        'sp_hinh' => $row['sp_hinh'],
        'thanhtien' => $row['thanhtien'],
        'lsp_ma' => $row['lsp_ma'],
        'soluongmua' => $_POST['soluongmua']
        
    );
}

$data = $datamuahang[0];

$giohang = [];

if (isset($_SESSION['giohang'])) {
    $giohang = $_SESSION['giohang'];
} else {
    $giohang = [];
}

array_push($giohang, $data);

$_SESSION['giohang'] = $giohang;

echo "<script>location.href = '/nguyenanhthoai/fontend/pages/card.php';</script>";