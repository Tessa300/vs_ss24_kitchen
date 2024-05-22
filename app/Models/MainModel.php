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

    public function updateOrderProductFinished($order_id, $product_type_id){
        $query = $this->db->query("UPDATE `order_products` SET `status` = 'delivered' WHERE `order_products`.`order_id` = $order_id AND `order_products`.`product_type_id` = $product_type_id;");
    }

    public function updateProduct($vals){
        $query = $this->db->query("UPDATE `product_types` SET `name` = '".$vals['name']."', `price_per_unit` = '".$vals['price_per_unit']."', `is_meal` = '".$vals['is_meal']."', `unit_symbol` = '".$vals['unit_symbol']."', `enabled` = '".$vals['enabled']."' WHERE `product_types`.`product_type_id` = ".$vals['product_type_id']);
        return $query;
    }

    public function createProduct($vals){
        $query = $this->db->query("INSERT INTO `product_types` (`product_type_id`, `name`, `price_per_unit`, `is_meal`, `unit_symbol`, `enabled`) VALUES (NULL, '".$vals['name']."', '".$vals['price_per_unit']."', '".$vals['is_meal']."', '".$vals['unit_symbol']."', '".$vals['enabled']."');");
        return $this->db->insertID();
    }

    public function canProductBeDeleted($product_type_id){
        $query = $this->db->query("Select * from order_products, batches, ingredients 
where order_products.product_type_id = $product_type_id or batches.product_type_id = $product_type_id or 
      ingredients.product_type_id_parent = $product_type_id or 
      ingredients.product_type_id_sub = $product_type_id;");
        return $query->getNumRows() == 0;
    }

    public function deleteProduct($product_type_id){
        if($this->canProductBeDeleted($product_type_id)){
            $query = $this->db->query("DELETE FROM `product_types` WHERE `product_type_id` = $product_type_id");
            return $query;
        }
        return false;
    }

    public function getMenu(){
        $query = $this->db->query("SELECT 	product_type_id, name, price_per_unit, image_path, unit_symbol 
FROM 
	(SELECT product_types.*, SUM(batches.in_stock) AS in_stock, ingredients.amount 
	FROM product_types 
		LEFT JOIN ingredients on ingredients.product_type_id_parent = product_types.product_type_id 
		JOIN batches on ingredients.product_type_id_sub = batches.product_type_id
	WHERE enabled = 1 AND is_meal = 1 AND expiration_date > NOW()
	GROUP BY product_types.product_type_id, ingredients.product_type_id_sub) AS stocks
WHERE 	in_stock >= amount
GROUP BY product_type_id;");
        return $query->getResultArray();
    }

}
