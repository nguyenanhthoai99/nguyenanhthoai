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
        <h2>Cập Nhật Điện Thoại</h2>
        <?php
        include_once(__DIR__ . '/../../../dbconnect.php');

        $sp_ma = $_GET['sp_ma'];
        $sqlSanPham = "SELECT * FROM sanpham WHERE sp_ma = $sp_ma";
        $resultSanPham = mysqli_query($conn, $sqlSanPham);
        $dataSanPham = [];
        while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
            $dataSanPham[] = array(
                'sp_ma' => $rowSanPham['sp_ma'],
                'sp_ten' => $rowSanPham['sp_ten'],
                'sp_gia' => $rowSanPham['sp_gia'],
                'sp_giacu' => $rowSanPham['sp_giacu'],
                'sp_soluong' => $rowSanPham['sp_soluong'],
                'sp_ngaycapnhat' => $rowSanPham['sp_ngaycapnhat'],
                'nsx_ma' => $rowSanPham['nsx_ma'],
                'sp_hinh' => $rowSanPham['sp_hinh'],
                'sp_hinhchitiet' => $rowSanPham['sp_hinhchitiet'],
                'laptop_ma' => $rowSanPham['laptop_ma'],
                'km_ma' => $rowSanPham['km_ma']


            );
        }
        $dataSanPham = $dataSanPham[0];

        $sqlNhaSanXuat = "SELECT * FROM nhasanxuat";
        $resultNhaSanXuat = mysqli_query($conn, $sqlNhaSanXuat);
        $dataNhaSanXuat = [];
        while ($rowNhaSanXuat = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)) {
            $dataNhaSanXuat[] = array(
                'nsx_ten' => $rowNhaSanXuat['nsx_ten'],
                'nsx_ma' => $rowNhaSanXuat['nsx_ma']
            );
        }

        $sqlLoaiSanPham = "SELECT * FROM loaisanpham";
        $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
        $dataLoaiSanPham = [];
        while ($rowLoaiSanPham = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
            $dataLoaiSanPham[] = array(
                'lsp_ten' => $rowLoaiSanPham['lsp_ten'],
                'lsp_ma' => $rowLoaiSanPham['lsp_ma']
            );
        }

        $sqlKhuyenMai = "SELECT * FROM khuyenmai ";
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

        $sqlLapTop = "SELECT * FROM laptop WHERE laptop_ma =" . $dataSanPham['laptop_ma'];
        $resultLapTop = mysqli_query($conn, $sqlLapTop);
        $dataLapTop = [];
        while ($rowLapTop = mysqli_fetch_array($resultLapTop, MYSQLI_ASSOC)) {
            $dataLapTop[] = array(
                'laptop_cpu' => $rowLapTop['laptop_cpu'],
                // 'dt_ten' => $rowLapTop['dt_ten'],
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
        $dataLapTop = $dataLapTop[0];
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
                <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm Laptop" value="<?= $dataSanPham['sp_ten'] ?>">
            </div>
            <div class="form-group">
                <img src="/nguyenanhthoai/fontend/images/laptop/<?= $dataSanPham['sp_hinh'] ?>" id="hinhDemo" name="hinhDemo" width="300px" height="300px">
            </div>
            <div class="form-group">
                <label for="sp_hinh">Hình Laptop Đại Diện</label>
                <input type="file" class="form-control" id="sp_hinh" name="sp_hinh" placeholder="Hình Laptop Đại Diện" onchange="showHinh()">
            </div>

            <div class="form-group">
                <img src="/nguyenanhthoai/fontend/images/laptop/<?= $dataSanPham['sp_hinhchitiet'] ?>" id="hinhDemoChiTiet" name="hinhDemoChiTiet" width="300px" height="300px">
            </div>
            <div class="form-group">
                <label for="sp_hinhchitiet">Hình Sản Phẩm Laptop</label>
                <input type="file" class="form-control" id="sp_hinhchitiet" name="sp_hinhchitiet" placeholder="Hình Sản Phẩm Laptop chi tiết" onchange="showHinh()">
            </div>
            <div class="form-group">
                <label for="sp_gia">Giá Sản phẩm</label>
                <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm (VNĐ)" value="<?= $dataSanPham['sp_gia'] ?>">
            </div>
            <div class="form-group">
                <label for="sp_giacu">Giá cũ Sản phẩm</label>
                <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm (VNĐ)" value="<?= $dataSanPham['sp_giacu'] ?>">
            </div>
            <div class="form-group">
                <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm (VD:2020-09-20 00:00:00)" value="<?= $dataSanPham['sp_ngaycapnhat'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="sp_soluong">Số lượng</label>
                <input type="text" class="form-control" id="sp_soluong" name="sp_soluong" placeholder="Số lượng Sản phẩm" value="<?= $dataSanPham['sp_soluong'] ?>">
            </div>
            <div class="form-group">
                <label for="nsx_ma">Nhà sản xuất</label>
                <select class="form-control" id="nsx_ma" name="nsx_ma">

                    <?php foreach ($dataNhaSanXuat as $nhasanxuat) : ?>
                        <?php if ($nhasanxuat['nsx_ma'] == $dataSanPham['nsx_ma']) : ?>
                            <option value="<?= $nhasanxuat['nsx_ma'] ?>" selected><?= $nhasanxuat['nsx_ten'] ?></option>
                        <?php else : ?>
                            <option value="<?= $nhasanxuat['nsx_ma'] ?>"><?= $nhasanxuat['nsx_ten'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="laptop_cpu">CPU Laptop</label>
                <input type="text" class="form-control" id="laptop_cpu" name="laptop_cpu" placeholder="CPU Laptop" value="<?= $dataLapTop['laptop_cpu'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_ram">RAM Laptop</label>
                <input type="text" class="form-control" id="laptop_ram" name="laptop_ram" placeholder="RAM Laptop" value="<?= $dataLapTop['laptop_ram'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_ocung">Ổ cứng Laptop</label>
                <input type="text" class="form-control" id="laptop_ocung" name="laptop_ocung" placeholder="Ổ cứng Laptop" value="<?= $dataLapTop['laptop_ocung'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_manhinh">Màn hình Laptop</label>
                <input type="text" class="form-control" id="laptop_manhinh" name="laptop_manhinh" placeholder="Màn hình Laptop" value="<?= $dataLapTop['laptop_manhinh'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_cardmanhinh">Card màn hình Laptop</label>
                <input type="text" class="form-control" id="laptop_cardmanhinh" name="laptop_cardmanhinh" placeholder="Card màn hình Laptop" value="<?= $dataLapTop['laptop_cardmanhinh'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_congketnoi">Cổng kết nối Laptop</label>
                <input type="text" class="form-control" id="laptop_congketnoi" name="laptop_congketnoi" placeholder="Cổng kết nối Laptop" value="<?= $dataLapTop['laptop_congketnoi'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_hedieuhanh">Hệ điều hành Laptop</label>
                <input type="text" class="form-control" id="laptop_hedieuhanh" name="laptop_hedieuhanh" placeholder="Hệ điều hành Laptop" value="<?= $dataLapTop['laptop_hedieuhanh'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_thietke">Thiết kế Laptop</label>
                <input type="text" class="form-control" id="laptop_thietke" name="laptop_thietke" placeholder="Thiết kế Laptop" value="<?= $dataLapTop['laptop_thietke'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_kichthuoc">Kích thước Laptop</label>
                <input type="text" class="form-control" id="laptop_kichthuoc" name="laptop_kichthuoc" placeholder="Kích thước Laptop" value="<?= $dataLapTop['laptop_kichthuoc'] ?>">
            </div>
            <div class="form-group">
                <label for="laptop_ramat">Thời gian ra mắt Laptop</label>
                <input type="text" class="form-control" id="laptop_ramat" name="laptop_ramat" placeholder="Thời gian ra mắt Laptop" value="<?= $dataLapTop['laptop_ramat'] ?>">
            </div>
            <div class="form-group">
                <label for="km_ma">Khuyến mãi</label>
                <select class="form-control" id="km_ma" name="km_ma">
                    <?php foreach ($dataKhuyenMai as $khuyenmai) : ?>
                        <?php if ($khuyenmai['km_ma'] == $dataSanPham['km_ma']) : ?>
                            <option value="<?= $khuyenmai['km_ma'] ?>" selected><?= $khuyenmai['km_tomtat'] ?></option>
                        <?php else : ?>
                            <option value="<?= $khuyenmai['km_ma'] ?>"><?= $khuyenmai['km_tomtat'] ?></option>
                        <?php endif; ?>
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
        
            if (isset($_FILES['sp_hinh'])) {
                $upload_dir_sp_hinh = __DIR__ . "/../../../fontend/images/laptop/";
                if ($_FILES['sp_hinh']['name'] == null) {
                    $tentaptin_hinh = $dataSanPham['sp_hinh'];
                } else {

                    $old_file_sp_hinh = $upload_dir_sp_hinh . $dataSanPham['sp_hinh'];
                    if (file_exists($old_file_sp_hinh)) {
                        unlink($old_file_sp_hinh);
                    }

                    $sp_hinh = $_FILES['sp_hinh']['name'];
                    $tentaptin_hinh = date('YdmHis') . '_' . $sp_hinh;
                    move_uploaded_file($_FILES['sp_hinh']['tmp_name'], $upload_dir_sp_hinh . $tentaptin_hinh);
                }
            }


            if (isset($_FILES['sp_hinhchitiet'])) {
                $upload_dir_sp_hinhChiTiet = __DIR__ . "/../../../fontend/images/laptop/";

                if ($_FILES['sp_hinhchitiet']['name'] == null) {
                    $tentaptin_hinhchitiet = $dataSanPham['sp_hinhchitiet'];
                } else {
                    $old_file_sp_hinhChiTiet = $upload_dir_sp_hinhChiTiet . $dataSanPham['sp_hinhchitiet'];
                    if (file_exists($old_file_sp_hinhChiTiet)) {
                        unlink($old_file_sp_hinhChiTiet);
                    }

                    $sp_hinhchitiet = $_FILES['sp_hinhchitiet']['name'];
                    $tentaptin_hinhchitiet = date('YdmHis') . '_' . $sp_hinhchitiet;
                    move_uploaded_file($_FILES['sp_hinhchitiet']['tmp_name'], $upload_dir_sp_hinhChiTiet . $tentaptin_hinhchitiet);
                }
            }


            $sqlLapTop = "UPDATE laptop SET laptop_ten = '$sp_ten', laptop_cpu =' $laptop_cpu', laptop_ram = '$laptop_ram', laptop_ocung ='$laptop_ocung', laptop_manhinh = '$laptop_manhinh',laptop_cardmanhinh = '$laptop_cardmanhinh', laptop_congketnoi = '$laptop_congketnoi', laptop_hedieuhanh = '$laptop_hedieuhanh', laptop_thietke = '$laptop_thietke', laptop_kichthuoc = '$laptop_kichthuoc', laptop_ramat = '$laptop_ramat' WHERE laptop_ma =" . $dataSanPham['laptop_ma'];

            // print_r($sqlLapTop);
            // die;
            mysqli_query($conn, $sqlLapTop);

            $sqlSanPham = "UPDATE sanpham SET sp_ten = '$sp_ten', sp_gia = $sp_gia, sp_giacu = $sp_giacu, sp_soluong = $sp_soluong,	sp_ngaycapnhat= NOW(), nsx_ma = $nsx_ma, sp_hinh='$tentaptin_hinh', sp_hinhchitiet='$tentaptin_hinhchitiet', km_ma = $km_ma WHERE sp_ma =" . $sp_ma;
            // print_r($sqlSanPham);
            // die;
            mysqli_query($conn, $sqlSanPham);

            mysqli_close($conn);
            echo "<script>alert('Bạn cập nhật sản phẩm thành công')</script>";
            echo "<script>location.href = 'index.php';</script>";
        }
        ?>
    </div>

    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
</body>

</html>

<script>
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
    // global $dataLapTop;
    $loi = "";
    $sp_ten = $_POST["sp_ten"];
    $sp_giacu = $_POST["sp_giacu"];
    $sp_gia = $_POST["sp_gia"];
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

    if (($_FILES['sp_hinh']['name']) != NULL) {
        if (!($_FILES['sp_hinh']['type'] == "image/png" || $_FILES['sp_hinh']['type'] == "image/jpeg" || $_FILES['sp_hinh']['type'] == "image/gif" || $_FILES['sp_hinh']['type'] == "image/jpg" || $_FILES['sp_hinh']['type'] == "image/PSD" || $_FILES['sp_hinh']['type'] == "image/PDF")) {
            $loi .= "File hình sản phẩm đại diện phải là file ảnh <br>";
        } else {
            if ($_FILES['sp_hinh']['size'] > 25600) {
                $loi .= "File hình sản phẩm đại diện không vượt quá 25mb <br>";
            }
        }
    }

    if (($_FILES['sp_hinhchitiet']['name']) != NULL) {
        if (!($_FILES['sp_hinhchitiet']['type'] == "image/png" || $_FILES['sp_hinhchitiet']['type'] == "image/jpeg" || $_FILES['sp_hinhchitiet']['type'] == "image/gif" || $_FILES['sp_hinhchitiet']['type'] == "image/jpg" || $_FILES['sp_hinhchitiet']['type'] == "image/PSD" || $_FILES['sp_hinhchitiet']['type'] == "image/PDF")) {
            $loi .= "File hình sản phẩm chi tiết phải là file ảnh <br>";
        } else {
            if ($_FILES['sp_hinhchitiet']['size'] > 25600) {
                $loi .= "File hình sản phẩm chi tiết không vượt quá 25mb <br>";
            }
        }
    }




    if (empty($laptop_cpu)) {
        $loi .= "CPU Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_cpu) < 3) {
            $loi .= "CPU Laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_cpu) > 50) {
            $loi .= "CPU Laptop không được vượt quá 50 ký tự <br>";
        }
    }



    if (empty($laptop_ram)) {
        $loi .= "RAM Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_ram) < 3) {
            $loi .= "RAM Laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_ram) > 50) {
            $loi .= "RAM Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_ocung)) {
        $loi .= "Ổ cứng Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_ocung) < 2) {
            $loi .= "Ổ cứng Laptop  không được ít hơn 2 ký tự <br>";
        }
        if (strlen($laptop_ocung) > 50) {
            $loi .= "Ổ cứng Laptop  không được vượt quá 50 ký tự <br>";
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
        $loi .= "Hệ điều hành Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_hedieuhanh) < 2) {
            $loi .= "Hệ điều hành Laptop không được ít hơn 2 ký tự <br>";
        }
        if (strlen($laptop_hedieuhanh) > 50) {
            $loi .= "Hệ điều hành Laptopkhông được vượt quá 50 ký tự <br>";
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
            $loi .= "SKích thước Laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_kichthuoc) > 50) {
            $loi .= "Kích thước Laptop không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($laptop_ramat)) {
        $loi .= "Thời gian ra mắt Laptop không được rỗng <br>";
    } else {
        if (strlen($laptop_ramat) < 3) {
            $loi .= "Thời gian ra mắt Laptop không được ít hơn 3 ký tự <br>";
        }
        if (strlen($laptop_ramat) > 50) {
            $loi .= "Thời gian ra mắt Laptop không được vượt quá 50 ký tự <br>";
        }
    }


    return $loi;
}

?>