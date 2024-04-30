<?php

namespace App\Controllers;
use App\Models\MainModel;

class Orders extends BaseController
{

    public function __construct(){
        $this->MainModel = new MainModel();
    }

    public function getIndex(){
        $data['orders'] = $this->MainModel->getOpenOrders();

        echo view("templates/header", ['title'=>'Bestellungen', 'description'=>'Anzeige aller noch offener Bestellungen']);
        echo view("pages/orders", $data);
        echo view("templates/footer");
    }

}
