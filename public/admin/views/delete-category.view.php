<main class="container-padding container">
    <h3>You sure, you want to delete the category <?= \Cm\Shop\Helper\Renderer::e($cat_name ?? ''); ?></h3>
	<form class="delete-category" action="/admin/delete-category.php?cat_id=<?= \Cm\Shop\Helper\Renderer::e($cat_id ?? '');?>" method="post">
        <input type="submit" value="Yes">
        <a href="/admin/categories.admin.php" type="button">No</a>
	</form>
</main>