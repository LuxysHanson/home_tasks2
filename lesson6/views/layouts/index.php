<?php
/**
 * @var string $menu
 * @var string $header
 * @var string $content
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="<?= PATH_ASSETS . 'style.css' ?>">
</head>
<body>
<?=$header?>
<div class="content-wrapper">
    <?=$menu?>
    <?=$content?>
</div>
</body>
</html>