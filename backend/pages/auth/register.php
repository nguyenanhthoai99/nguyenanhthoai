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
    <title>Đăng Ký</title>
    <?php include_once(__DIR__ . '/../../layouts/partials/config.php') ?>
    <?php include_once(__DIR__ . '/../../layouts/styles.php') ?>
</head>

<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php') ?>
    <form class="mt-5" name="frmdangky" id="frmdangky" method="post" action="" enctype="multipart/form-data">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-md-6 mt-4">
                    <div class="card mx-4">
                        <div class="card-body p-4">
                            <h1>Đăng ký</h1>
                            <?php
                            if (isset($_POST["btnDangKy"])) {
                                $loi = kiemTraLoi();
                                if ($loi)
                                    echo "<div style='background-color: #D88383; color: white;'>" . $loi . "</div>";
                            }
                            ?>
                            <p class="text-muted">Tạo tài khoản</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="Tên tài khoản" name="kh_tendangnhap" />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="password" placeholder="Mật khẩu" name="kh_matkhau" />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="kh_nhaplaimatkhau" />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="Họ tên" name="kh_ten" />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select name="kh_gioitinh" class="form-control">
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="Địa chỉ" name="kh_diachi" />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="Điện thoại" name="kh_dienthoai" />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="Ngày sinh" name="kh_ngay" />
                                <input class="form-control" type="text" placeholder="Tháng sinh" name="kh_thang" />
                                <input class="form-control" type="text" placeholder="Năm sinh" name="kh_nam" />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-center">
                                        <div class="form-group">
                                            <img src="/nguyenanhthoai/fontend/images/demo/default-png-5-png-image-default-png-1200_800.png" class="img-thumbnail" id="hinhDemo" name="hinhDemo" style=" height:200px; width:200px;">
                                            <input type="file" class="form-control" id="kh_avatar" name="kh_avatar">
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <button class="btn btn-block btn-success" name="btnDangKy">Tạo tài khoản</button>
                        </div>
                        <div class="card-footer p-4">
                            <div class="row">
                                <div class="col-12">
                                    <center>Nếu bạn đã có Tài khoản, xin mời Đăng nhập</center>
                                    <a class="btn btn-primary form-control" href="/nguyenanhthoai/backend/pages/auth/login.php">Đăng nhập</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>


    <?php

    if (isset($_POST['btnDangKy'])) {
        $loi = kiemTraLoi();
        if ($loi) {
            return;
        }
        $kh_tendangnhap = $_POST['kh_tendangnhap'];
        $kh_matkhau = $_POST['kh_matkhau'];
        $kh_ten = $_POST['kh_ten'];
        $kh_gioitinh = $_POST['kh_gioitinh'];
        $kh_diachi = $_POST['kh_diachi'];
        $kh_dienthoai = $_POST['kh_dienthoai'];
        $kh_ngay = $_POST['kh_ngay'];
        $kh_thang = $_POST['kh_thang'];
        $kh_nam = $_POST['kh_nam'];



        if (isset($_FILES['kh_avatar'])) {

            $upload_dir = __DIR__ . "/../../../fontend/images/hinhavatar/";
            if ($_FILES['kh_avatar']['error'] > 0) {
                die;
            } else {

                $kh_avatar = $_FILES['kh_avatar']['name'];
                $tentaptin = date('YmdHis') . '_' . $kh_avatar;

                move_uploaded_file($_FILES['kh_avatar']['tmp_name'], $upload_dir  . $tentaptin);
            }
        }
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = "INSERT INTO khachhang (kh_ten, kh_tendangnhap, kh_matkhau, kh_gioitinh, kh_diachi,kh_sdt, kh_ngay, kh_thang, kh_nam, kh_avatar) VALUES ('$kh_ten', '$kh_tendangnhap', '$kh_matkhau ', $kh_gioitinh, '$kh_diachi', '$kh_dienthoai', $kh_ngay, $kh_thang, $kh_nam, '$tentaptin')";
        // print_r($sql);
        // die;
        mysqli_query($conn, $sql);

        mysqli_close($conn);
        echo "<script>alert('Bạn đã đăng ký thành công')</script>";
        echo "<script>location.href = 'login.php';</script>";
    }

    ?>


</body>

