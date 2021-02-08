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
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        .hinh-qt-laptop {
            height: 50px;
            width: 50px;
        }

        .main-dt1 {
            background-color: white;
            border: 1px solid #f0f0f0;
            margin-left: 0px;
            margin-right: 0px;
            padding-bottom: 0px;
        }

        .nen-dt {
            margin-right: 0px;
            margin-left: 0px;
            padding-top: 0px;
        }

        .hinh-dt-nbat {
            height: 200px;
        }

        .main-dk {
            margin: 0px;
            padding: 0px 80px 25px 80px;
        }

        .main-dk button {
            width: 120px;
        }

        .hinh-dt-nbat {
            transition: 0.5s ease-in;
        }

        .hinh-laptop-nbat {
            transition: 0.5s ease-in;
        }

        .hinh-tablet-nbat {
            height: 200px;
            transition: 0.5s ease-in;
        }
    </style>
</head>

<body>
    <div class="mt-5 ">
        <!-- main container -->
        <!-- slider -->
        <?php
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sqlSanPhamSlider = <<<OTE
        SELECT sp.sp_ma,sp.sp_hinhchitiet, sp.sp_hinh
        FROM sanpham sp   
        WHERE sp.lsp_ma = 1  AND sp.sp_slider IS NOT NULL;
OTE;
        $resultSanPhamSlider = mysqli_query($conn, $sqlSanPhamSlider);
        $dataSanPhamSlider = [];
        while ($rowSanPhamSlider = mysqli_fetch_array($resultSanPhamSlider, MYSQLI_ASSOC)) {
            $dataSanPhamSlider[] = array(
                'sp_ma' => $rowSanPhamSlider['sp_ma'],
                'sp_hinh' => $rowSanPhamSlider['sp_hinh']
            );
        }
        ?>
        <div class="container " style="padding:0px;">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $count = 0;
                    ?>
                    <?php foreach ($dataSanPhamSlider as $item) : ?>

                        <?php
                        $count++;
                        if ($count == 1)
                            echo '<div class="carousel-item active">';
                        else
                            echo '<div class="carousel-item">';
                        ?>
                        <a href="sanphamslider.php?item=<?= $item['sp_ma']; ?>"><img src="/nguyenanhthoai/fontend/images/slider/<?= $item['sp_hinh']; ?>" class="d-block w-100"></a>
                </div>
            <?php endforeach; ?>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- End slider -->
    <!-- quảng cáo -->
    <?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $sqlSanPhamQuangCao = <<<OTE
        SELECT  sp.sp_hinh ,sp.sp_ma, sp.sp_quangcao
	    FROM sanpham AS sp
	    WHERE sp.sp_quangcao is NOT NULL;
OTE;
    $resultSanPhamQuangCao = mysqli_query($conn, $sqlSanPhamQuangCao);
    $dataSanPhamQuangCao = [];
    while ($rowSanPhamQuangCao = mysqli_fetch_array($resultSanPhamQuangCao, MYSQLI_ASSOC)) {
        $dataSanPhamQuangCao[] = array(
            'sp_ma' => $rowSanPhamQuangCao['sp_ma'],
            'sp_hinh' => $rowSanPhamQuangCao['sp_hinh']
        );
    }
    ?>
    <div class="container mt-3 ">
        <?php $dem = 0; ?>
        <?php foreach ($dataSanPhamQuangCao as $item) : ?>
            <?php
            $dem++;
            if ($dem > 1)
                break;
            ?>
            <a href="sanphamlaptop.php?item=<?= $item['sp_ma']; ?>"><img style="width: 100%;" src="/nguyenanhthoai/fontend/images/hinhquangcao/<?= $item['sp_hinh']; ?>" class="img-quangcao" /></a>
        <?php endforeach; ?>
    </div>
    <!-- Sản phẩm hot -->
    <div class="container mt-1 main-sp ">
        <div class="td-hot " style="width:200px ">
            <h1>SẢN PHẨM HOT</h1>
        </div>
        <?php
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sqlSanPhamHot = <<<OTE
            SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, km.km_qua, sp.sp_hinh, km.km_ma, sp.lsp_ma
            FROM sanpham  sp
            JOIN khuyenmai km ON km.km_ma = sp.km_ma
            WHERE sp.sp_sanphamhot IS NOT NULL
