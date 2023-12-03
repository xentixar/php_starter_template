<?php
require_once __DIR__ . '/../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?= getenv('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <link rel="shortcut icon" href="<?= asset('images/xentixar.png') ?>" type="image/x-icon">
</head>

<body>
    <canvas id="stars"></canvas>
    <div class="container">
        <div>
            <div class="image">
                <img width="100%" src="<?= asset('images/xentixar.png') ?>" alt="">
            </div>
            <div class="text">Successfully Loaded !</div>
        </div>
    </div>

    <script src="<?= asset('js/min.js') ?>"></script>
</body>

</html>