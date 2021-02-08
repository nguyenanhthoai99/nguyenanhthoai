

    <!DOCTYPE html>
    <html lang="en">
    <title>Đăng Nhập </title>
    <?php include_once(__DIR__ . '/../../layouts/partials/config.php'); ?>
    <style>
        body {
            background-color: #f0f0f0;
        }

        .btnRegister a {
            text-decoration: none;
            color: white;
        }

        .btnRegister a:hover {
            text-decoration: none;
        }
    </style>
    <?php
    include_once(__DIR__ . '/../../../backend/layouts/styles.php');
    include_once(__DIR__ . '/../../../dbconnect.php');
    ?>

    <script>
        function hienThongBaoLoi(thongbao) {
            document.getElementById("thongBao").innerHTML = thongbao;
        }
    </script>



<body>
    <?php include_once(__DIR__ . '/../../../backend/layouts/partials/header.php') ?>
    <div class="container">
        <?php
        if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) :
        ?>

            <?php
            // if (false) :
            ?>

            <br>
            <br>
            <br>
            <br>
            <h2>Bạn đã đăng nhập rồi. <a href="/nguyenanhthoai/fontend/pages/index.php">Bấm vào đây để quay về trang chủ.</a></h2>
        <?php else : ?>
            <form name="frmLogin" id="frmLogin" method="post" action="" style="margin-top: 150px;margin-bottom:150px">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card-group">
                            <div class="card p-4">

                                <div class="card-body">
                                    <h1>Đăng nhập</h1>
                                    <p class="text-muted">Nhập thông tin Tài khoản</p>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" name="kh_tendangnhap" placeholder="Tên đăng nhập">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" type="password" name="kh_matkhau" placeholder="Mật khẩu">
                                        </div>
                                    </div>

                                    <h5 style="color:red;" id="thongBao"></h5>

                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="ghiNhoDangNhap" name="ghiNhoDangNhap">
                                        <label class="form-check-label" for="ghiNhoDangNhap">Ghi Nhớ Đăng Nhập</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="/nguyenanhthoai/backend/pages/auth/register.php" class="btn btn-primary btn-lg btn-block btnRegister" name="btnRegister">
                                                Đăng Ký
                                            </a>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="btnLogin">Đăng Nhập</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        <?php
            include_once(__DIR__ . '/../../../dbconnect.php');

            function dangNhap($conn)
            {
                $loi = "";
                $kh_tendangnhap = addslashes($_POST['kh_tendangnhap']);          
                $kh_matkhau = addslashes($_POST['kh_matkhau']);
                $kh_ghiNhoDangNhap = $_POST['ghiNhoDangNhap'];
                if ($kh_tendangnhap == "") {
                    $loi .= "Tên đăng nhập hoặc mật khẩu không chính xác!<br>";
                 
                }


                if ($loi != "") {
                    echo '<script type="text/javascript">hienThongBaoLoi("' . $loi . '");</script>';
                    return;
                }

                $sqlSelect = <<<EOT
                SELECT *
                FROM khachhang kh
                WHERE kh.kh_tendangnhap = '$kh_tendangnhap' AND kh.kh_matkhau = '$kh_matkhau';
EOT;
                $result = mysqli_query($conn, $sqlSelect);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'kh_ten' => $row['kh_ten']
                    );
                }

                if (mysqli_num_rows($result) > 0) {
                    showDebug("Đăng nhập thành công");
                    $_SESSION['kh_tendangnhap_logged'] = $kh_tendangnhap;
                    $_SESSION['ghiNhoDangNhap_logged'] = $kh_ghiNhoDangNhap;
                    // showDebug($_SESSION['ghiNhoDangNhap_logged']);
                    $_SESSION['kh_ten'] = $data[0]["kh_ten"];

                    if (isset($_POST["ghiNhoDangNhap"]) && $_POST["ghiNhoDangNhap"] != null) {

                        echo '<script>location.href = "/nguyenanhthoai/backend/pages/auth/setCookie.php";</script>';
                    } else {
                        echo '<script>location.href = "/nguyenanhthoai/fontend/pages/index.php";</script>';
                    }
                } else {
                    echo '<script type="text/javascript">hienThongBaoLoi("Tên đăng nhập hoặc mật khẩu không chính xác!");</script>';
                }
            }

            if (isset($_POST['btnLogin'])) {
                dangNhap($conn);
            }
        endif;
        ?>
    </div>
    <div class="container-fluid">
        <?php include_once(__DIR__ . '/../../../backend/layouts/partials/footer.php') ?>
    </div>
</body>

</html>