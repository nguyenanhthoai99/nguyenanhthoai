<?php
if (session_id() === '') {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once(__DIR__ . '/../layouts/partials/config.php') ?>
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
            width: 200px;
            padding-left: 10px;
        }

        .mainDienThoai {
            margin-top: 75px;
        }
    </style>
    <?php
    include_once(__DIR__ . '/../layouts/styles.php');
    include_once(__DIR__ . '/../layouts/css.php');
    include_once(__DIR__ . '/../../dbconnect.php');
    ?>
</head>

<body>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <div class="container-fluid" style="margin-top: 70px;">
        <?php
        $search = $_GET['search'];
        if (isset($_GET['submit']) && $_GET["search"] != '') {

            $query = "SELECT * FROM sanpham sp JOIN khuyenmai km ON km.km_ma = sp.km_ma JOIN loaisanpham lsp ON lsp.lsp_ma = sp.lsp_ma WHERE (sp_ten like '%$search%') and sp_slider is null and sp_quangcao is null";

            $sql = mysqli_query($conn, $query);
            $num = mysqli_num_rows($sql);
            if ($num > 0) {

                echo '<div class="container">';
                echo $num . ' ' . "Sản phẩm tìm kiếm được <b>" . $search . "</b>";
                echo '<div class="row mt-2">';
                foreach ($sql as $row) {
                    echo '<div class="col-md-3 col-xs-12 main-dt-nbat ">';
                    if ($row['lsp_ma'] == 1) {
                        echo '<a href="sanphamdienthoai.php?item=' . $row['sp_ma'] . '">' . '<img src="/nguyenanhthoai/fontend/images/dienthoai/' . $row['sp_hinh'] . '" class="hinh-dt-nbat img-fluid mt-3 "  onmouseenter="increaseSize(this) " onmouseout="decreaseSize(this) ">';
                    } else if ($row['lsp_ma'] == 2) {
                        echo '<a href="sanphamlaptop.php?item=' . $row['sp_ma'] . '">' . '<img src="/nguyenanhthoai/fontend/images/laptop/' . $row['sp_hinh'] . '" class="hinh-dt-nbat img-fluid mt-3 "  onmouseenter="increaseSize(this) " onmouseout="decreaseSize(this) ">';
                    } else {
                        echo '<a href="sanphamtablet.php?item=' . $row['sp_ma'] . '">' . '<img src="/nguyenanhthoai/fontend/images/tablet/' . $row['sp_hinh'] . '" class="hinh-dt-nbat img-fluid mt-3 "  onmouseenter="increaseSize(this) " onmouseout="decreaseSize(this) ">';
                    }

                    echo '<div class="card-body ">';
                    echo '<p class="ten-dt-nbat ">' . $row['sp_ten'] . '</p>';
                    echo '<p class="gia-dt-nbat card-text ">';
                    echo '<strong class="gia-sp-gochot">' . number_format($row['sp_gia'], 0, ".", ",") . ' vnđ' . '</strong>';
                    echo ' <span class="gia-sp-giam ">';
                    echo '<del>';
                    if ((($row['sp_giacu'] != null) && ($row['sp_giacu'] > $row['sp_gia'])))
                        echo number_format($row['sp_giacu'], 0, ".", ",") . ' vnđ';;
                    echo '</del>';
                    echo '</span>';
                    echo '</p>';
                    echo '<p class="card-text qt-spham ">' . $row['km_qua'] . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo 'Không có sản phẩm <b>' . $search . '</b>!';
            }
        } else {
            echo 'Bạn vui lòng nhập từ khóa tìm kiếm!';
        }
        ?>
    </div>
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