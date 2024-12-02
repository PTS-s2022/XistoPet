<?php

namespace app\libs\client;

use app\database\models\Client as modelsClient;
use app\database\models\ClientCard as modelsClientCard;


Class ClientCard
{
  public readonly modelsClient $client;
  public readonly modelsClientCard $clientCard;

  public function __construct()
  {
    $this->client = new modelsClient;
    $this->clientCard = new modelsClientCard;

  }

  public function insertCard($data){
    $verifyData = $this->verifyData($data);
    if($verifyData){
      return $verifyData;
    }


    $this->clientCard->insert($data);

  }


  public function deleteCard($data){
    $verifyData = $this->verifyDataDelete($data);
    if($verifyData){
      return $verifyData;
    }

    $value = [
      'idCard' => $data['card']['cardDisable']
    ];
    
    $this->clientCard->update($value);
  }


  public function verifyData($data){

    if(empty($data['card']['number']) || empty($data['card']['name']) || empty($data['card']['validiti']) || empty($data['card']['cvv'])){

      return [
        "ERROR" => "Preencha os campos corretamente!!"
      ];
      
    }

  }

  public function verifyDataDelete($data){
    $value = [
      'idClient' => $data['idClient'],
      'idCard' => $data['card']['cardDisable']
    ];

    $data['cardVerify'] = $this->clientCard->selectCard($value);
  
    if(!$data['cardVerify']){
      return [
        "ERROR" => "Cartão não encontrado"
      ];
    }
  }


  public function selectCard($data){
    $foundCard = $this->clientCard->selectCard($data);
    if(!$foundCard){
      return false;
    }
    $data['card'] = [
      'number' => $foundCard[0]->numero,
      'nameHolder' => $foundCard[0]->nomeTitular,
      'validity' => $foundCard[0]->validade,
      'cvv' => $foundCard[0]->cvv,
    ];

    
    return $data['card'];
  }
  
}