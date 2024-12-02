<?php

namespace app\libs\client;

use app\database\models\Client as modelsClient;
use app\database\models\ClientAddress as modelsClientAddress;
use app\database\models\ClientCard as modelsClientCard;


Class ClientAddress
{
  public readonly modelsClient $client;
  public readonly modelsClientAddress $clientAddress;
  public readonly modelsClientCard $clientCard;

  public function __construct()
  {
    $this->client = new modelsClient;
    $this->clientAddress = new modelsClientAddress;
    $this->clientCard = new modelsClientCard;

  }

  public function insertAddress($data){
    $verifyData = $this->verifyDataAdd($data);
    if($verifyData){
      return $verifyData;
    }

    if(empty($data['address']['complement'])){
      $data['address']['complement'] = null;
    }

    if($data['address']['addressDisable']){
      $this->clientAddress->update($data);
      
    }
    
    $this->clientAddress->insert($data);

  }

  public function deleteAddress($data){
    $verifyData = $this->verifyDataDelete($data);
    if($verifyData){
      return $verifyData;
    }

    $this->clientAddress->update($data);
  }

  public function verifyDataAdd($data){

    if(empty($data['address']['cep']) || empty($data['address']['state']) ||
    empty($data['address']['city']) || empty($data['address']['neighborhood']) || empty($data['address']['publicPlace']) ||
    empty($data['address']['number'])){

      return [
        "ERROR" => "Preencha os campos corretamente!!"
      ];
      
    }
    
    if($data['address']['addressDisable']){
      $value = [
        'idClient' => $data['idClient'],
        'idAddress' => $data['address']['addressDisable']
      ];

      $data['addressVerify'] = $this->selectAddress($value);

      if(!$data['addressVerify']){
        return [
          "ERROR" => "Endereço não encontrado"
        ];
      }

      if($data['address']['cep'] == $data['addressVerify']['cep'] &&
      $data['address']['state'] == $data['addressVerify']['state'] && 
      $data['address']['city'] == $data['addressVerify']['city'] && 
      $data['address']['neighborhood'] == $data['addressVerify']['neighborhood'] &&
      $data['address']['publicPlace'] == $data['addressVerify']['publicPlace'] && 
      $data['address']['number'] == $data['addressVerify']['number'] &&
      $data['address']['complement'] == $data['addressVerify']['complement']){
        
        return [
          "ERROR" => "Dados iguais"
        ];
      }
      
    }

  }

  public function verifyDataDelete($data){
    $value = [
      'idClient' => $data['idClient'],
      'idAddress' => $data['address']['addressDisable']
    ];

    $data['addressVerify'] = $this->selectAddress($value);
  
    if(!$data['addressVerify']){
      return [
        "ERROR" => "Endereço não encontrado"
      ];
    }
  }

  public function selectAddress($data){
    $foundAddress = $this->clientAddress->selectAddress($data);
    if(!$foundAddress){
      return false;
    }
    $data['address'] = [
      'cep' => $foundAddress[0]->cep,
      'state' => $foundAddress[0]->estado,
      'city' => $foundAddress[0]->cidade,
      'neighborhood' => $foundAddress[0]->bairro,
      'publicPlace' => $foundAddress[0]->logradouro,
      'number' => $foundAddress[0]->numero,
      'complement' => $foundAddress[0]->complemento
    ];

    
    return $data['address'];
  }


}