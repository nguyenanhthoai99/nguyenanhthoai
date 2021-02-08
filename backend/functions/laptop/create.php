<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm Laptop</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link href="/nguyenanhthoai/assets/vendor/DataTables/datatables.css" type="text/css" rel="stylesheet" />
    <link href="/nguyenanhthoai/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet" />
    <?php include_once(__DIR__ . '/../../layouts/partials/config.php'); ?>
</head>


<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container" style="margin-top: 80px;">
        <h2>Thêm Laptop</h2>
        <?php
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sqlLoaiSanPham = "SELECT * FROM loaisanpham";
        $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
        $dataLoaiSanPham = [];
        while ($rowLoaiSanPham = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
            $dataLoaiSanPham[] = array(
                'lsp_ten' => $rowLoaiSanPham['lsp_ten'],
                'lsp_ma' => $rowLoaiSanPham['lsp_ma']
            );
        }
        $sqlNhaSanXuat = "SELECT * FROM nhasanxuat";
        $resultNhaSanXuat = mysqli_query($conn, $sqlNhaSanXuat);
        $dataNhaSanXuat = [];
        while ($rowNhaSanXuat = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)) {
            $dataNhaSanXuat[] = array(
                'nsx_ten' => $rowNhaSanXuat['nsx_ten'],
                'nsx_ma' => $rowNhaSanXuat['nsx_ma']
            );
        }

        $sqlKhuyenMai = "SELECT * FROM khuyenmai";
        $resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);
        $dataKhuyenMai = [];
        while ($rowKhuyenMai = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
            $km_tomtat = '';
            if (!empty($rowKhuyenMai['km_ten'])) {

                if ($rowKhuyenMai['km_ma'] != 0) {
                    $km_tomtat = sprintf(
                        "Khuyến mãi: %s, nội dung: %s, thời gian: %s",
                        $rowKhuyenMai['km_ten'],
                        $rowKhuyenMai['km_noidung'],
                        $rowKhuyenMai['km_qua']

                    );
                } else {
                    $km_tomtat = sprintf(
                        "Khuyến mãi: %s",
                        $rowKhuyenMai['km_ten']
                    );
                }
            }
            $dataKhuyenMai[] = array(
                'km_ma' => $rowKhuyenMai['km_ma'],
                'km_tomtat' => $km_tomtat,
            );
        }

        $sqlLapTop = "SELECT * FROM laptop";
        $resultLapTop = mysqli_query($conn, $sqlLapTop);
        $dataDienthoai = [];
        while ($rowLapTop = mysqli_fetch_array($resultLapTop, MYSQLI_ASSOC)) {
            $dataDienthoai[] = array(
                'laptop_ten' => $rowLapTop['laptop_ten'],
                'laptop_cpu' => $rowLapTop['laptop_cpu'],
                'laptop_ram' => $rowLapTop['laptop_ram'],
                'laptop_ocung' => $rowLapTop['laptop_ocung'],
                'laptop_manhinh' => $rowLapTop['laptop_manhinh'],
                'laptop_cardmanhinh' => $rowLapTop['laptop_cardmanhinh'],
                'laptop_congketnoi' => $rowLapTop['laptop_congketnoi'],
                'laptop_hedieuhanh' => $rowLapTop['laptop_hedieuhanh'],
                'laptop_thietke' => $rowLapTop['laptop_thietke'],
                'laptop_kichthuoc' => $rowLapTop['laptop_kichthuoc'],
                'laptop_ramat' => $rowLapTop['laptop_ramat']

            );
        }
        ?>
        <form name="frmsanpham" id="frmsanpham" method="post" action="" class="mt-1" enctype="multipart/form-data">
            <div class="form-group">
                <?php
                if (isset($_POST["btnSave"])) {
                    $loi = kiemTraLoi();
                    if ($loi)
                        echo "<div style='background-color: #D88383; color: white;'>" . $loi . "</div>";
                }
                ?>
                <label for="sp_ten">Tên Sản phẩm Laptop</label>
                <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm Laptop" value="">
            </div>
            <div class="form-group">
                <img src="/nguyenanhthoai/fontend/images/demo/default-png-5-png-image-default-png-1200_800.png" id="hinhDemo" name="hinhDemo" width="300px" height="300px">
            </div>
            <div class="form-group">
                <label for="sp_hinh">Hình Laptop Đại Diện</label>
                <input type="file" class="form-control" id="sp_hinh" name="sp_hinh" placeholder="Hình Laptop Đại Diện" onchange="showHinh()">
            </div>

            <div class="form-group">
                <img src="/nguyenanhthoai/fontend/images/demo/default-png-5-png-image-default-png-1200_800.png" id="hinhDemoChiTiet" name="hinhDemoChiTiet" width="300px" height="300px">
            </div>
            <div class="form-group">
                <label for="sp_hinhchitiet">Hình Sản Phẩm Laptop</label>
                <input type="file" class="form-control" id="sp_hinhchitiet" name="sp_hinhchitiet" placeholder="Hình Sản Phẩm Laptop chi tiết" onchange="showHinh()">
            </div>
            <div class="form-group">
                <label for="sp_gia">Giá Sản phẩm</label>
                <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm (VNĐ)" value="">
            </div>
            <div class="form-group">
                <label for="sp_giacu">Giá cũ Sản phẩm</label>
                <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm (VNĐ)" value="">
            </div>
            <div class="form-group">
                <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm (VD:2020-09-20)" value="" readonly>
            </div>
            <div class="form-group">
                <label for="sp_soluong">Số lượng</label>
                <input type="text" class="form-control" id="sp_soluong" name="sp_soluong" placeholder="Số lượng Sản phẩm" value="1">
            </div>
            <div class="form-group">
                <label for="nsx_ma">Nhà sản xuất</label>
                <select class="form-control" id="nsx_ma" name="nsx_ma">
                    <?php foreach ($dataNhaSanXuat as $nhasanxuat) : ?>
                        <option value="<?= $nhasanxuat['nsx_ma'] ?>"><?= $nhasanxuat['nsx_ten'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="laptop_ten">CPU</label>
                <input type="text" class="form-control" id="laptop_cpu" name="laptop_cpu" placeholder="CPU Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_ram">RAM</label>
                <input type="text" class="form-control" id="laptop_ram" name="laptop_ram" placeholder="RAM Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_ocung">Ổ cứng</label>
                <input type="text" class="form-control" id="laptop_ocung" name="laptop_ocung" placeholder="Ổ cứng Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_manhinh">Màn hình</label>
                <input type="text" class="form-control" id="laptop_manhinh" name="laptop_manhinh" placeholder="Màn hình Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_cardmanhinh">Card màn hình</label>
                <input type="text" class="form-control" id="laptop_cardmanhinh" name="laptop_cardmanhinh" placeholder="Card màn hình Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_congketnoi">Cổng kết nối</label>
                <input type="text" class="form-control" id="laptop_congketnoi" name="laptop_congketnoi" placeholder="Cổng kết nối Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_hedieuhanh">Hệ điều hành</label>
                <input type="text" class="form-control" id="laptop_hedieuhanh" name="laptop_hedieuhanh" placeholder="Hệ điều hành Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_thietke">Thiết kế</label>
                <input type="text" class="form-control" id="laptop_thietke" name="laptop_thietke" placeholder="Thiết kế Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_kichthuoc">Kích thước</label>
                <input type="text" class="form-control" id="laptop_kichthuoc" name="laptop_kichthuoc" placeholder="Kích thước Laptop" value="">
            </div>
            <div class="form-group">
                <label for="laptop_ramat">Thời điểm ra mắt</label>
                <input type="text" class="form-control" id="laptop_ramat" name="laptop_ramat" placeholder="Thời điểm ra mắt Laptop" value="">
            </div>
            <div class="form-group">
                <label for="km_ma">Khuyến mãi</label>
                <select class="form-control" id="km_ma" name="km_ma">
                    <?php foreach ($dataKhuyenMai as $dataKhuyenMai) : ?>
                        <option value="<?= $dataKhuyenMai['km_ma'] ?>"><?= $dataKhuyenMai['km_tomtat'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <button class="btn btn-primary btn-lg btn-block" name="btnSave">Lưu dữ liệu</button>
                </div>
                <div class="col-md-7 text-right">
                    <a href="index.php"><button type="button" class="btn btn-info btn-md">Quay Về</button></a>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['btnSave'])) {
            $loi = kiemTraLoi();
            if ($loi) {
                return;
            }

            $sp_ten = htmlentities($_POST["sp_ten"]);
            $sp_giacu = htmlentities($_POST["sp_giacu"]);
            $sp_gia = htmlentities($_POST["sp_gia"]);
            $sp_soluong = htmlentities($_POST["sp_soluong"]); 
            $laptop_cpu = htmlentities($_POST["laptop_cpu"]);
            $laptop_ram = htmlentities($_POST["laptop_ram"]);
            $laptop_ocung = htmlentities($_POST["laptop_ocung"]);
            $laptop_manhinh = htmlentities($_POST["laptop_manhinh"]);
            $laptop_cardmanhinh = htmlentities($_POST["laptop_cardmanhinh"]);
            $laptop_congketnoi = htmlentities($_POST["laptop_congketnoi"]);
            $laptop_hedieuhanh = htmlentities($_POST["laptop_hedieuhanh"]);
            $laptop_thietke = htmlentities($_POST["laptop_thietke"]);
            $laptop_kichthuoc = htmlentities($_POST["laptop_kichthuoc"]);
            $laptop_ramat = htmlentities($_POST["laptop_ramat"]);
            $lsp_ma =  2;
            
            if (isset($_FILES['sp_hinh'])) {
                $upload_dir = __DIR__ . "/../../../fontend/images/laptop/";

                if ($_FILES['sp_hinh']['error'] > 0) {
                    die;
                } else {
                    $sp_hinh = $_FILES['sp_hinh']['name'];
                    $tentaptin_hinh = date('YdmHis') . '_' . $sp_hinh;
                    move_uploaded_file($_FILES['sp_hinh']['tmp_name'], $upload_dir . $tentaptin_hinh);
                }
            }


            if (isset($_FILES['sp_hinhchitiet'])) {
                $upload_dir = __DIR__ . "/../../../fontend/images/laptop/";

                if ($_FILES['sp_hinhchitiet']['error'] > 0) {
                    die;
                } else {
                    $sp_hinhchitiet = $_FILES['sp_hinhchitiet']['name'];
                    $tentaptin_hinhchitiet = date('YdmHis') . '_' . $sp_hinhchitiet;
                    move_uploaded_file($_FILES['sp_hinhchitiet']['tmp_name'], $upload_dir . $tentaptin_hinhchitiet);
                }
            }

            $sqlLapTop = "INSERT INTO laptop (laptop_cpu, laptop_ten, laptop_ram, laptop_ocung, laptop_manhinh, laptop_cardmanhinh, laptop_congketnoi, laptop_hedieuhanh, laptop_thietke, laptop_kichthuoc, laptop_ramat)
            VALUES ('$laptop_cpu', '$sp_ten', '$laptop_ram', '$laptop_ocung', '$laptop_manhinh', '$laptop_cardmanhinh', '$laptop_congketnoi', '$laptop_hedieuhanh', '$laptop_thietke', '$laptop_kichthuoc', '$laptop_ramat')";
            // print_r($sqlLapTop);
            // die;
            mysqli_query($conn, $sqlLapTop);

            $last_id = $conn->insert_id;
            $sqlSanPham = "INSERT INTO sanpham
            (sp_ten, sp_gia, sp_giacu, sp_soluong, sp_ngaycapnhat, lsp_ma, nsx_ma, sp_hinh, sp_hinhchitiet, km_ma, laptop_ma)
            VALUES ('$sp_ten', $sp_gia, $sp_giacu, $sp_soluong, '$sp_ngaycapnhat', $lsp_ma, $nsx_ma, '$tentaptin_hinh', '$tentaptin_hinhchitiet', $km_ma, $last_id)";

            // print_r($sqlSanPham);
            // die;
            mysqli_query($conn, $sqlSanPham);

            mysqli_close($conn);
            echo "<script>alert('Bạn Thêm sản phẩm thành công')</script>";
            echo "<script>location.href = 'index.php';</script>";
        }
        ?>
    </div>

    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
