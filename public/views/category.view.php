<main class="container container-padding">
    <h1>Category: <?= \Cm\Shop\Helper\Renderer::e($products[0]['category_name']) ?></h1>
	<?php include "products-list.view.php"; ?>
</main>