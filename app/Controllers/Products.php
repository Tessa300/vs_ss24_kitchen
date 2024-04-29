<?php

namespace App\Controllers;
use App\Models\MainModel;

class Products extends BaseController
{

    public function __construct(){
        $this->MainModel = new MainModel();
    }

    public function getIndex()
    {
        $data['products']= $this->MainModel->getProducts();

        echo view('templates/header');
        echo view('pages/products', $data);
        echo view('templates/footer');
    }
}
