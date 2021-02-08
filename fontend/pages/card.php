<?php
if (session_id() === '') {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<title>Danh Sách Giỏ Hàng</title>
<?php include_once(__DIR__ . '/../layouts/partials/config.php') ?>
<?php
include_once(__DIR__ . '/../../dbconnect.php');
?>

<head>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <style>
        .hinhdaidien {
            width: 100px;
            height: 100px;
        }
    </style>
    <script src="/nguyenanhthoai/assets/vendor/sweetalert/sweetalert.min.js"></script>
</head>

<body>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <div class="container" style="margin-top: 70px;">
        <h2 class="text-center">Giỏ Hàng</h2>
        <?php
        if (isset($_SESSION['giohang'])) {
            $giohang = $_SESSION['giohang'];
        }

        $sum = 0;
        ?>
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($giohang)) : ?>
                    <a href="index.php" class="btn btn-primary mt-4 mb-3">
                        Mua Thêm
                    </a>
                    <form action="" method="POST" id="frmDanhSachGioHang" name="frmDanhSachGioHang">
                        <table id="tblGioHang" class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                <?php foreach ($giohang as $data) : ?>
                                    <tr>
                                        <td name="stt"><?= $stt++ ?></td>
                                        <td>
                                            <?php if (empty($data['sp_hinh'])) : ?>
                                                <img src="/nguyenanhthoai/fontend/images/demo/default-png-5-png-image-default-png-1200_800.png" class="img-fluid hinhdaidien" />
                                            <?php elseif (($data['sp_hinh']) && ($data['lsp_ma']) == 1) : ?>
                                                <img src="/nguyenanhthoai/fontend/images/dienthoai/<?= $data['sp_hinh'] ?>" class="img-fluid hinhdaidien" />

                                            <?php elseif (($data['sp_hinh']) && ($data['lsp_ma']) == 2) : ?>
                                                <img src="/nguyenanhthoai/fontend/images/laptop/<?= $data['sp_hinh'] ?>" class="img-fluid hinhdaidien" />
                                            <?php elseif (($data['sp_hinh']) && ($data['lsp_ma']) == 3) : ?>

                                                <img src="/nguyenanhthoai/fontend/images/tablet/<?= $data['sp_hinh'] ?>" class="img-fluid hinhdaidien" />
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $data['sp_ten'] ?></td>
                                        <td><?= $data['soluongmua'] ?></td>
                                        <td><?= number_format($data['sp_gia'], 0, ".", ",") . ' vnđ' ?></td>
                                        <td><?= number_format($data['thanhtien'], 0, ".", ",") . ' vnđ'  ?></td>
                                        <td>
                                            <a onclick="deleteSanPham(<?= $data['sp_ma'] ?>)" data-sp_ma="<?= $data['sp_ma'] ?>" class=" btn btn-danger btn-delete-sanpham">
                                                <i class="fa fa-trash" aria-hidden="true"></i>Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $sum += $data['thanhtien'];
                                    ?>
                            </tbody>

                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4">
                                <b>Tổng cộng:</b>
                            </td>
                            <td colspan="3" style="color: red;">
                                <?= number_format($sum, 0, ".", ",") . ' vnđ'  ?>
                            </td>
                        </tr>
                        </table>
                    </form>
                <?php else : ?>
                    <h2>Giỏ hàng rỗng!!!</h2>
                <?php endif; ?>
                <a href="/nguyenanhthoai/fontend/pages/index.php" class="btn btn-warning btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay
                    về trang chủ</a>
                <a href="/nguyenanhthoai/fontend/pages/thanhtoan.php" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thanh toán</a>
            </div>
        </div>
    </div>
</body>
<div class="container-fluid">
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php') ?>
</div>
</body>

<script>
    function deleteSanPham(sp_ma) {
        swal({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "xulyxoasanpham-giohang.php?sp_ma=" + sp_ma;
                    location.href = url;

                } else {
                    swal("Cẩn thận hơn nhé!");
                }
            });
    }
</script>

</html>