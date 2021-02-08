<?php
if (session_id() === '') {
    session_start();
}

?>
<?php
include_once(__DIR__ . '/../../dbconnect.php');

$itemId = $_GET["item"];
$slq = <<<OTE
SELECT sp.sp_ma, sp.sp_gia, sp.sp_giacu,ctqc.ctqc_ten, ctqc.ctqc_cpu, ctqc.ctqc_ram,
ctqc.ctqc_ocung, ctqc.ctqc_manhinh, ctqc.ctqc_cardmanhinh, ctqc.ctqc_congketnoi,
ctqc.ctqc_hedieuhanh, ctqc.ctqc_thietke, ctqc.ctqc_kichthuoc, ctqc.ctqc_ramat,
ctqc.ctqc_anhsanpham		  
FROM sanpham AS sp
JOIN chitietquangcao AS ctqc ON ctqc.ctqc_ma = sp.ctqc_ma
JOIN sploai AS spl ON spl.spl_ma = sp.spl_ma	
   WHERE sp.sp_ma = $itemId;   

OTE;
$resultLaptopNoiBat = mysqli_query($conn, $slq);
$dataSanPhamHot = [];
while ($row = mysqli_fetch_array($resultLaptopNoiBat, MYSQLI_ASSOC)) {
    $dataSanPhamHot[] = array(
        'sp_ma' => $row['sp_ma'],
        'sp_gia' => $row['sp_gia'],
        'sp_giacu' => $row['sp_giacu'],
        'ctqc_ten' => $row['ctqc_ten'],
        'ctqc_cpu' => $row['ctqc_cpu'],
        'ctqc_ram' => $row['ctqc_ram'],
        'ctqc_ocung' => $row['ctqc_ocung'],
        'ctqc_manhinh' => $row['ctqc_manhinh'],
        'ctqc_cardmanhinh' => $row['ctqc_cardmanhinh'],
        'ctqc_congketnoi' => $row['ctqc_congketnoi'],
        'ctqc_hedieuhanh' => $row['ctqc_hedieuhanh'],
        'ctqc_thietke' => $row['ctqc_thietke'],
        'ctqc_anhsanpham' => $row['ctqc_anhsanpham'],
        'ctqc_kichthuoc' => $row['ctqc_kichthuoc'],
        'ctqc_ramat' => $row['ctqc_ramat']
    );
}

$data = $dataSanPhamHot[0];
?>
<!DOCTYPE html>
<html lang="en">
<title><?= $data['ctqc_ten']; ?></title>

