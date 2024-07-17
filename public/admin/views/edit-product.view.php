<?php use Cm\Shop\Helper\Renderer; ?>
<main class="container-padding container">
	<h1><?= $title ?? 'Product' ?></h1>
    <form class="form-edit" action="/admin/edit-product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?=Renderer::e( $product['id'] ?? '') ?>">
        <label for="name">Product name:
            <input type="text" name="name" id="name" value="<?= Renderer::e($product['name'] ?? '')?>">
            <span class="error"><?= Renderer::e($errors['name']) ?? '' ?></span>
        </label>
        <label for="description">Description:
            <textarea name="description" id="description" cols="30" rows="5"><?= Renderer::e($product['description'] ?? '') ?></textarea>
            <span class="error"><?= Renderer::e($errors['description']) ?? '' ?></span>
        </label>
        <label for="details">Details:
            <textarea name="details" id="details" cols="30" rows="5"><?=Renderer::e($product['details'] ?? '') ?></textarea>
            <span class="error"><?= Renderer::e($errors['details']) ?? '' ?></span>
        </label>
        <label for="price">Price:
            <input type="text" name="price" id="price" value="<?= Renderer::e(number_format($product['price'] ?? 0, '2', ',', '.')) ?? '' ?>">
            <span class="error"><?= Renderer::e($errors['price']) ?? '' ?></span>
        </label>
        <label for="stored">Stored:
            <input type="number" name="stored" id="stored" value="<?= Renderer::e($product['in_store'] ?? 0) ?>">
            <span class="error"><?= Renderer::e($errors['in_store']) ?? '' ?></span>
        </label>
        <label for="category">Category:
        <select class="category-option" name="category" id="category">
			    <?php foreach ( $categories as $category ) : ?>
              <option  value="<?= Renderer::e( $category['id'] )?>" <?php echo $category['id'] === ($product['category_id'] ?? '') ? 'selected' : '' ?>><?= Renderer::e($category['name']) ?></option>
			    <?php endforeach; ?>
        </select>
        </label>
        <?php if(!empty($product['image'])) : ?>
            <div class="product-img">
                <img src="<?= '/img/' . Renderer::e($product['image']) ?>" alt="<?= Renderer::e($product['image_alt']) ?>">
            </div>
        <?php endif; ?>
        <label for="image">Product Image:
            <input type="file" name="image" id="image" accept="image/jpeg, image/png">
            <span class="error"><?= Renderer::e($errors['image_name'] ?? '') ?></span>
        </label>
        <label for="alt_text">Image alt text:
            <input type="text" name="alt_text" id="alt_text" value="<?= Renderer::e($product['image_alt'] ?? '') ?>">
            <span class="error"><?= Renderer::e($errors['image_alt'] ?? '')?></span>
        </label>
        <input type="submit" value="Save">
    </form>
</main>