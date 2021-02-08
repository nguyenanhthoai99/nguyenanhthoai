<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once(__DIR__ . '/../../backend/layouts/partials/config.php') ?>
    <style>
        body {
            background-color: #f0f0f0;
        }
    </style>
    <?php
    include_once(__DIR__ . '/../../backend/layouts/styles.php');
    include_once(__DIR__ . '/../../dbconnect.php');
    ?>
</head>

<body>
    <?php include_once(__DIR__ . '/../../backend/layouts/partials/header.php') ?>
    <div class="container-fluid">
        <?php include_once(__DIR__ . '/../../backend/layouts/partials/content.php') ?>
    </div>
    <div class="container-fluid">
        <?php include_once(__DIR__ . '/../../backend/layouts/partials/footer.php') ?>
    </div>
</body>

</html>