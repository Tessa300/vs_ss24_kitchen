<h1>Hello World</h1>
<p>Lorem ipsum</p>


<?php foreach ($products as $product) : ?>

    <h2><?= $product['name'] ?></h2>
    <p><?= $product['price_per_unit'] ?></p>

<?php endforeach; ?>
