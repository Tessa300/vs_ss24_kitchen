<?php

namespace App\Controllers;
use App\Models\MainModel;

class Products extends BaseController
{

    public function __construct(){
        $this->mainModel = new MainModel();
    }

    private function returnView($product_type_id = null, $data = [])
    {
        if(is_null($product_type_id)){
            // Alle Produkte anzeigen
            $data['products']= $this->mainModel->getProducts();

            echo view('templates/header');
            echo view('pages/products', $data);
            echo view('templates/footer');
        }else{
            // Einzelnes Produkt anzeigen
            $data['product'] = $this->mainModel->getProduct($product_type_id);

            echo view('templates/header');
            echo view('pages/product', $data);
            echo view('templates/footer');
        }
    }

    public function getIndex($product_type_id = null)
    {
        $this->returnView($product_type_id);
    }

    public function postUpdate($product_type_id){
        // INFO: Werte aus Formular landen in $_POST
        if($this->validation->run($_POST, 'product')){
            // Model aktualisieren
            $_POST['product_type_id'] = $product_type_id;
            $this->mainModel->updateProduct($_POST);
            $this->returnView($product_type_id);
        }else{
            echo "Falsch";
            $data['errors'] = $this->validation->getErrors();
            $this->returnView($product_type_id, $data);
        }
    }



}