OTE;
        $resultSanPhamHot = mysqli_query($conn, $sqlSanPhamHot);
        $dataSanPhamHot = [];
        while ($rowSanPhamHot = mysqli_fetch_array($resultSanPhamHot, MYSQLI_ASSOC)) {
            $dataSanPhamHot[] = array(
                'sp_ten' => $rowSanPhamHot['sp_ten'],
                'sp_ma' => $rowSanPhamHot['sp_ma'],
                'lsp_ma' => $rowSanPhamHot['lsp_ma'],
                'km_ma' => $rowSanPhamHot['km_ma'],
                'sp_gia' => $rowSanPhamHot['sp_gia'],
                'sp_giacu' => $rowSanPhamHot['sp_giacu'],
                'sp_hinh' => $rowSanPhamHot['sp_hinh'],
                'km_qua' => $rowSanPhamHot['km_qua']
            );
        }

        ?>
        <div class="sanpham-hot ">
            <?php foreach ($dataSanPhamHot as $item) : ?>
                <div class="main-sp-hot mt-5 ">
                    <?php
                    if ($item["lsp_ma"] == 1) {
                        $link = "sanphamdienthoai.php?item=" . $item["sp_ma"];
                    } else if ($item["lsp_ma"] == 2) {
                        $link = "sanphamlaptop.php?item=" . $item["sp_ma"];
                    } else {
                        $link = "sanphamtablet.php?item=" . $item["sp_ma"];
                    }
                    ?>
                    <a href="<?= $link ?>"><img class="card-img-top hinhsp-hot " src="/nguyenanhthoai/fontend/images/sanpham/sanpham-hot/<?= $item['sp_hinh']; ?>" alt="Card image cap " onmouseenter="increaseSize(this) " onmouseout="decreaseSize(this) ">
                        <div class="card-body ">
                            <p class="ten-sp-hot "><?= $item['sp_ten']; ?></p>
                            <p class="gia-sp-hot card-text ">
                                <strong class="gia-sp-gochot ">
                                    <?= number_format($item['sp_gia'], 0, ".", ",") . ' vnđ'; ?>
                                </strong>&nbsp;
                                <span class="gia-sp-giam ">
                                    <del>
                                        <?php
                                        if ((($item['sp_giacu'] == null) || ($item['sp_giacu'] > $item['sp_gia'])))
                                            echo number_format($item['sp_giacu'], 0, ".", ",") . ' vnđ';
                                        ?>
                                    </del>
                                </span>
                            </p>
                            <p class="card-text qt-spham ">
                                <?php
                                if ($item['km_ma'] == 2) {
                                    echo '<img src="/nguyenanhthoai/fontend/images/sanpham/qua-tang/tui-chong-soc-laptop-14-inch-evalu-lmp-t002a-den-1-200x200.jpg " class="hinh-qt-laptop"/>' . $item['km_qua'];
                                } else {
                                    echo $item['km_qua'];
                                }
                                ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $sqlDienThoaiNoiBat = <<<OTE
        SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, km.km_qua, sp.sp_hinh 
        FROM sanpham sp
        JOIN khuyenmai km ON km.km_ma = sp.km_ma
        WHERE sp.sp_noibat IS NOT NULL AND sp.lsp_ma = 1 ;
