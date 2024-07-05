
<main class="container container-padding">
	<h1><?=$product['name']?></h1>
    <?php if(!empty($info)) : ?>
       <p>
           <mark><?= $info['saved'] ?? '' ?></mark>
       </p>
    <?php endif; ?>
	<section class="grid">
		<div>
			<img src="../img/<?=$product['image'] ?>" alt="<?=$product['image_alt']?>"/>
		</div>
		<div class="rating">
			<h5><mark><?=$product['description']?></mark></h5>
			<?php
		for($i = 0; $i < 5; $i++) {
			if($i < ceil((int)$product['rating'])){
				echo '<span class="material-icons-outlined">star</span>';
			}else {
                if((double)$product['rating'] > $i) {
                    echo '<span class="material-icons-outlined">star_half</span>';
                }   else {
	                echo '<span class="material-icons-outlined">grade</span>';
                }
            }
        }
        ?>
        <hr/>
        <p class="product-info">Release date: <?= date('d M. Y', strtotime($product['added_at'])); ?></p>
         <p class="product-price txt-midnight-blue">€ <?= Cm\Shop\Helper\Renderer::e(number_format($product['price'], '2', ',', '.'))?></p>
         <form action="../product.php?id=<?=$product['id']?>" method="post">
             <label for="quantity">Quantity:</label>
             <input id="quantity" name="quantity" type="number" max="5" min="1" value="1">
             <input type="submit" value="Add to Cart"/>
         </form>
		</div>
	</section>
    <section id="accordions">
        <h2>Product Details</h2>
        <details>
           <summary>Product description</summary>
            <p><?= $product['details']?></p>
        </details>
    </section>
</main>
