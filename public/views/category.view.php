<main class="container container-padding">
    <?php if(!empty($products)) :?>
    <h1>Category: <?= \Cm\Shop\Helper\Renderer::e($products[0]['category_name']) ?></h1>
	<?php include "products-list.view.php"; ?>
    <?php else : ?>
    <h1>Sorry, no Products in this Category</h1>
    <?php endif; ?>
</main>