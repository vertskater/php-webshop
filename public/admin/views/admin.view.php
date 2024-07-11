<main class="container container-padding">
	<h1>Welcome <?= Cm\Shop\Helper\Renderer::e($user['username']) ?> (<?= Cm\Shop\Helper\Renderer::e(mb_strtoupper($user['role'])) ?>)</h1>
    <section class="grid">
        <div class="charts">
            <h3>Products in store:</h3>
            <canvas id="stored-products"></canvas>
        </div>
        <div></div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script> const data =  <?php echo $stored_products ?> </script>
<script type="module" src="../js/chart.js"></script>