OTE;
    $resultDienThoaiNoiBat  = mysqli_query($conn, $sqlDienThoaiNoiBat);
    $dataSanPhamHot = [];
    while ($rowDienThoaiNoiBat  = mysqli_fetch_array($resultDienThoaiNoiBat, MYSQLI_ASSOC)) {
        $dataDienThoaiNoiBat[] = array(
            'sp_ma' => $rowDienThoaiNoiBat['sp_ma'],
            'sp_ten' => $rowDienThoaiNoiBat['sp_ten'],
            'sp_gia' => $rowDienThoaiNoiBat['sp_gia'],
            'sp_giacu' => $rowDienThoaiNoiBat['sp_giacu'],
            'sp_hinh' => $rowDienThoaiNoiBat['sp_hinh'],
            'km_qua' => $rowDienThoaiNoiBat['km_qua']
        );
    }
    ?>
    <!--Điện Thoại Nổi Bật -->
    <div class="container mt-4 ">
        <div class="row nen-dt-nbat ">
            <div class="col-md-12 ">
                <h1 class="tieude-dt-nbat ">ĐIỆN THOẠI NỔI BẬT</h1>
            </div>
        </div>
        <div class="row nen-dt-nbat ">
            <?php $dem = 0; ?>
            <?php foreach ($dataDienThoaiNoiBat as $item) : ?>

                <?php $dem++;
                if ($dem > 8)
                    break;
                ?>
                <div class="col-md-3 col-xs-12 main-dt-nbat ">
                    <a href="sanphamdienthoai.php?item=<?= $item['sp_ma'] ?>"><img src="/nguyenanhthoai/fontend/images/dienthoai/<?= $item['sp_hinh']; ?> " class="hinh-dt-nbat img-fluid mt-3 " onmouseenter="increaseSize(this) " onmouseout="decreaseSize(this) ">
                        <div class="card-body ">
                            <p class="ten-dt-nbat "><?= $item['sp_ten']; ?>
                            </p>
                            <p class="gia-dt-nbat card-text "><strong class="gia-sp-gochot ">
                                    <?= number_format($item['sp_gia'], 0, ".", ",") . ' vnđ'; ?>
                                </strong>&nbsp;
                                <span class="gia-sp-giam ">
                                    <del>
                                        <?php
                                        if ((($item['sp_giacu'] == null) || ($item['sp_giacu'] > $item['sp_gia'])))
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

        <?php
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sqlLaptopNoiBat = <<<OTE
            SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, km.km_qua, sp.sp_hinh, sp.sp_noibat 
            FROM sanpham sp
            JOIN khuyenmai km ON km.km_ma = sp.km_ma
            WHERE sp.lsp_ma = 2 AND sp.sp_noibat IS NOT NULL;
OTE;
        $resultLaptopNoiBat = mysqli_query($conn, $sqlLaptopNoiBat);
        $dataLaptopNoiBat = [];
        while ($rowLaptopNoiBat = mysqli_fetch_array($resultLaptopNoiBat, MYSQLI_ASSOC)) {
            $dataLaptopNoiBat[] = array(
                'sp_ma' => $rowLaptopNoiBat['sp_ma'],
                'sp_ten' => $rowLaptopNoiBat['sp_ten'],
                'sp_gia' => $rowLaptopNoiBat['sp_gia'],
                'sp_giacu' => $rowLaptopNoiBat['sp_giacu'],
                'sp_hinh' => $rowLaptopNoiBat['sp_hinh'],
                'km_qua' => $rowLaptopNoiBat['km_qua']
            );
        }
        ?>
        <!-- Laptop Nổi Bật -->
        <div class="container mt-4 ">
            <div class="row nen-dt-nbat ">
                <div class="col-md-12 ">
                    <h1 class="tieude-dt-nbat ">LAPTOP NỔI BẬT</h1>
                </div>
            </div>
            <div class="row nen-dt-nbat ">
                <?php $dem = 0; ?>
                <?php foreach ($dataLaptopNoiBat as $item) : ?>
                    <?php $dem++;
                    if ($dem > 8)
                        break;
                    ?>
                    <div class="col-md-3 col-xs-12 main-dt-nbat ">
                        <a href="sanphamlaptop.php?item=<?= $item['sp_ma'] ?>"><img src="/nguyenanhthoai/fontend/images/laptop/<?= $item['sp_hinh']; ?> " class="hinh-laptop-nbat img-fluid mt-3 " onmouseenter="increaseSize(this) " onmouseout="decreaseSize(this) ">
                            <div class="card-body ">
                                <p class="ten-dt-nbat "><?= $item['sp_ten']; ?>
                                </p>
                                <p class="gia-dt-nbat card-text ">
                                    <strong class="gia-sp-gochot ">
                                        <?= number_format($item['sp_gia'], 0, ".", ",") . ' vnđ'; ?>
                                    </strong>&nbsp;
                                    <span class="gia-sp-giam ">
                                        <del>
                                            <?php
                                            if ((($item['sp_giacu'] == null) || ($item['sp_giacu'] > $item['sp_gia'])))
                                                echo number_format($item['sp_giacu'], 0, ".", ",") . ' vnđ';
                                            ?>
                                        </del>
                                    </span></p>
                                <p class="card-text qt-spham "><img src="/nguyenanhthoai/fontend/images/sanpham/qua-tang/tui-chong-soc-laptop-14-inch-evalu-lmp-t002a-den-1-200x200.jpg " class="hinh-qt-laptop " /><?= $item['km_qua']; ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sqlSanPhamHot = <<<OTE
            SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, km.km_qua, sp.sp_hinh, sp.sp_noibat 
            FROM sanpham sp
            JOIN khuyenmai km ON km.km_ma = sp.km_ma
            JOIN loaisanpham lsp ON lsp.lsp_ma = sp.lsp_ma
            WHERE lsp.lsp_ma = 3 AND sp.sp_noibat IS NOT NULL ;
