<div class="mycontainer">
    <? foreach($orders as $order) : ?>
        <div class="mybox">
            <div class="box-header">
                <?= $order['name']."<br> x".$order['amount'].$order['unit_symbol'] ?> 
            </div>
            <div class="box-body">
                <form method="POST" action="<?= site_url()?>/orders/finished/<?= $order['order_id']?>/<?= $order['product_type_id']?>">
                    <button class="btn m-2">Ausgeliefert</button>
                </form>
            </div>
            <div class="box-footer">
                <?= $order['order_datetime'] ?>
            </div>
        </div>
    <? endforeach ?>
</div>
