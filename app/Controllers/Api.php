<?php

namespace App\Controllers;
use App\Models\MainModel;
use CodeIgniter\HTTP\ResponseInterface;

class Api extends BaseController
{
    public function __construct(){
        $this->mainModel = new MainModel();
        $this->apiKey = "12345";
    }

    private function checkApiKey($key){
        if($key != $this->apiKey){
            return false;
        }
        return true;
    }

    private function getResponse($responseBody, $code = ResponseInterface::HTTP_OK){
        return $this->response->setStatusCode($code)->setJSON($responseBody);
    }

    public function getMenu($key=null){
        if($this->checkApiKey($key)){
            $data['products'] = $this->mainModel->getMenu();
            return $this->getResponse($data);
        }else{
            return $this->getResponse(['error'=>'API Key not valid'], ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }



}