<?php
if (session_id() === '') {
    session_start();
    
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <?php include_once(__DIR__ . '/../layouts/partials/config.php') ?>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <?php
     include_once(__DIR__ . '/../layouts/partials/header.php'); 
    ?>
</head>

<body class="d-flex flex-column h-100">
<?php 
// include_once(__DIR__ . '/messages.php') 
?>
    <main role="main" class="mt-5">
        <!-- Block content -->
        <div class="container mt-5">
            <h1 class="text-center">Liên hệ với Vesper Nguyễn</h1>
            <div class="row">
                <div class="col">

                    <?php
                    if (isset($_POST["btnGoiLoiNhan"])) {
                        $loi = kiemTraLoi();
                        if ($loi)
                            echo "<div style='color:red;'>" . $loi . "</div>";
                    }
                    ?>
                    <form name="frm_lienhe" id="frm_lienhe" method="post" action="">
                        <div class="form-group">
                            <label for="email">Email của bạn</label>
                            <input type="email" class="form-control " id="email" name="email" placeholder="Email của bạn">

                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề của bạn</label>
                            <input type="text" class="form-control " id="title" name="title" placeholder="Tiêu đề của bạn">

                        </div>
                        <div class="form-group">
                            <label for="message">Lời nhắn của bạn</label>
                            <textarea name="message" class="form-control " id="message_thongbao"></textarea>

                        </div>
                        <button class="btn btn-primary" name="btnGoiLoiNhan">Gởi lời nhắn</button>
                    </form>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col col-md-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.7487872021957!2d105.51990001410225!3d10.361960369541938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a7172ec66adb3%3A0xcb7e5c1c0d4bda4e!2zQ2jhu6MgTOG6pXAgVsOy!5e0!3m2!1svi!2s!4v1600533836807!5m2!1svi!2s" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- End block content -->
    </main>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php') ?>
    <!-- end footer -->

</body>

</html>

<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function goiLoiNhan()
{
    if (kiemTraLoi()) {
        return;
    }

    $email = $_POST['email'];
    $title = $_POST['title'];
    $message = $_POST['message'];


    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nathoaid20008@cusc.ctu.edu.vn';
        $mail->Password = 'vulrirxmsfeldqez';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('nathoaid20008@cusc.ctu.edu.vn', 'Mail Liên hệ');
        $mail->addAddress('nathoaid20008@cusc.ctu.edu.vn');
        $mail->addReplyTo($email);

        $mail->isHTML(true);

        $mail->Subject = "[Có người liên hệ] - $title";
        $body = <<<EOT
                Có người liên hệ cần giúp đỡ. <br />
                Email của khách: $email <br />
                Nội dung: <br />
                $message
EOT;
        $mail->Body    = $body;
        $mail->send();
    } catch (Exception $e) {
        echo 'Lỗi khi gởi mail: ', $mail->ErrorInfo;
    }
}

function kiemTraLoi()
{
    $loi = "";
    $email = $_POST["email"];
    $title = $_POST["title"];
    $message = $_POST["message"];

    if (empty($email)) {
        $loi .= "Email không được rỗng <br>";
    } else {
        if (strlen($email) < 3) {
            $loi .= "Email không được ít hơn 3 ký tự <br>";
        }
        if (strlen($email) > 30) {
            $loi .= "Email không được vượt quá 30 ký tự <br>";
        }
    }

    if (empty($title)) {
        $loi .= "Title không được rỗng <br>";
    } else {
        if (strlen($title) < 3) {
            $loi .= "Title không được ít hơn 3 ký tự <br>";
        }
        if (strlen($title) > 30) {
            $loi .= "Title không được vượt quá 30 ký tự <br>";
        }
    }

    if (empty($message)) {
        $loi .= "Message không được rỗng <br>";
    } else {
        if (strlen($message) < 3) {
            $loi .= "Message không được ít hơn 3 ký tự <br>";
        }
        if (strlen($message) > 50) {
            $loi .= "Message không được vượt quá 50 ký tự <br>";
        }
    }

    return $loi;
}

if (isset($_POST['btnGoiLoiNhan'])) {
    goiLoiNhan();
}

?>