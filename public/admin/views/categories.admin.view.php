<?php use Cm\Shop\Helper\Renderer; ?>
<main class="container container-padding full-height">
	<table class="striped cart-price">
		<thead>
		<tr>
			<th><span class="material-icons">delete_outlined</span></th>
			<th>Category Name</th>
			<th>Description</th>
			<th>Navigation</th>
			<th>Edit</th>
		</tr>
		</thead>
		<?php foreach($categories as $category) : ?>
			<tr>
				<td><a href="./delete-category.php?cat_id=<?= Renderer::e($category['id']) ?>" class="delete-product">X</a> </td>
				<td><?= Renderer::e($category['name'])?></td>
				<td><?= Renderer::e($category['description'])?></td>
				<td><?= Renderer::e($category['navigation'])?></td>
				<td class="edit-product"><a href="./edit-category.php?cat_id=<?= $category['id']?>">Edit</a> </td>
			</tr>
		<?php endforeach; ?>
	</table>
    <div class="add-new">
        <a role="button" href="./edit-category.php">Add new category</a>
    </div>
</main>