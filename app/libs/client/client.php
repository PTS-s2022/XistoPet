<?php

namespace app\libs\client;

use app\database\models\Client as modelsClient;
use app\database\models\ClientAddress as modelsClientAddress;
use app\database\models\ClientCard as modelsClientCard;
use app\libs\client\ClientFavorite as ClientFavorite;


Class Client
{
  public readonly modelsClient $client;
  public readonly modelsClientAddress $clientAddress;
  public readonly ClientNotification $clientNotification;
  public readonly modelsClientCard $clientCard;
  public readonly ClientFavorite $clientFavorite;

  public function __construct()
  {
    $this->client = new modelsClient;
    $this->clientAddress = new modelsClientAddress;
    $this->clientNotification = new ClientNotification;

    $this->clientCard = new modelsClientCard;
    $this->clientFavorite = new ClientFavorite;

  }

  public function displayClient($data){
    $data['client'] = $this->dataClient($data);

    $data['client']['address'] = $this->dataClientAddress($data);

    $data['client']['card'] = $this->dataClientCard($data);

    return $data['client'];
  }

  
  public function updateClient($data){
    if(!$data['form']['cpf']){
      return 'Preencha os campos corretamente';
    }
    
    $verifyCpf = $this->validaCPF($data['form']['cpf']);
    if(!$verifyCpf){
      return 'Cpf inválido';
    }

    $clientFound = $this->client->findBy('cpf', $data['form']['cpf']);
    if($clientFound){
      return [
        'ERROR' => 'Esse cpf já está cadastrado'
      ];
    }

    $this->client->update($data);
  
  }

  public function validaCPF($cpf) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

}

  public function dataClient($data){
    $data['client'] = $this->client->select($data);

    $data['client'] = [
      'id' => $data['client'][0]->id,
      'name' => $data['client'][0]->nome,
      'cpf' => $data['client'][0]->cpf,
    ];

    return $data['client'];
    
  }


  public function dataClientAddress($data){
    $data['client']['address'] = $this->clientAddress->select($data);
    
    return $data['client']['address'];
  }


  public function dataClientCard($data){
    $data['client']['card'] = $this->clientCard->select($data);

    return $data['client']['card'];

  }


  public function dataClientFavorite($data){
    $data['client']['favorite'] = $this->clientFavorite->dataFavorite($data);

    return $data['client']['favorite'];

  }


  public function dataAddress($data){
    $data['address'] = $this->clientAddress->selectAddress($data);

    return $data['address'];

  }

  public function dataNotification($data){
    $data['notification'] = $this->clientNotification->displayNotification($data);

    return $data['notification'];
    
  }
}