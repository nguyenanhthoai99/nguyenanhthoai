<?php
if (session_id() === '') {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once(__DIR__ . '/../layouts/partials/config.php') ?>
<title>Điện Thoại giá rẻ nhất - Điện Thoại Vesper Nguyễn Mobile </title>
<?php
include_once(__DIR__ . '/../../dbconnect.php');
$sql = <<<OTE
    SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, km.km_qua, sp.sp_hinh, sp.sp_sanphamhot, sp.sp_slider 
    FROM sanpham sp
    JOIN khuyenmai km ON km.km_ma = sp.km_ma
    JOIN loaisanpham lsp ON lsp.lsp_ma = sp.lsp_ma
    WHERE lsp.lsp_ma = 1 AND sp.sp_sanphamhot IS NULL AND sp.sp_slider IS NULL ;
OTE;
$result  = mysqli_query($conn, $sql);
$data = [];
while ($row  = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data[] = array(
        'sp_ma' => $row['sp_ma'],
        'sp_ten' => $row['sp_ten'],
        'sp_gia' => $row['sp_gia'],
        'sp_giacu' => $row['sp_giacu'],
        'sp_hinh' => $row['sp_hinh'],
        'km_qua' => $row['km_qua']
    );
}
?>

<head>

    <style>
        .img-quangcao {
            width: 1120px;
        }

        .hinh-slider {
            height: 500px;
            width: 100%;
        }

        .hinhsp-hot {
            height: 160px;
            width: 160px;
            z-index: 2;
        }

        .sanpham-hot {
            display: flex;
            background-color: white;
            border: 1px solid orangered;
        }

        .td-hot {
            position: relative;
            top: 15px;
            left: 0px;
            color: white;
            background-color: orangered;
            border: 1px solid orangered;
            border-radius: 50%;
            z-index: 3;
        }

        .td-hot h1 {
            font-size: 20px;
            text-align: center;
        }

        .sanpham-hot .priv_arrow {
            position: absolute;
            bottom: 200px;
            left: 0px;
            height: 70px;
            width: 45px;
            font-size: x-large;
            z-index: 1;
        }

        .sanpham-hot .next_arrow {
            position: absolute;
            font-size: x-large;
            bottom: 200px;
            right: -5px;
            height: 70px;
            width: 45px;
            z-index: 1;
            display: inline-block;
        }

        .main-sp-hot img {
            margin-left: 25px;
        }

        @media only screen and (max-width: 768px) {
            .main-sp-hot img {
                width: 100%;
            }
        }

        .main-sp-hot .ten-sp-hot:hover {
            color: cornflowerblue;
        }

        .sanpham-hot a {
            text-decoration: none;
        }

        .gia-sp-gochot {
            color: red;
            font-size: 16px;
        }

        .gia-sp-giam {
            color: black;
            font-size: 12px;
        }

        .sanpham-hot .priv_arrow {
            position: absolute;
            bottom: 200px;
            left: 0px;
            height: 70px;
            width: 45px;
            font-size: x-large;
            z-index: 1;
        }

        .sanpham-hot .next_arrow {
            position: absolute;
            font-size: x-large;
            bottom: 200px;
            right: -5px;
            height: 70px;
            width: 45px;
            z-index: 1;
            display: inline-block;
        }

        .qt-spham {
            font-size: 10px;
            color: black;
        }

        .ten-sp-hot {
            color: black;
        }

        .dt-noibat {
            background-color: white;
        }

        .nen-dt-nbat {
            background-color: white;
            border: 1px solid #f0f0f0;
            margin-left: 0px;
            margin-right: 0px;
        }

        .main-dt-nbat {
            border: 1px solid #f0f0f0;
            padding-left: 0px;
            padding-right: 0px;
        }

        .main-dt-nbat a {
            text-decoration: none;
        }

        .main-dt-nbat a:hover {
            text-decoration: none;
        }

        .ten-sp-nbat {
            color: black;
        }

        .main-dt-nbat .ten-sp-nbat:hover {
            color: cornflowerblue;
        }

        .nen-dt-nbat a {
            text-decoration: none;
        }

        .nen-dt-nbat .ten-dt-nbat:hover {
            color: cornflowerblue;
        }

        .ten-dt-nbat {
            color: black;
        }

        .nen-dt {
            margin-right: 0px;
            margin-left: 0px;
            padding-top: 0px;
        }



        .hinh-dt-nbat {
            transition: 0.5s ease-in;
            height: 200px;
            max-width: 100%;
        }

        .mainDienThoai {
            margin-top: 75px;
        }
    </style>
    <?php
    include_once(__DIR__ . '/../layouts/styles.php');
    include_once(__DIR__ . '/../layouts/css.php');
    ?>
</head>

<body>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <div class="mainDienThoai">
        <div class="container mt-5 ">
            <!--Điện Thoại Nổi Bật -->
            <div class="container mt-4 ">
                <div class="row nen-dt-nbat ">
                    <div class="col-md-12 ">
                        <h1 class="tieude-dt-nbat ">ĐIỆN THOẠI NỔI BẬT</h1>
                    </div>
                </div>
                <div class="row nbat ">
                    <?php $dem = 0; ?>
                    <?php foreach ($data as $item) : ?>
                        <?php
                        // $dem++;
                        // // if ($dem > 12) {
                        // //     break;
                        // // }
                        ?>
                        <div class="col-md-3 col-xs-12 main-dt-nbat ">
                            <a href="sanphamdienthoai.php?item=<?= $item['sp_ma'] ?>"><img src="/nguyenanhthoai/fontend/images/dienthoai/<?= $item['sp_hinh']; ?> " class="hinh-dt-nbat mt-3" onmouseenter="increaseSize(this) " onmouseout="decreaseSize(this) ">
                                <div class="card-body ">
                                    <p class="ten-dt-nbat "><?= $item['sp_ten']; ?>
                                    </p>
                                    <p class="gia-dt-nbat card-text "><strong class="gia-sp-gochot ">
                                            <?= number_format($item['sp_gia'], 0, ".", ",") . ' vnđ'; ?>
                                        </strong>
                                        <span class="gia-sp-giam ">
                                            <del>
                                                <?php
                                                if ((($item['sp_giacu'] != null) && ($item['sp_giacu'] > $item['sp_gia'])))
                                                    echo number_format($item['sp_giacu'], 0, ".", ",") . ' vnđ';
                                                ?>
                                            </del>
                                        </span>
                                    </p>
                                    <p class="card-text qt-spham "><?= $item['km_qua']; ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- end sản phẩm -->
            </div>
            <!-- ENd mt-3 container-->
        </div>
    </div>
</body>
<div class="container-fluid">
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php') ?>
</div>
</body>
<script>
    function increaseSize(el) {
        $(el).css("position", "relative");
        $(el).css("top", -10);
    }

    function decreaseSize(el) {
        $(el).css("position", "relative");
        $(el).css("top", 0);
    }
</script>

</html>