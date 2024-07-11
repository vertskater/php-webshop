<main class="container container-padding">
    <h1><?= $title ?? 'Category' ?></h1>
	<form class="form-edit" action="/admin/edit-category.php" method="post">
        <input type="hidden" name="id" id="id" value="<?= $category['id'] ?? '' ?>">
		<label for="name">Category name:
			<input type="text" name="name" id="name" value="<?= $category['name'] ?? '' ?>">
            <span class="error"><?= \Cm\Shop\Helper\Renderer::e($errors['name']) ?? '' ?></span>
		</label>
		<label for="description">Description:
			<textarea name="description" id="description" cols="30" rows="5"><?= $category['description'] ?? '' ?></textarea>
            <span class="error"><?= \Cm\Shop\Helper\Renderer::e($errors['description']) ?? '' ?></span>
		</label>
        <label for="nav">Navigation
            <input type="checkbox" name="nav" id="nav" <?= ($category['navigation'] ?? '') ? 'checked' : ''?>>
        </label>
        <input type="submit" value="Submit">
	</form>
</main>