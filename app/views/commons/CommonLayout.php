<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : '...' ?></title>
    <link rel="stylesheet" href="../../../public/assets/style.css">
</head>
<body>

<?php include "CommonHeaderView.php"; ?>

<main>
    <?php if (isset($view)) {
        include $view;
    } ?>
</main>

<?php include "CommonFooterView.php"; ?>

</body>
</html>