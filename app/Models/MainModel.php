<?php
namespace App\Models;
use CodeIgniter\Model;

class MainModel extends Model
{

    public function getProducts(){
        $query = $this->db->query("SELECT product_types.*, GROUP_CONCAT(p2.name SEPARATOR ',') as ingredients, SUM(batches.in_stock) as in_stock FROM `product_types` left join ingredients on ingredients.product_type_id_parent = product_types.product_type_id left join product_types as p2 on p2.product_type_id = ingredients.product_type_id_sub left join batches on batches.product_type_id = product_types.product_type_id where expiration_date > NOW() OR expiration_date is null group by product_types.product_type_id order by product_types.name;");
        return $query->getResultArray();
    }

    public function getProduct($product_type_id){
        $query = $this->db->query("Select * from product_types where product_type_id = $product_type_id;");
        return $query->getRowArray();
    }

    public function getOpenOrders() {
        $query = $this->db->query("SELECT * FROM orders left join order_products on order_products.order_id = orders.order_id left join product_types on product_types.product_type_id = order_products.product_type_id WHERE status != 'delivered' ORDER BY order_datetime;");
        return $query->getResultArray();
    }

    public function updateProduct($vals){
        $query = $this->db->query("UPDATE `product_types` SET `name` = '".$vals['name']."', `price_per_unit` = '".$vals['price_per_unit']."', `is_meal` = '".$vals['is_meal']."', `unit_symbol` = '".$vals['unit_symbol']."', `enabled` = '".$vals['enabled']."' WHERE `product_types`.`product_type_id` = ".$vals['product_type_id']);
        return $query;
    }

}
