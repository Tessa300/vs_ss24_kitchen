<h1> <?= $product['name'] ?> </h1>

<p>Preis: <?= $product['price_per_unit'] ?>€ / <?= $product['unit_symbol'] ?> </p>

<br>

<form method="POST" action="<?= site_url('products/update/'.$product['product_type_id']) ?>">
    <input type="text" name="name" value="<?= $product['name'] ?>">
    <input type="number" name="price_per_unit" value="<?= $product['price_per_unit'] ?>">
    <?= isset($errors['price_per_unit']) ? $errors['price_per_unit'] : '' ?>
    <button type="submit">Aktualisieren</button>
</form>

