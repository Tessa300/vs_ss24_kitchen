<?php
namespace App\Models;
use CodeIgniter\Model;

class MainModel extends Model
{

    public function getProducts(){
        $query = $this->db->query('SELECT * FROM product_types');
        return $query->getResultArray();
    }

}
