<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm Tablet</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link href="/nguyenanhthoai/assets/vendor/DataTables/datatables.css" type="text/css" rel="stylesheet" />
    <link href="/nguyenanhthoai/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet" />
    <?php include_once(__DIR__ . '/../../layouts/partials/config.php'); ?>
</head>

<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $sql = <<<OTE
    SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_soluong, sp.sp_ngaycapnhat, sp.sp_hinh,
    sp.sp_hinhchitiet, km.km_ten, km.km_ma, nsx.nsx_ma, nsx.nsx_ten, lsp.lsp_ma, lsp.lsp_ten
    FROM sanpham AS sp
    JOIN khuyenmai km ON km.km_ma = sp.km_ma
    JOIN nhasanxuat AS nsx ON nsx.nsx_ma = sp.nsx_ma
    JOIN loaisanpham lsp ON lsp.lsp_ma = sp.lsp_ma
    WHERE sp.lsp_ma = 3 AND sp.sp_sanphamhot IS NULL AND sp.sp_slider IS NULL
    GROUP BY sp.sp_ma DESC 
OTE;
    $result  = mysqli_query($conn, $sql);
    $dataTablet = [];
    while ($row  = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $dataTablet[] = array(
            'sp_ma' => $row['sp_ma'],
            'sp_ten' => $row['sp_ten'],
            'lsp_ma' => $row['lsp_ma'],
            'lsp_ten' => $row['lsp_ten'],
            'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
            'sp_gia' => $row['sp_gia'],
            'sp_giacu' => $row['sp_giacu'],
            'sp_hinh' => $row['sp_hinh'],
            'sp_soluong' => $row['sp_soluong'],
            'sp_hinhchitiet' => $row['sp_hinhchitiet'],
            'km_ten' => $row['km_ten'],
            'km_ma' => $row['km_ma'],
            'nsx_ma' => $row['nsx_ma'],
            'nsx_ten' => $row['nsx_ten']
        );
    }
    ?>
    <div class="container mt-5 main-table">
        <a href="create.php" class="btn btn-primary mt-4 mb-3">
            Thêm mới
        </a>
        <table class="table table-bordered table-hover mt-2 text-center" id="tblDanhsach" border="1">
            <thead class="thead-dark">
                <tr>
                    <th>Mã Sản phẩm</th>
                    <th>Tên Sản phẩm</th>
                    <th>Hình Sản phẩm</th>
                    <th>Hình Sản phẩm chi tiết</th>
                    <th>Giá</th>
                    <th>Giá cũ</th>
                    <th>Ngày cập nhật</th>
                    <th>Loại sản phẩm</th>
                    <th>Nhà sản xuất</th>
                    <th>Khuyến Mãi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataTablet as $data) : ?>
                    <tr>
                        <td><?= $data['sp_ma'] ?></td>
                        <td><?= $data['sp_ten'] ?></td>
                        <td style="width:500px">
                            <img src="/nguyenanhthoai/fontend/images/tablet/<?= $data['sp_hinh']; ?> " class="img-fluid" style="width:100px; height:70px;">
                        </td>
                        <td style="width:500px">
                            <img src="/nguyenanhthoai/fontend/images/tablet/<?= $data['sp_hinhchitiet']; ?> " class="img-fluid" style="width:100px; height:70px;">
                        </td>
                        <td><?= number_format($data['sp_gia'], 0, ".", ",") . '(vnđ)'; ?></td>
                        <td>
                            <?php
                            if ($data['sp_giacu'] > 0) {
                                echo number_format($data['sp_giacu'], 0, ".", ",") . '(vnđ)';
                            }
                            ?>
                        </td>
                        <td><?= $data['sp_ngaycapnhat'] ?></td>
                        <td><?= $data['lsp_ten'] ?></td>
                        <td><?= $data['nsx_ten'] ?></td>
                        <td><?= $data['km_ten'] ?></td>
                        <td>
                            <a href="edit.php?sp_ma=<?= $data['sp_ma'] ?>" class="btn btn-warning btnSua">
                                Sửa
                            </a>
                            <button onclick="deleteSanPham(<?= $data['sp_ma'] ?>)" class="btn btn-danger btnDelete" data-sp_ma="<?= $data['sp_ma'] ?>">Xóa</button>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- End block content -->
    </div>

    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
</body>
<script src="/nguyenanhthoai/assets/vendor/DataTables/datatables.min.js"></script>
<script src="/nguyenanhthoai/assets/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
<script src="/nguyenanhthoai/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.js"></script>
<script src="/nguyenanhthoai/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="/nguyenanhthoai/assets/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('#tblDanhsach').DataTable({
        // dom: 'Blfrtip',
        // buttons: [
        //     'copy', 'excel', 'pdf'
        // ],
        "language": {
            "decimal": "",
            "emptyTable": "No data available in table",
            "info": "Hiển thị dòng _START_ đến dòng _END_, tổng cộng có _TOTAL_ dòng",
            "infoEmpty": "Hiện chưa có dữ liệu",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Hiện _MENU_ dòng",
            "loadingRecords": "Loading...",
            "processing": "Processing...",
            "search": "Search:",
            "zeroRecords": "No matching records found",
            "paginate": {
                "first": "Trang Đầu",
                "last": "Trang Cuối",
                "next": "Trang Sau",
                "previous": "Trang Trước"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });


    function deleteSanPham(sp_ma)
    {
        swal({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // var sp_ma = $(this).data('sp_ma');
                    var url = "delete.php?sp_ma=" + sp_ma;   
                    location.href = url;
                
                } else {
                    swal("Cẩn thận hơn nhé!");
                }
            });
    }

</script>

</html>