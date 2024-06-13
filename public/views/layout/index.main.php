<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="../../css/pico.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title><?= $title ?? 'Webshop' ?></title>
</head>
<body>
<header>
    <nav class="main-nav">
        <div class="logo"><a href="/index.php">LOGO</a></div>
    <ul>
        <?php foreach ($navigation as $link) : ?>
            <li>
              <a href="/category.php?id=<?= \Cm\Shop\Helper\Renderer::e($link['id']) ?>"><?= Cm\Shop\Helper\Renderer::e($link['name']); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    </nav>
</header>
 <?php echo $content ?? 'Sorry, no content available.'?>
</body>
<footer class="main-footer">
    &copy; Christoph Mitterwallner, BEd
</footer>
</html>

