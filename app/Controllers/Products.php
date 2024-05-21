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
            if($product_type_id != 'new') {
                $data['product'] = $this->mainModel->getProduct($product_type_id);
                $data['canBeDeleted'] = $this->mainModel->canProductBeDeleted($product_type_id);
            }
            $data['unit_symbols'] = ['kg', 'l', 'Stk.', 'Port.'];

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
            $data['errors'] = $this->validation->getErrors();
            $this->returnView($product_type_id, $data);
        }
    }

    public function postCreate(){
        if($this->validation->run($_POST, 'product')){
            $product_type_id = $this->mainModel->createProduct($_POST);
            $this->returnView($product_type_id);
        }else{
            $data['errors'] = $this->validation->getErrors();
            $this->returnView("new", $data);
        }
    }

    public function getDelete($product_type_id){
        $this->mainModel->deleteProduct($product_type_id);
        return redirect()->to(site_url('products/'));
    }



}
