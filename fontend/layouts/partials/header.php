<!DOCTYPE html>
<html lang="en">
<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');


if (isset($_COOKIE["kh_tendangnhap_logged"])) {
    $_SESSION['kh_tendangnhap_logged'] = $_COOKIE["kh_tendangnhap_logged"];
}

if (isset($_SESSION['kh_tendangnhap_logged'])) {
    $tenkhachhang = $_SESSION['kh_tendangnhap_logged'];
    $sql = "SELECT * FROM khachhang WHERE kh_tendangnhap = '$tenkhachhang'";
    $result = mysqli_query($conn, $sql);
    $dataAnhKhachHang = [];

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $dataAnhKhachHang[] = array(
            'kh_ma' => $row['kh_ma'],
            'kh_tendangnhap' => $row['kh_tendangnhap'],
            'kh_avatar' => $row['kh_avatar']
        );
    }
    $dataAnhKhachHang = $dataAnhKhachHang[0];
}



?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điện thoại di động giá rẻ nhất - Siêu thị điện thoại Vesper Nguyễn Mobile</title>
    <meta name="keywords " content="Vesper Nguyễn, vespernguyen, vesper nguyễn, Điện Thoại Giá Rẻ, dienthoaigiare, điện thoại giá rẻ, dtdd, smartphone,laptop,tablet">
    <link rel="icon" href="/nguyenanhthoai/fontend/images/icon/icon.jpg" type="image/jpg" sizes="16x16">
    <link rel="icon" href="/nguyenanhthoai/fontend/images/icon/icon.jpg" type="image/jpg" sizes="32x32">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .ten-menu a {
            text-align: center;
            font-size: 10px;
        }

        .hinh-icon {
            height: 30px;
            width: 30px;
            margin-right: 10px;
        }

        main-menu li:hover div {
            display: block;
        }

        .TimKiem {
            font-size: small;
            width: 190px;
        }

        .btn-TimKiem p {
            font-size: small;
        }

        .icon-shop:hover {
            color: grey;
        }

        .icon-shop {
            color: white;
            font-size: 48px;
        }

        .giohang {
            position: relative;
        }

        .sohanghoa {
            position: absolute;
            top: 1px;
            left: -4px;
            color: white;
            background-color: red;
            border-radius: 50%;
            width: 20px;
            font-size: 10px;
            text-align: center;
        }

        @media only screen and (max-width: 320px) {
            .TimKiem {
                font-size: small;
                width: 170px;
                margin-right: 3px;
            }

            .btn-TimKiem p {
                font-size: 9px;
                height: 3px;
                width: 40px;
                padding-top: 3px;
                text-align: center;
            }
        }

        @media (min-width: 321px) and (max-width: 375px) {
            .TimKiem {
                font-size: small;
                width: 225px;
                margin-right: 3px;
            }

            .btn-TimKiem p {
                font-size: 9px;
                height: 3px;
                width: 40px;
                padding-top: 3px;
                text-align: center;
            }
        }

        @media (min-width: 376px) and (max-width: 575.98px) {
            .TimKiem {
                font-size: small;
                width: 250px;
                margin-right: 3px;
            }

            .btn-TimKiem p {
                font-size: 9px;
                height: 3px;
                width: 40px;
                padding-top: 3px;
                text-align: center;
            }
        }

        @media (min-width: 576px) and (max-width: 763.98px) {
            .TimKiem {
                font-size: small;
                width: 225px;
                margin-right: 3px;
            }

            .btn-TimKiem p {
                font-size: 9px;
                height: 3px;
                width: 40px;
                padding-top: 3px;
                text-align: center;
            }

        }

        @media (min-width: 576px) {
            .form-inline .form-control {
                width: 290px;
            }
        }

        @media (min-width: 764px) and (max-width: 1023.98px) {
            .TimKiem {
                font-size: small;
                width: 290px;
                margin-right: 3px;
            }

            .btn-TimKiem p {
                font-size: 9px;
                height: 3px;
                width: 40px;
                padding-top: 3px;
                text-align: center;
            }
        }
        @media (min-width: 1024px) {
            .form-inline .form-control {
                width: 200px;
            }
        }
        @media (min-width: 1024px) and (max-width: 1999.98px) {
            .TimKiem {
                font-size: small;
                width: 120px;
                margin-right: 3px;
            }

            .btn-TimKiem p {
                font-size: 9px;
                height: 3px;
                width: 40px;
                padding-top: 3px;
                text-align: center;
            }

            .menu-ngang {
                font-size: 10px;
            }
        }

        @media (min-width: 1200px) {
            .menu-ngang {
                font-size: 16px;
            }
        }
        @media (min-width: 2000px) {
            .form-inline .form-control {
                width: 195px;
            }
            
            .btn-TimKiem p {
                font-size: 9px;
                height: 3px;
                width: 40px;
                padding-top: 3px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <!-- Menu -->
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="/nguyenanhthoai/fontend/images/icon/icon.jpg" class="hinh-icon" />Vesper Nguyễn</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse menu-ngang" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto main-menu">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Trang Chủ<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gioithieu.php">Giới Thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lienhe.php">Liên Hệ</a>
                    </li>
                    <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sản Phẩm
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="dienthoai.php">Điện Thoại</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="laptop.php">Laptop</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="tablet.php">Tablet</a>
                        </div>
                    </li>
                    </li>
                </ul>
                <!-- Form Tìm Kiếm -->
                <form name="frmSearch" id="frmSearch" class="form-inline my-2 my-lg-0" action="/nguyenanhthoai/fontend/pages/search.php" method="get">
                    <input class="form-control mr-sm-2 TimKiem" type="search" placeholder="Tìm sản phẩm, thương hiệu bạn muốn mua..." aria-label="Search" name="search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0 mr-5 btn-TimKiem" type="submit" id="submit" name="submit">
                        <p>Tìm Kiếm</p>
                    </button>
                </form>
                <!-- menu ngang bên phải -->
                <ul class="navbar-nav">
                    <li class="nav-item giohang">
                        <a class="nav-link nav-dangnhap" href="/nguyenanhthoai/fontend/pages/card.php">
                            <i class="fa fa-shopping-cart " aria-hidden="true"></i>Giỏ Hàng
                        </a>
                        <span class="sohanghoa">
                            <?php
                            if (isset($_SESSION['giohang'])) {
                                $giohang = $_SESSION['giohang'];
                                if ($giohang != null) {
                                    echo count($giohang);
                                }
                            }
                            ?>
                        </span>
                    </li>
                    <?php

                    function showDebug($thongbao)
                    {
                        echo '<script type="text/javascript">alert("' . $thongbao . '");</script>';
                    }

                    $checkSession = isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged']);
                    $checkCookie = isset($_COOKIE['kh_tendangnhap_logged']) && !empty($_COOKIE['kh_tendangnhap_logged']);


                    if ($checkCookie) {
                        $_SESSION['kh_tendangnhap_logged'] = $_COOKIE['kh_tendangnhap_logged'];
                    }

                    if ($checkCookie || $checkSession) :
                    ?>

                        <?php if ($_SESSION['kh_tendangnhap_logged'] == 'admin') : ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <?php if ($dataAnhKhachHang['kh_avatar'] != null) : ?>
                                        <img src="/nguyenanhthoai/fontend/images/hinhavatar/<?= $dataAnhKhachHang['kh_avatar'] ?>" class="img-fluid" style="width:20px;height:20px;">
                                    <?php else : ?>
                                        <img src="/nguyenanhthoai/fontend/images/hinhavatar/avatar-default.png" class="img-fluid" style="width:20px;height:20px;">
                                    <?php endif; ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="/nguyenanhthoai/backend/functions/dienthoai/index.php">Thêm Điện Thoại</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/nguyenanhthoai/backend/functions/laptop/index.php">Thêm Laptop</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/nguyenanhthoai/backend/functions/tablet/index.php">Thêm Tablet</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/nguyenanhthoai/backend/functions/donhang/index.php">Đơn Hàng</a>
                                </div>
                            </li>

                        <?php else : ?>
                            <?php if (($dataAnhKhachHang['kh_avatar'] != null) && ($_SESSION['kh_tendangnhap_logged'] != 'admin')) : ?>
                                <a class="nav-link"><img src="/nguyenanhthoai/fontend/images/hinhavatar/<?= $dataAnhKhachHang['kh_avatar'] ?>" class="img-fluid" style="width:20px;height:20px;"></a>
                            <?php else : ?>
                                <a class="nav-link"><img src="/nguyenanhthoai/fontend/images/hinhavatar/avatar-default.png" class="img-fluid" style="width:20px;height:20px;"></a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link" href="/nguyenanhthoai/backend/pages/auth/logout.php">Đăng xuất</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link" href="/nguyenanhthoai/backend/pages/auth/login.php">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>