</body>

</html>

<script>
    $(function() {
        var date = new Date();
        var outputDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        $("#sp_ngaycapnhat").val(outputDate);
    });

    document.getElementById('sp_hinh').onchange = function(evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function() {
                document.getElementById("hinhDemo").src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        } else {

        }
    }

    document.getElementById('sp_hinhchitiet').onchange = function(evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function() {
                document.getElementById("hinhDemoChiTiet").src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        } else {

        }
    }
</script>

<?php

function kiemTraLoi()
{
    $loi = "";
    $sp_ten = $_POST["sp_ten"];
    $sp_giacu = $_POST["sp_giacu"];
    $sp_gia = $_POST["sp_gia"];
    // $sp_hinh = $_POST["sp_hinh"];
    // $sp_hinhchitiet = $_POST["sp_hinhchitiet"];
    // $sp_ngaycapnhat = $_POST["sp_ngaycapnhat"];
    // $sp_soluong = $_POST["sp_soluong"];
    // $nsx_ma = $_POST["nsx_ma"];
    $laptop_cpu = $_POST["laptop_cpu"];
    $laptop_ram = $_POST["laptop_ram"];
    $laptop_ocung = $_POST["laptop_ocung"];
    $laptop_manhinh = $_POST["laptop_manhinh"];
    $laptop_cardmanhinh = $_POST["laptop_cardmanhinh"];
    $laptop_congketnoi = $_POST["laptop_congketnoi"];
    $laptop_hedieuhanh = $_POST["laptop_hedieuhanh"];
    $laptop_thietke = $_POST["laptop_thietke"];
    $laptop_kichthuoc = $_POST["laptop_kichthuoc"];
    $laptop_ramat = $_POST["laptop_ramat"];


    if (empty($sp_ten)) {
        $loi .= "Tên Sản Phẩm không được rỗng <br>";
    } else {
        if (strlen($sp_ten) < 3) {
            $loi .= "Tên Sản Phẩm không được ít hơn 3 ký tự <br>";
        }
        if (strlen($sp_ten) > 30) {
            $loi .= "Tên Sản Phẩm  không được vượt quá 30 ký tự <br>";
        }
    }

    if (empty($sp_gia)) {
        $loi .= "Giá Sản Phẩm không được rỗng <br>";
    } else {
        if (($sp_gia < 0)) {
            $loi .= "Giá Sản Phẩm không được âm <br>";
        } else {
            if (strlen($sp_gia) < 3) {
                $loi .= "Giá Sản Phẩm không được ít hơn 3 ký tự <br>";
            }
            if (strlen($sp_gia) > 30) {
                $loi .= "Giá Sản Phẩm không được vượt quá 30 ký tự <br>";
            }
        }
    }

    if (empty($sp_giacu)) {
        $loi .= "Giá Sản Cũ Phẩm không được rỗng <br>";
    } else {
        if (($sp_giacu < 0)) {
            $loi .= "Giá Sản Cũ Phẩm không được âm <br>";
        } else {
            if (strlen($sp_giacu) < 3) {
                $loi .= "Giá Sản Cũ Phẩm không được ít hơn 3 ký tự <br>";
            }
            if (strlen($sp_giacu) > 30) {
                $loi .= "Giá Sản Cũ Phẩm không được vượt quá 30 ký tự <br>";
            }
        }
    }
    if (($_FILES['sp_hinh']['error'] > 0)) {
        $loi .= "File hình sản phẩm đại diện không được rỗng <br>";
    } else {
        if (!($_FILES['sp_hinh']['type'] == "image/png" || $_FILES['sp_hinh']['type'] == "image/jpeg" || $_FILES['sp_hinh']['type'] == "image/gif" || $_FILES['sp_hinh']['type'] == "image/jpg" || $_FILES['sp_hinh']['type'] == "image/PSD" || $_FILES['sp_hinh']['type'] == "image/PDF")) {
            $loi .= "File hình sản phẩm đại diện phải là file ảnh <br>";
        } else {
            if ($_FILES['sp_hinh']['size'] > 25600) {
                $loi .= "File hình sản phẩm đại diện không vượt quá 25mb <br>";
            }
        }
    }

    if (($_FILES['sp_hinhchitiet']['error'] > 0)) {
        $loi .= "File hình sản phẩm chi tiết không được rỗng <br>";
    } else {
        if (!($_FILES['sp_hinhchitiet']['type'] == "image/png" || $_FILES['sp_hinhchitiet']['type'] == "image/jpeg" || $_FILES['sp_hinhchitiet']['type'] == "image/gif" || $_FILES['sp_hinhchitiet']['type'] == "image/jpg" || $_FILES['sp_hinhchitiet']['type'] == "image/PSD" || $_FILES['sp_hinhchitiet']['type'] == "image/PDF")) {
            $loi .= "File hình sản phẩm chi tiết phải là file ảnh <br>";
        } else {
            if ($_FILES['sp_hinhchitiet']['size'] > 25600) {
                $loi .= "File hình sản phẩm chi tiết không vượt quá 25mb <br>";
            }
        }
    }

    if (empty($laptop_cpu)) {
        $loi .= "CPU laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_cpu) < 3) {
            $loi .= "CPU laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_cpu) > 50) {
            $loi .= "CPU laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_ram)) {
        $loi .= "Ram Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_ram) < 3) {
            $loi .= "Ram Laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_ram) > 50) {
            $loi .= "Ram Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_ocung)) {
        $loi .= "Ổ cứng Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_ocung) < 2) {
            $loi .= "Ổ cứng Laptop không được ít hơn 2 ký tự <br>";
        }
        if (strlen($laptop_ocung) > 50) {
            $loi .= "Ổ cứng Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_manhinh)) {
        $loi .= "Màn hình Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_manhinh) < 2) {
            $loi .= "Màn hình Laptop không được ít hơn 2 ký tự <br>";
        }
        if (strlen($laptop_manhinh) > 50) {
            $loi .= "Màn hình Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_cardmanhinh)) {
        $loi .= "Card màn hình Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_cardmanhinh) < 2) {
            $loi .= "Card màn hình Laptop không được ít hơn 2 ký tự <br>";
        }
        if (strlen($laptop_cardmanhinh) > 50) {
            $loi .= "Card màn hình Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_congketnoi)) {
        $loi .= "Cổng kết nối Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_congketnoi) < 3) {
            $loi .= "Cổng kết nối Laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_congketnoi) > 50) {
            $loi .= "Cổng kết nối Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_hedieuhanh)) {
        $loi .= "Hệ điểu hành Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_hedieuhanh) < 2) {
            $loi .= "Hệ điểu hành Laptop không được ít hơn 2 ký tự <br>";
        }
        if (strlen($laptop_hedieuhanh) > 50) {
            $loi .= "Hệ điểu hành Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_thietke)) {
        $loi .= "Thiết kế Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_thietke) < 2) {
            $loi .= "Thiết kế Laptop không được ít hơn 2 ký tự <br>";
        }
        if (strlen($laptop_thietke) > 50) {
            $loi .= "Thiết kế Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_kichthuoc)) {
        $loi .= "Kích thước Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_kichthuoc) < 3) {
            $loi .= "Kích thước Laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_kichthuoc) > 50) {
            $loi .= "Kích thước Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_ramat)) {
        $loi .= "Thời ra mắt Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_ramat) < 3) {
            $loi .= "Thời ra mắt Laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_ramat) > 50) {
            $loi .= "Thời ra mắt Laptop không được vượt quá 50 ký tự <br>";
        }
    }


    return $loi;
}

?>