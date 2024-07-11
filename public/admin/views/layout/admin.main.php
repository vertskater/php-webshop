<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="../../../css/pico.css">
	<link rel="stylesheet" href="../../../css/style.css">
    <title><?= \Cm\Shop\Helper\Renderer::e($title ?? 'Dashboard') ?></title>
</head>
<body>
<header>
<nav class="main-nav">
    <div class="logo"><a href="/admin/admin.php">LOGO</a></div>
    <ul>
          <?php foreach ($navigation as $name => $link) : ?>
          <li>
              <a href="<?= Cm\Shop\Helper\Renderer::e($link); ?>"><?= Cm\Shop\Helper\Renderer::e($name); ?></a>
          </li>
          <?php endforeach; ?>
            <li >
                <a class="salmon" href="../../../index.php">zum Shop</a>
            </li>
    </ul>
</nav>
</header>
	<?php echo $content ?>
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
                  <li><a href="<?=ROOT_PATH . \Cm\Shop\Helper\Renderer::e($link['src']) ?>"><?= \Cm\Shop\Helper\Renderer::e($link['name']) ?></a></li>
						<?php endforeach; ?>
					<?php endif; ?>
        </ul>
    </div>
</footer>
</body>
</html>
