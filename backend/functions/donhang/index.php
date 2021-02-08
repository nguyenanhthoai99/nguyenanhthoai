<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Giỏ Hàng</title>
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
    SELECT dh.dh_ma, dh.kh_ten, dh.dh_diachi, dh.dh_soluongmua, dh.dh_gia, dh.dh_thanhtien, dh.dh_ngaylap, sp.sp_ten
    FROM donhang AS dh
    JOIN sanpham AS sp ON sp.sp_ma = dh.dh_ma
OTE;

    $result  = mysqli_query($conn, $sql);
    $dataDonHang = [];
    while ($row  = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $dataDonHang[] = array(
            'dh_ma' => $row['dh_ma'],
            'kh_ten' => $row['kh_ten'],
            'dh_diachi' => $row['dh_diachi'],
            'dh_soluongmua' => $row['dh_soluongmua'],
            'dh_gia' => $row['dh_gia'],
            'dh_thanhtien' => $row['dh_thanhtien'],
            'dh_ngaylap' => $row['dh_ngaylap'],
            'sp_ten' => $row['sp_ten']
            
        );
    }

    ?>
    <div class="container   main-table" style="margin-top:100px">
        <table class="table table-bordered table-hover text-center" id="tblDanhsach" border="1" >
            <thead class="thead-dark">
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Tên Khách Hàng</th>
                    <th>Địa Chỉ Khách Hàng</th>
                    <th>Tên Sản phẩm</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Thành tiền</th>
                    <th>Ngày Lập</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataDonHang as $data) : ?>
                    <tr>
                        <td><?= $data['dh_ma'] ?></td>
                        <td><?= $data['kh_ten'] ?></td>
                        <td><?= $data['dh_diachi'] ?></td>
                        <td><?= $data['sp_ten'] ?></td>
                        <td><?= $data['dh_soluongmua'] ?></td>
                        <td><?= number_format($data['dh_gia'], 0, ".", ",") . '(vnđ)'; ?></td>
                        <td><?= number_format($data['dh_thanhtien'], 0, ".", ",") . '(vnđ)'; ?></td>
                        <td><?= $data['dh_ngaylap'] ?></td>
                        <td>
                            <button onclick="deleteSanPham(<?= $data['dh_ma'] ?>)" class="btn btn-danger btnDelete" data-dh_ma="<?= $data['dh_ma'] ?>">Xóa</button>                        
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


    function deleteSanPham(dh_ma)
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
                    var url = "delete.php?dh_ma=" + dh_ma;   
                    location.href = url;
                
                } else {
                    swal("Cẩn thận hơn nhé!");
                }
            });
    }

</script>

</html>