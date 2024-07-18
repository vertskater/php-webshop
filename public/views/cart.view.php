<main class="container">
    <?php if(isset($info['success'])) : ?>
    <div class="success">
        <?= $info['success']?>
    </div>
    <?php endif; ?>
	<?php if(isset($info['error']) && $info['error'] !== '') : ?>
      <div class="error">
            <?= $info['error']?>
      </div>
	<?php endif; ?>
    <h1>Checkout: <?= $_SESSION['username'] ?? ''?></h1>
    <?php if(empty($items)) :  ?>
    <section class="shopping-cart">
        <h2>Sorry there are no products in the Cart.</h2>
        <a role="button" href="/index.php">Shop now</a>
    </section>
    <?php else: ?>
    <error>
        <?= $errors ?? '' ?>
    </error>
    <table class="striped cart-price">
        <thead>
            <tr>
                <th><span class="material-icons">delete_outlined</span></th>
                <th>#</th>
                <th>Product Name</th>
                <th>amount</th>
                <th>net price</th>
            </tr>
            <?php foreach ($items as $key => $item) :?>
            <tr>
                <td class="delete-product"><a href="../delete-cart-item.php?product_id=<?= $item['product_id'] ?>"><span class="material-icons">clear</span></a></td>
                <td><?=$key + 1 ?></td>
                <td><?=$item['name']?></td>
                <td>
                  <form action="/cart.php" method="POST">
                      <label for="quantity"></label>
                      <input type="number" id="quantity" name="quantity" value="<?=$item['quantity']?>" min="1" max="5">
                      <input type="hidden" name="product_id" id="product_id" value="<?= $item['product_id'] ?>">
                      <button type="submit"><span class="material-icons-outlined">done</span></button>
                  </form>
                </td>
                <td><span>€</span> <?= number_format((($item['quantity'] * $item['price']) * 100) / 120, 2, ',', '.')?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td>Total ext. VAT</td>
                <td><?=$count ?></td>
                <td><span>€</span> <?= number_format($price['total_net'] ?? 0, '2', ',', '.' )?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>20 % VAT</td>
                <td></td>
                <td><span>€</span> <?= number_format($price['ust'] ?? 0, '2', ',', '.' )?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><?= $count ?></td>
                <td class="total-price"><span>€</span> <?= number_format($price['total_gross'] ?? 0, '2', ',', '.' )?></td>
            </tr>
        </thead>
    </table>
    <form class="checkout" action="/checkout.php" method="post">
        <input type="submit" value="Checkout">
    </form>
    <?php endif; ?>
</main>
