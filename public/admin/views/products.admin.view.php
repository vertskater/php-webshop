<?php use Cm\Shop\Helper\Renderer; ?>

<main class="container container-padding full-height">
    <section class="grid custom-grid">
        <aside class="side-menu">
            <ul>
					    <?php foreach($categories as $category) :?>
                  <li><a href="/admin/products.admin.php?cat_id=<?= $category['id'] ?>" class="<?php echo $cat_id == $category['id'] ? 'selected' : '' ?>"><?=ucfirst(Renderer::e($category['name'])) ?></a> </li>
					    <?php endforeach; ?>
            </ul>
        </aside>
        <div class="table-container">
            <table class="striped cart-price">
                <thead>
                <tr>
                    <th><span class="material-icons">delete_outlined</span></th>
                    <th>Product Name</th>
                    <th># Stored</th>
                    <th>Price</th>
                    <th>Details</th>
                    <th>First added</th>
                    <th>Product Image</th>
                    <th>Edit</th>
                </tr>
                </thead>
            <?php foreach($products as $product) : ?>
                <tr>
                    <td><a href="/admin/delete-product.php?prod_id=<?= $product['id'] ?>" class="delete-product">X</a> </td>
                    <td><?= Renderer::e($product['name'])?></td>
                    <td><?= Renderer::e($product['in_store'])?></td>
                    <td><?= number_format(Renderer::e($product['price']), 2, ",", ".")?></td>
                    <td class="product-desc"><?= Renderer::e($product['description'])?></td>
                    <td><?= Renderer::e(Renderer::formatDate($product['added_at']))?></td>
                    <td class="product-img"><img src="/img/<?= Renderer::e($product['image'])?>" alt="<?=Renderer::e($product['image_alt']) ?>"></td>
                    <td class="edit-product"><a href="/admin/edit-product.php?prod_id=<?= $product['id']?>">Edit</a> </td>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>
    </section>
    <div class="add-new">
        <a role="button" href="./edit-product.php">Add new Product</a>
    </div>
</main>