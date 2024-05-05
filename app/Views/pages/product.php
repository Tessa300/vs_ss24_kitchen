<h1> <?= $product['name'] ?> </h1>

<form action="<?=site_url('products/update/'.$product['product_type_id'])?>" method="POST" id="product_form">

    <div class="form-group mb-2 row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= isset($error['name'])?'is-invalid':'' ?>" id="name" name="name"
                   placeholder="Name"
                   value="<?= isset($product['name']) ? $product['name'] : ''; ?>" >
            <div class="invalid-feedback">
                <?= (isset($error['name']))?$error['name']:'' ?>
            </div>
        </div>
    </div>

    <div class="form-group mb-2 row">
        <label class="sr-only col-sm-2 col-form-label" for="inlineFormInputGroup">Preis</label>
        <div class="col-sm-5">
            <div class="">
                <input type="number" class="form-control <?= isset($error['price_per_unit'])?'is-invalid':'' ?>" id="price_per_unit" name="price_per_unit" placeholder="1" value="<?= isset($product['price_per_unit']) ? $product['price_per_unit'] : ''; ?>" required>
                <div class="invalid-feedback"><?= (isset($error['price_per_unit']))?$error['price_per_unit']:'' ?></div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <select name="unit_symbol" id="unit_symbol" class="form-select" required>
                    <? foreach($unit_symbols as $symbol): ?>
                        <option <?= (isset($product['unit_symbol']) && $product['unit_symbol'] == $symbol) ? ' selected' : '' ?> value="<?=$symbol?>">
                            <?= $symbol ?>
                        </option>
                    <?endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group mb-2 row">
        <label for="is_meal" class="col-sm-2 col-form-label">Typ</label>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_meal" id="is_meal_0" value="0" <?= (!isset($product['is_meal'])) ? 'checked' :  (($product['is_meal'] == '0') ? 'checked' : '') ?>>
                <label class="form-check-label" for="is_meal_0">Zutat</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_meal" id="is_meal_1" value="1" <?= (isset($product['is_meal']) && $product['is_meal'] == '1') ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_meal_1">Gericht</label>
            </div>
            <div class="invalid-feedback">
                <?= (isset($error['is_meal']))?$error['is_meal']:'' ?>
            </div>
        </div>
    </div>

    <div class="form-group mb-2 row">
        <label for="image_path" class="col-sm-2 col-form-label">Bild</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= isset($error['image_path'])?'is-invalid':'' ?>" id="image_path" name="image_path"
                   placeholder="Pfad"
                   value="<?= isset($product['image_path']) ? $product['image_path'] : ''; ?>" >
            <div class="invalid-feedback">
                <?= (isset($error['image_path']))?$error['image_path']:'' ?>
            </div>
        </div>
    </div>

    <div class="form-group mb-2 row">
        <label for="enabled" class="col-sm-2 col-form-label">Typ</label>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="enabled" id="enabled_0" value="0" <?= (isset($product['enabled']) && $product['enabled'] == '0') ? 'checked' : '' ?>>
                <label class="form-check-label" for="enabled_0">Passiv</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="enabled" id="enabled_1" value="1" <?= (!isset($product['enabled'])) ? 'checked' : (($product['enabled'] == '1') ? 'checked' : '') ?>>
                <label class="form-check-label" for="enabled_1">Aktiv</label>
            </div>
            <div class="invalid-feedback">
                <?= (isset($error['enabled']))?$error['enabled']:'' ?>
            </div>
        </div>
    </div>

    <? if(isset($product)): ?><button class="btn" type="button" id="edit_button" onclick="enableForm('product_form')">Abbrechen</button><? endif; ?>
    <button class="btn" type="submit" id="save_button">Speichern</button>
</form>

<script>
    <? if(isset($product)): ?>
    enableForm('product_form');

    function enableForm(parentEle_id) {
        var parentEle = document.getElementById(parentEle_id);
        parentEle.querySelectorAll('input, select, button[type=submit], a').forEach((ele) => {
            ele.disabled = !ele.disabled;
        });
        parentEle.querySelectorAll("button[type=button]").forEach((ele) => {
            if(ele.innerHTML == "Bearbeiten") {
                ele.innerHTML = "Abbrechen";
            }else {
                ele.innerHTML = "Bearbeiten";
                parentEle.reset();
            }
        });

    }
    <? endif; ?>
</script>