<head>
    <?php include_once(__DIR__ . '/../../backend/layouts/partials/config.php') ?>

    <?php
    include_once(__DIR__ . '/../../backend/layouts/styles.php');
    include_once(__DIR__ . '/../../dbconnect.php');
    ?>
    <style>
        .main-sp {
            margin-top: 75px;
            background-color: white;
        }

        body {
            background-color: #f0f0f0;
        }

        .gia-sp-goc {
            color: red;
            font-size: 20px;
        }

        .gia-sp-giam {
            font-size: 20px;
        }

        .main-sanpham .hinh-sp {
            height: 500px;
            width: 500px;
            margin: 25px;
        }

        .thongtin-sp {
            border: 1px solid #f0f0f0;
        }

        .tieude-sp {
            font-size: 32px;
            text-align: center;
        }

        .kt-sp {
            margin-left: 70px;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .mua-ngay {
            color: white;
            padding-left: 0px;
            padding-right: 50px;
        }

        .hinh-sp-laptop {
            height: 400px;
            width: 100%;
        }

        .hinh-sp-tablet {
            width: 100%;
            height: 600px;
            padding-top: 5px;
        }

        .hinh-dt-nbat {
            transition: 0.5s ease-in;
        }

        @media only screen and (max-width: 320px) {
            .main-sanpham .hinh-sp {
                width: 100%;
                height: auto;
                margin-left: 0px;
                margin-top: 70px;
            }

            .kt-sp {
                margin-left: 0px;
                border-bottom: 1px solid #f0f0f0;
                margin-bottom: 10px;
                font-size: 12px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongso {
                float: right;
            }

            .thongso-kt {
                font-size: 16px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongtin-sp {
                margin-top: 0px;
            }

            .kt-sp .soluong {
                margin-top: 9px;
            }

            .gia-sp-goc {
                font-size: 16px;
            }

            .gia-sp-giam {
                font-size: 14px;
            }

            .mua-ngay {
                padding-right: 10px;
            }
        }

        @media (min-width: 321px) and (max-width: 375px) {
            .main-sanpham .hinh-sp {
                width: 100%;
                height: auto;
                margin-left: 0px;
                margin-top: 70px;
            }

            .kt-sp {
                margin-left: 0px;
                border-bottom: 1px solid #f0f0f0;
                margin-bottom: 10px;
                font-size: 12px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongso {
                float: right;
            }

            .thongso-kt {
                font-size: 16px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongtin-sp {
                margin-top: 0px;
            }

            .kt-sp .soluong {
                margin-top: 9px;
            }

            .gia-sp-goc {
                font-size: 16px;
            }

            .gia-sp-giam {
                font-size: 14px;
            }

            .mua-ngay {
                padding-right: 10px;
            }
        }

        @media (min-width: 376px) and (max-width: 575.98px) {
            .main-sanpham .hinh-sp {
                width: 100%;
                height: auto;
                margin-left: 0px;
                margin-top: 70px;
            }

            .kt-sp {
                margin-left: 0px;
                border-bottom: 1px solid #f0f0f0;
                margin-bottom: 10px;
                font-size: 14px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongso {
                float: right;
            }

            .thongso-kt {
                font-size: 18px;
            }

            .tieude-sp {
                font-size: 22px;
            }

            .thongtin-sp {
                margin-top: 0px;
            }

            .kt-sp .soluong {
                margin-top: 9px;
            }

            .gia-sp-goc {
                font-size: 18px;
            }

            .gia-sp-giam {
                font-size: 16px;
            }

            .mua-ngay {
                padding-right: 10px;
            }
        }

        @media (min-width: 576px) and (max-width: 763.98px) {
            .main-sanpham .hinh-sp {
                width: 100%;
                height: auto;
                margin-left: 0px;
                margin-top: 70px;
            }

            .kt-sp {
                margin-left: 0px;
                border-bottom: 1px solid #f0f0f0;
                margin-bottom: 10px;
                font-size: 14px;
            }

            .tieude-sp {
                font-size: 20px;
            }

            .thongso {
                float: right;
            }

            .thongso-kt {
                font-size: 18px;
            }

            .tieude-sp {
                font-size: 22px;
            }

            .thongtin-sp {
                margin-top: 0px;
            }

            .kt-sp .soluong {
                margin-top: 9px;
            }

            .gia-sp-goc {
                font-size: 18px;
            }

            .gia-sp-giam {
                font-size: 16px;
            }

            .mua-ngay {
                padding-right: 10px;
            }
        }
    </style>
</head>

<body>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <div class="container-fluid mt-3 main-sp">
        <form action="xulymuahang.php?sp_ma=<?= $data['sp_ma']; ?>" method="POST" name="frmSanPham">
            <div class="row main-sanpham">
                <!-- hình sản phẩm -->
                <div class="col-md-5" style="margin-top: 75px;"><img src="/nguyenanhthoai/fontend/images/quangcao/<?= $data['ctqc_anhsanpham']; ?>" class="hinh-sp-laptop"></div>
                <!-- end hình sản phẩm -->
                <!-- Thông tin sp -->
                <div class="col-md-7 thongtin-sp">
                    <h1 class="tieude-sp display-4 mt-2"><?= $data['ctqc_ten']; ?></h1>
                    <hr>
                    <h1 class="thongso-kt">Thông số kỹ thuật</h1>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            CPU:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_cpu']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            RAM:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_ram']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            Ổ cứng:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_ocung']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            Màn hình:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_manhinh']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            Card màn hình:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_cardmanhinh']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            Cổng kết nối:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_congketnoi']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            Hệ điều hành:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_hedieuhanh']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            Thiết kế:
                        </div>
                        <div class="col-md-8">

                            <?= $data['ctqc_thietke']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            Kích thước:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_kichthuoc']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <div class=" col-md-4 thongso">
                            Thời điểm ra mắt:
                        </div>
                        <div class="col-md-8">
                            <?= $data['ctqc_ramat']; ?>
                        </div>
                    </div>
                    <div class="row kt-sp">
                        <span class="gia-sp-goc">
                            <?= number_format($data['sp_gia'], 0, ".", ",") . ' vnđ'; ?>
                        </span>&emsp;
                        <span class="gia-sp-giam">
                            <del>
                                <?php
                                if ((($data['sp_giacu'] != null) && ($data['sp_giacu'] > $data['sp_gia'])))
                                    echo number_format($data['sp_giacu'], 0, ".", ",") . ' vnđ';
                                ?>
                            </del>
                        </span>
                    </div>
                    <div class="row kt-sp">
                        <label for="soluong">Số lượng đặt mua:</label>
                        <button type="button" id="btn-Tru" name="btn-Tru" style="width:50px;" onclick="tru()">
                            <i class="fa fa-minus"></i>
                        </button>
                        <input type="number" min="1" max="9" class="form-control" id="soluongmua" name="soluongmua" style="width:100px; text-align:center;" value="1">
                        <button type="button" id="btn-Cong" name="btn-Cong" style="width:50px;" onclick="cong()">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-warning btn-lg btn-block mb-2 mua-ngay">MUA NGAY</button>
                </div>
                <!-- end thông tin sp -->
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <?php include_once(__DIR__ . '/../../backend/layouts/partials/footer.php') ?>
    </div>
</body>
<script>
    var dem = 1;

    function cong() {
        dem = dem + 1;
        if (dem < 10) {
            document.getElementById("soluongmua").value = dem;

        } else {
            dem = 9;
        }
    }

    function tru() {
        dem = dem - 1;
        if (dem > 0) {
            document.getElementById("soluongmua").value = dem;
        } else {
            dem = 1;
        }
    }
</script>

</html>