OTE;
        $resultSanPhamHot = mysqli_query($conn, $sqlSanPhamHot);
        $dataSanPhamHot = [];
        while ($rowSanPhamHot = mysqli_fetch_array($resultSanPhamHot, MYSQLI_ASSOC)) {
            $dataSanPhamHot[] = array(
                'sp_ma' => $rowSanPhamHot['sp_ma'],
                'sp_ten' => $rowSanPhamHot['sp_ten'],
                'sp_gia' => $rowSanPhamHot['sp_gia'],
                'sp_giacu' => $rowSanPhamHot['sp_giacu'],
                'sp_hinh' => $rowSanPhamHot['sp_hinh'],
                'km_qua' => $rowSanPhamHot['km_qua']
            );
        }
        ?>
        <!-- Tablet nổi bật -->
        <div>
            <div class="container mt-4 ">
                <div class="row nen-dt-nbat ">
                    <div class="col-md-12 ">
                        <h1 class="tieude-dt-nbat ">TABLET NỔI BẬT</h1>
                    </div>
                </div>
                <div class="row nen-dt-nbat ">
                    <?php $dem = 0; ?>
                    <?php foreach ($dataSanPhamHot as $item) : ?>
                        <?php $dem++;
                        if ($dem > 8)
                            break;
                        ?>
                        <div class="col-md-3 col-xs-12 main-dt-nbat ">
                            <a href="sanphamtablet.php?item=<?= $item['sp_ma'] ?>"><img src="/nguyenanhthoai/fontend/images/tablet/<?= $item['sp_hinh']; ?> " class="hinh-tablet-nbat img-fluid mt-3 " onmouseenter="increaseSize(this) " onmouseout="decreaseSize(this) ">
                                <div class="card-body ">
                                    <p class="ten-dt-nbat "><?= $item['sp_ten']; ?>
                                    </p>
                                    <p class="gia-dt-nbat card-text ">
                                        <strong class="gia-sp-gochot ">
                                            <?= number_format($item['sp_gia'], 0, ".", ",") . ' vnđ'; ?>
                                        </strong>&nbsp;
                                        <span class="gia-sp-giam ">
                                            <del>
                                                <?php
                                                if ((($item['sp_giacu'] == null) || ($item['sp_giacu'] > $item['sp_gia'])))
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
            </div>
            <!-- end sản phẩm -->
        </div>
        <!-- ENd mt-3 container-->
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
    $('.sanpham-hot').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow: '<span class="priv_arrow"><button type="button" class="btn btn-light"><i class="fa fa-chevron-left" aria-hidden="true"></button></i></span>',
        nextArrow: '<span class="next_arrow"><button type="button" class="btn btn-light"><i class="fa fa-chevron-right" aria-hidden="true"></button></i></span>',

    });
</script>

</html>