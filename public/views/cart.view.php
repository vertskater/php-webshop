<main class="container">
    <h1>Checkout: <?= $items[0]['username'] ?? ''?></h1>
    <?php if(empty($items)) :  ?>
    <section class="shopping-cart">
        <h2>Sorry there are no products in the Cart.</h2>
        <a role="button" href="/index.php">Shop now</a>
    </section>
    <?php else: ?>
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
                <td><span class="material-icons">clear</span></td>
                <td><?=$key + 1 ?></td>
                <td><?=$item['name']?></td>
                <td><?=$item['quantity']?></td>
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
    <?php endif; ?>
</main>
