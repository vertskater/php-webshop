<section class="grid product-container">
	<?php foreach($products as $product) :?>
		<div>
			<a class="product-link" href="/product.php?id=<?= \Cm\Shop\Helper\Renderer::e($product['id']) ?>">
				<img src="../img/<?= \Cm\Shop\Helper\Renderer::e($product['image'])?>" alt="<?= \Cm\Shop\Helper\Renderer::e($product['image_alt']) ?>"/>
				<h5><?= \Cm\Shop\Helper\Renderer::e($product['name']) ?></h5>
				<p class="category">Category: <a class="category-link" href="../category.php?cat_id=<?= \Cm\Shop\Helper\Renderer::e($product['cat_id'])?>"><?= \Cm\Shop\Helper\Renderer::e($product['category_name']) ?></a></p>
				<hr/>
				<div class="flex-space-between">
					<a class="add-cart" href="/add-to-cart.php?id=<?= $product['id'] ?>&cat_id=<?= $cat_id ?? '' ?>"><span class="material-icons-outlined">add_shopping_cart</span> </a>
					<span class="product-price">€ <?=\Cm\Shop\Helper\Renderer::e($product['price']) ?></span>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
</section>