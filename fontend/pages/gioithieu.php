<?php
if (session_id() === '') {
    session_start();
}

?>
<!DOCTYPE html>
<title>Giới Thiệu</title>
<html lang="en">

<head>
    <?php 
    include_once(__DIR__ . '/../layouts/partials/config.php')
     ?>
    <style>
        body {
            background-color: #f0f0f0;
        }
    </style>
    <?php
    include_once(__DIR__ . '/../layouts/styles.php');
    include_once(__DIR__ . '/../../dbconnect.php');
    ?>
    <style>
        .main-gthieu {
            background-color: white;
        }

        .main-gthieu h1 {
            font-size: 20px;
        }

        .main-gthieu hr {
            margin: 5px 0px;
        }

        .map {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php 
    include_once(__DIR__ . '/../layouts/partials/header.php');
     ?>
     <?php 
    //  include_once(__DIR__ . '/messages.php')
      ?>
    <div class="container">
        <div class="mt-5">
            <!-- main giới thiệu -->
            <div class="container mt-1 main-gthieu">
                <h1 class="pt-3">
                    Giới thiệu về Vesper Nguyễn Mobile
                    <hr>
                </h1>
                <p>
                    <b>&emsp;Công Ty tránh nhiệm Hữu Hạn Vesper Nguyễn</b> là<b> nhà bán lẻ số 1 Việt Nam </b>về doanh thu và lợi nhuận, với mạng lưới hơn 3.400 cửa hàng trên toàn quốc. Ngoài ra, Vesper Nguyễn Mobile còn mở rộng ra thị trường nước ngoài với
                    chuỗi bán lẻ thiết bị di động và điện máy tại Campuchia.
                    <br>&emsp;&emsp;Vesper Nguyễn Mobile tập trung xây dựng dịch vụ khách hàng khác biệt với chất lượng vượt trội, phù hợp với văn hoá đặt khách hàng làm trung tâm trong mọi suy nghĩ và hành động của công ty.
                    <br>&emsp;&emsp; Vesper Nguyễn Mobile vinh dự khi liên tiếp lọt vào bảng xếp hạng TOP 50 công ty niêm yết tốt nhất Châu Á của tạp chí uy tín Forbes và là đại diện Việt Nam duy nhất trong Top 100 nhà bán lẻ hàng đầu Châu Á – Thái Bình Dương
                    do Tạp chí bán lẻ châu Á (Retail Asia) và Tập đoàn nghiên cứu thị trường Euromonitor bình chọn. Vesper Nguyễn Mobile nhiều năm liền có tên trong các bảng xếp hạng danh giá như TOP 500 nhà bán lẻ hàng đầu Châu Á – Thái Bình Dương (Retail
                    Asia) và dẫn đầu TOP 50 công ty kinh doanh hiệu quả nhất Việt Nam (Nhịp Cầu Đầu Tư)… Sự phát triển của Vesper Nguyễn Mobile cũng là một điển hình tốt được nghiên cứu tại các trường Đại học hàng đầu như Harvard, UC Berkeley, trường kinh
                    doanh Tuck (Mỹ).
                    <br>&emsp;&emsp; Không chỉ là một doanh nghiệp hoạt động hiệu quả được nhìn nhận bởi nhà đầu tư và các tổ chức đánh giá chuyên nghiệp, Vesper Nguyễn Mobile còn được người lao động tin yêu khi lần thứ 4 liên tiếp được vinh danh trong TOP
                    50 Doanh nghiệp có môi trường làm việc tốt nhất Việt Nam và là doanh nghiệp xuất sắc nhất tại giải thưởng Vietnam HR Awards 2018 – “Chiến lược nhân sự hiệu quả”.
                </p>
                <h1>Thông tin về công ty</h1>
                <ul>
                    <li>Công Ty tránh nhiệm Hữu Hạn Vesper Nguyễn</li>
                    <li>Địa chỉ: 106, Bình Hòa, Bình Thành, Lấp Vò, Đồng Tháp.</li>
                    <li>Giấy chứng nhận Đăng ký Kinh doanh số 0309532909 do Sở Kế hoạch và Đầu tư Tỉnh Đồng Tháp cấp ngày 04/06/2020.
                    </li>
                </ul>
                <h1>Văn phòng Vesper Nguyễn</h1><br>
                <p class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.7487872021957!2d105.51990001410225!3d10.36196036954194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a7172ec66adb3%3A0xcb7e5c1c0d4bda4e!2zQ2jhu6MgTOG6pXAgVsOy!5e0!3m2!1svi!2s!4v1594189049563!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                    </iframe>
                </p>
                <br>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php include_once(__DIR__ . '/../layouts/partials/footer.php') ?>
    </div>
</body>

</html>