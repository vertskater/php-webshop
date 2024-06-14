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
        <li><a href="/cart.php"><span class="material-icons-outlined">shopping_cart</span></a></li>
    </ul>
    </nav>
</header>
<?php
    if(!empty($header_img)) {
        include 'parts/head.main.php';
    }
?>
 <?php echo $content ?? 'Sorry, no content available.'?>
</body>
<footer class="main-footer grid">
    <div>
        &copy; Christoph Mitterwallner, BEd
    </div>
    <div>
        <form>
            <h5>Newsletter</h5>
            <fieldset role="group">
                <input name="email" type="email" placeholder="Enter your email" autocomplete="email" />
                <input type="submit" value="Subscribe" />
            </fieldset>
        </form>
    </div>
    <div>
        <ul>
          <?php if(!empty($footer_menu)) :?>
            <?php foreach($footer_menu as $link) : ?>
                <li><a href="<?=ROOT_PATH . $link['src'] ?>"><?= $link['name'] ?></a></li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
    </div>
</footer>
</html>

