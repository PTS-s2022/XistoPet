<?php

namespace app\libs\authenticate;

use app\database\models\Client;
use app\database\models\User;

class Register
{
  public readonly User $user;
  public readonly Client $client;

  public function __construct()
    {
      $this->user = new User;
      $this->client = new Client;
    }

  public function verifyData(array $data){
    //verifica se os campos estão preenchidos corretamente
    if(empty($data['nome']) || empty($data['email']) || empty($data['senha']) || empty($data['senhaRep'])){
      return "Preencha os campos corretamente!!";
    }

    $curl = curl_init();

    curl_setopt_array($curl,[
      CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => [
        'secret' => '6Lf4nI8qAAAAAH98CwsR9Tvh0GDYXM5rQGkIXoTr',
        'response' => $data['response'] ?? ''
      ]
    ]);

    $response = curl_exec($curl);
    
    curl_close($curl);

    $responseArray = json_decode($response, true);

    $success = $responseArray['success'] ?? false;

    if(!$success){
      return 'Preencha a caixa "não sou robo" corretamente';
    }

    //verifica o email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      return "Esse endereço de e-mail é considerado válido.";
    }
    
    //verifica se a senha possui mais de o 8 caracteres
    if(strlen($data['senha']) < 8){
      return "Preencha a senha com mais de 8 caracteres";
    }
    
    //verifica se as senhas digitadas são iguais
    if($data['senha'] != $data['senhaRep']){
      return "Senhas incompativeis!!";
    }
    
    //verifica se esse usuario já existe
    $userFound = $this->user->findBy("email", $data['email'], null);
    if($userFound){
      return "Esse usuário já existe";
    }

    return false;
  }

  public function encryptPass($senha){
    return password_hash($senha, PASSWORD_DEFAULT);
  }
  
  public function register(array $data){
    //registrando usuario
    $this->user->insert($data);
    //buscando id user
    $d = $this->user->findBy("email", $data['email'], null);
    $data['idUser'] = $d[0]->id; 
    //registrando cliente
    $this->client->insert($data);
  }

}