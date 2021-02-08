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
    <title>Cập nhật Sản Phẩm Tablet</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link href="/nguyenanhthoai/assets/vendor/DataTables/datatables.css" type="text/css" rel="stylesheet" />
    <link href="/nguyenanhthoai/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet" />
    <?php include_once(__DIR__ . '/../../layouts/partials/config.php'); ?>
</head>


<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container" style="margin-top: 80px;">
        <h2>Cập Nhật Tablet</h2>
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
                'tablet_ma' => $rowSanPham['tablet_ma'],
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
        $sqlTablet = "SELECT * FROM tablet WHERE tablet_ma =" . $dataSanPham['tablet_ma'];
        $resultTablet = mysqli_query($conn, $sqlTablet);
        $dataTablet = [];
        while ($rowTablet = mysqli_fetch_array($resultTablet, MYSQLI_ASSOC)) {
            $dataTablet[] = array(
                'tablet_manhinh' => $rowTablet['tablet_manhinh'],
                'tablet_ten' => $rowTablet['tablet_ten'],
                'tablet_hedieuhanh' => $rowTablet['tablet_hedieuhanh'],
                'tablet_camerasau' => $rowTablet['tablet_camerasau'],
                'tablet_cameratruoc' => $rowTablet['tablet_cameratruoc'],
                'tablet_cpu' => $rowTablet['tablet_cpu'],
                'tablet_ram' => $rowTablet['tablet_ram'],
                'tablet_ketnoimang' => $rowTablet['tablet_ketnoimang'],
                'tablet_damthoai' => $rowTablet['tablet_damthoai'],
                'tablet_bonhotrong' => $rowTablet['tablet_bonhotrong'],
                'tablet_trongluong' => $rowTablet['tablet_trongluong']

            );
        }
        $dataTablet = $dataTablet[0];
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
                <label for="sp_ten">Tên Sản phẩm Tablet</label>
                <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm Tablet" value="<?= $dataSanPham['sp_ten'] ?>">
            </div>
            <div class="form-group">
                <img src="/nguyenanhthoai/fontend/images/tablet/<?= $dataSanPham['sp_hinh'] ?>" id="hinhDemo" name="hinhDemo" width="300px" height="300px">
            </div>
            <div class="form-group">
                <label for="sp_hinh">Hình Tablet Đại Diện</label>
                <input type="file" class="form-control" id="sp_hinh" name="sp_hinh" placeholder="Hình Tablet Đại Diện" onchange="showHinh()">
            </div>

            <div class="form-group">
                <img src="/nguyenanhthoai/fontend/images/tablet/<?= $dataSanPham['sp_hinhchitiet'] ?>" id="hinhDemoChiTiet" name="hinhDemoChiTiet" width="300px" height="300px">
            </div>
            <div class="form-group">
                <label for="sp_hinhchitiet">Hình Sản Phẩm Tablet</label>
                <input type="file" class="form-control" id="sp_hinhchitiet" name="sp_hinhchitiet" placeholder="Hình Sản Phẩm Chi Tiết Tablet" onchange="showHinh()">
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
                <label for="tablet_manhinh">Màn Hình</label>
                <input type="text" class="form-control" id="tablet_manhinh" name="tablet_manhinh" placeholder="Màn hình Tablet" value="<?= $dataTablet['tablet_manhinh'] ?>">
            </div>
            <div class="form-group">
                <label for="tablet_hedieuhanh">Hệ điều hành</label>
                <input type="text" class="form-control" id="tablet_hedieuhanh" name="tablet_hedieuhanh" placeholder="Hệ điều hành Tablet" value="<?= $dataTablet['tablet_hedieuhanh'] ?>">
            </div>
            <div class="form-group">
                <label for="tablet_cpu">CPU</label>
                <input type="text" class="form-control" id="tablet_cpu" name="tablet_cpu" placeholder="CPU Tablet" value="<?= $dataTablet['tablet_cpu'] ?>">
            </div>
            <div class="form-group">
                <label for="tablet_ram">RAM</label>
                <input type="text" class="form-control" id="tablet_ram" name="tablet_ram" placeholder="RAM Tablet" value="<?= $dataTablet['tablet_ram'] ?>">
            </div>
            <div class="form-group">
                <label for="tablet_bonhotrong">Bộ Nhớ Trong</label>
                <input type="text" class="form-control" id="tablet_bonhotrong" name="tablet_bonhotrong" placeholder="Bộ Nhớ Trong Tablet" value="<?= $dataTablet['tablet_bonhotrong'] ?>">
            </div>
            <div class="form-group">
                <label for="tablet_camerasau">Camera sau</label>
                <input type="text" class="form-control" id="tablet_camerasau" name="tablet_camerasau" placeholder="Camera sau Tablet" value="<?= $dataTablet['tablet_camerasau'] ?>">
            </div>
            <div class="form-group">
                <label for="tablet_cameratruoc">Camera trước</label>
                <input type="text" class="form-control" id="tablet_cameratruoc" name="tablet_cameratruoc" placeholder="Camera trước Tablet" value="<?= $dataTablet['tablet_cameratruoc'] ?>">
            </div>

            <div class="form-group">
                <label for="tablet_ketnoimang">Kết nối mạng</label>
                <input type="text" class="form-control" id="tablet_ketnoimang" name="tablet_ketnoimang" placeholder="Kết nối mạng Tablet" value="<?= $dataTablet['tablet_ketnoimang'] ?>">
            </div>
            <div class="form-group">
                <label for="tablet_damthoai">Thẻ SIM</label>
                <input type="text" class="form-control" id="tablet_damthoai" name="tablet_damthoai" placeholder="Đàm thoại Tablet" value="<?= $dataTablet['tablet_damthoai'] ?>">
            </div>
            <div class="form-group">
                <label for="tablet_trongluong">Trọng lượng</label>
                <input type="text" class="form-control" id="tablet_trongluong" name="tablet_trongluong" placeholder="Trọng lượng Tablet" value="<?= $dataTablet['tablet_trongluong'] ?>">
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
            $sp_ngaycapnhat = htmlentities($_POST["sp_ngaycapnhat"]);
            $sp_soluong = htmlentities($_POST["sp_soluong"]);
            $nsx_ma = htmlentities($_POST["nsx_ma"]);
            $km_ma = htmlentities($_POST["km_ma"]);
            $tablet_manhinh = htmlentities($_POST["tablet_manhinh"]);
            $tablet_hedieuhanh = htmlentities($_POST["tablet_hedieuhanh"]);
            $tablet_camerasau = htmlentities($_POST["tablet_camerasau"]);
            $tablet_cameratruoc = htmlentities($_POST["tablet_cameratruoc"]);
            $tablet_cpu = htmlentities($_POST["tablet_cpu"]);
            $tablet_ram = htmlentities($_POST["tablet_ram"]);
            $tablet_ketnoimang = htmlentities($_POST["tablet_ketnoimang"]);
            $tablet_damthoai = htmlentities($_POST["tablet_damthoai"]);
            $tablet_bonhotrong = htmlentities($_POST["tablet_bonhotrong"]);
            $tablet_trongluong = htmlentities($_POST["tablet_trongluong"]);

            if (isset($_FILES['sp_hinh'])) {
                $upload_dir_sp_hinh = __DIR__ . "/../../../fontend/images/tablet/";
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
                $upload_dir_sp_hinhChiTiet = __DIR__ . "/../../../fontend/images/tablet/";

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




            $sqlTablet = "UPDATE tablet SET tablet_ten='$sp_ten', tablet_manhinh='$tablet_manhinh', tablet_hedieuhanh='$tablet_hedieuhanh',	tablet_camerasau='$tablet_camerasau', tablet_cameratruoc='$tablet_cameratruoc', tablet_cpu='$tablet_cpu', tablet_ram='$tablet_ram', tablet_bonhotrong='$tablet_bonhotrong', tablet_ketnoimang='$tablet_ketnoimang', tablet_damthoai='$tablet_damthoai', tablet_trongluong='$tablet_trongluong' WHERE tablet_ma  =" . $dataSanPham['tablet_ma'];
            // print_r($sqlTablet);
            // die;
            mysqli_query($conn, $sqlTablet);

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
    $loi = "";
    $sp_ten = $_POST["sp_ten"];
    $sp_giacu = $_POST["sp_giacu"];
    $sp_gia = $_POST["sp_gia"];
    $tablet_manhinh = $_POST["tablet_manhinh"];
    $tablet_hedieuhanh = $_POST["tablet_hedieuhanh"];
    $tablet_camerasau = $_POST["tablet_camerasau"];
    $tablet_cameratruoc = $_POST["tablet_cameratruoc"];
    $tablet_cpu = $_POST["tablet_cpu"];
    $tablet_ram = $_POST["tablet_ram"];
    $tablet_bonhotrong = $_POST["tablet_bonhotrong"];
    $tablet_ketnoimang = $_POST["tablet_ketnoimang"];
    $tablet_damthoai = $_POST["tablet_damthoai"];
    $tablet_trongluong = $_POST["tablet_trongluong"];

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


    if (empty($tablet_manhinh)) {
        $loi .= "Màn hình điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_manhinh) < 3) {
            $loi .= "Màn hình điện thoại không được ít hơn 3 ký tự <br>";
        }
        if (strlen($tablet_manhinh) > 50) {
            $loi .= "Màn hình điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_hedieuhanh)) {
        $loi .= "Hệ diều hành điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_hedieuhanh) < 3) {
            $loi .= "Hệ diều hành điện thoạikhông được ít hơn 3 ký tự <br>";
        }
        if (strlen($tablet_hedieuhanh) > 50) {
            $loi .= "Hệ diều hành điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_camerasau)) {
        $loi .= "Camera sau điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_camerasau) < 2) {
            $loi .= "Camera sau điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($tablet_camerasau) > 50) {
            $loi .= "Camera sau điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_cameratruoc)) {
        $loi .= "Camera trước điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_cameratruoc) < 2) {
            $loi .= "Camera trước điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($tablet_cameratruoc) > 50) {
            $loi .= "Camera trước điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_cpu)) {
        $loi .= "CPU điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_cpu) < 2) {
            $loi .= "CPU điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($tablet_cpu) > 50) {
            $loi .= "CPU điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_ram)) {
        $loi .= "Ram điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_ram) < 3) {
            $loi .= "Ram điện thoại  không được ít hơn 3 ký tự <br>";
        }
        if (strlen($tablet_ram) > 50) {
            $loi .= "Ram điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_bonhotrong)) {
        $loi .= "Bộ Nhớ Trong điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_bonhotrong) < 2) {
            $loi .= "Bộ Nhớ Trong điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($tablet_bonhotrong) > 50) {
            $loi .= "Bộ Nhớ Trong điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_ketnoimang)) {
        $loi .= "Thẻ nhớ điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_ketnoimang) < 2) {
            $loi .= "Thẻ nhớ điện thoại không được ít hơn 2 ký tự <br>";
        }
        if (strlen($tablet_ketnoimang) > 50) {
            $loi .= "Thẻ nhớ điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_damthoai)) {
        $loi .= "SIM điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_damthoai) < 3) {
            $loi .= "SIM điện thoại không được ít hơn 3 ký tự <br>";
        }
        if (strlen($tablet_damthoai) > 50) {
            $loi .= "SIM điện thoại không được vượt quá 50 ký tự <br>";
        }
    }

    if (empty($tablet_trongluong)) {
        $loi .= "Dung lượng điện thoại không được rỗng <br>";
    } else {
        if (strlen($tablet_trongluong) < 3) {
            $loi .= "Dung lượng điện thoại không được ít hơn 3 ký tự <br>";
        }
        if (strlen($tablet_trongluong) > 50) {
            $loi .= "Dung lượng điện thoại không được vượt quá 50 ký tự <br>";
        }
    }


    return $loi;
}

?>