<script>
    document.getElementById('kh_avatar').onchange = function(evt) {
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
</script>

<?php


function kiemTraLoi()
{
   global $conn; 

    $conn = mysqli_connect('localhost','root','','web_banhang') or die('Xin lỗi bạn kết nối thất bại. Vui làm kiểm tra lại.');
    $conn->query("SET NAME 'utf8mb4'");
    $conn->query("SET CHARACTER SET 'UTF8MB4'");
    $conn->query("SET SESSION collation_connection ='utf8mb4_unicode_ci'");

    $loi = "";
    $kh_tendangnhap = $_POST['kh_tendangnhap'];
    $kh_matkhau = $_POST['kh_matkhau'];
    $kh_nhaplaimatkhau = $_POST['kh_nhaplaimatkhau'];
    $kh_ten = $_POST['kh_ten'];
    $kh_diachi = $_POST['kh_diachi'];
    $kh_dienthoai = $_POST['kh_dienthoai'];
    $kh_ngay = $_POST['kh_ngay'];
    $kh_thang = $_POST['kh_thang'];
    $kh_nam = $_POST['kh_nam'];


    $sql = "SELECT * FROM khachhang WHERE kh_tendangnhap='$kh_tendangnhap'";
    $result = mysqli_query($conn, $sql);

    if (empty($kh_tendangnhap)) {
        $loi .= "Tên đăng nhập không được rỗng </br>";
    } else {
        if (mysqli_num_rows($result) > 0) {
            $loi .= "Tài khoản đã tồn tại</br>"; 
        } else {
            if (strlen($kh_tendangnhap) < 3) {
                $loi .= "Tên đăng nhập không được ít hơn 3 kí tự <br>";
            }
            if (strlen($kh_tendangnhap) > 30) {
                $loi .= "Tên đăng nhập không được lớn hơn 30 kí tự <br>";
            }
        }
    }

    if (empty($kh_matkhau)) {
        $loi .= "Mật Khẩu không được rỗng <br>";
    } else {
        if (strlen($kh_matkhau) < 3) {
            $loi .= "Mật Khẩu không được ít hơn 3 kí tự<br>";
        }
        if (strlen($kh_matkhau) > 30) {
            $loi .= "Mật Khẩu không được nhiều hơn 30 kí tự<br>";
        }
    }
    if (empty($kh_nhaplaimatkhau)) {
        $loi .= "Mật Khẩu không được rỗng <br>";
    } else {
        if ($kh_nhaplaimatkhau != $kh_matkhau) {
            $loi .= "Mật Khẩu không không khớp<br>";
        }
       
    }

    if (empty($kh_ten)) {
        $loi .= "Họ tên không được rỗng<br>";
    } else {
        if (strlen($kh_ten) < 3) {
            $loi .= "Mật Khẩu không được ít hơn 3 kí tự<br>";
        }
        if (strlen($kh_ten) > 30) {
            $loi .= "Họ tên không được nhiều hơn 30 kí tự<br>";
        }
    }

    if (empty($kh_diachi)) {
        $loi .= "Địa chỉ không được rỗng<br>";
    } else {
        if (strlen($kh_diachi) < 3) {
            $loi .= "Địa chỉ không được ít hơn 3 kí tự<br>";
        }
        if (strlen($kh_diachi) > 50) {
            $loi .= "Địa chỉ  không được nhiều hơn 50 kí tự<br>";
        }
    }

    if (empty($kh_dienthoai)) {
        $loi .= "Số điện thoại không được rỗng<br>";
    } else {
        // if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST['kh_dienthoai'])){
        //     $loi .="Số điện thoại không đúng định dạng (VD:09....) <br>";
        // }
        if (strlen($kh_dienthoai) < 3) {
            $loi .= "Địa chỉ không được ít hơn 3 kí tự <br>";
        }
        if (strlen($kh_dienthoai) > 20) {
            $loi .= "Địa chỉ  không được nhiều hơn 20 kí tự <br>";
        }
    }


    if (empty($kh_ngay)) {
        $loi .= "Ngày sinh không được rỗng <br>";
    } else {
        if (strtotime($kh_ngay)) {
            $loi .= "Ngày sinh không đúng định dạng <br>";
        }
        // if(strlen($kh_ngay) < 32 ){
        //     $loi .="Ngày sinh chỉ có 31 <br>";
        // }
    }

    if (empty($kh_thang)) {
        $loi .= "Tháng sinh không được rỗng <br>";
    } else {
        if (strtotime($kh_thang)) {
            $loi .= "Tháng sinh không đúng định dạng <br>";
        }
        // if(strlen($kh_thang) < 13 ){
        //     $loi .="Tháng sinh chỉ có 12 <br>";
        // }
    }

    if (empty($kh_nam)) {
        $loi .= "Năm sinh không được rỗng <br>";
    }

    if (($_FILES['kh_avatar']['error'] > 0)) {
        $loi .= "Ảnh đại diện không được rỗng <br>";
    } else {
        if (!($_FILES['kh_avatar']['type'] == "image/png" || $_FILES['kh_avatar']['type'] == "image/jpeg" || $_FILES['kh_avatar']['type'] == "image/gif" || $_FILES['kh_avatar']['type'] == "image/jpg" || $_FILES['kh_avatar']['type'] == "image/PSD" || $_FILES['kh_avatar']['type'] == "image/PDF")) {
            $loi .= "Ảnh đại diện phải là file ảnh <br>";
        } else {
            if ($_FILES['kh_avatar']['size'] > 5120) {
                $loi .= "Ảnh đại diện không vượt quá 5mb <br>";
            }
        }
    }
    return $loi;
}


?>

</html>