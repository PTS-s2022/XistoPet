<?php

namespace app\libs\admin;

use app\database\models\User as modelsUser;
use app\database\models\Admin as modelsAdmin;
use app\database\models\AdminLevel as modelsAdminLevel;
use UsedPhpMailer;

Class Admin
{
  public readonly modelsUser $user;
  public readonly modelsAdmin $admin;
  public readonly modelsAdminLevel $adminLevel;

  public function __construct()
  {
    $this->user = new modelsUser;
    $this->admin = new modelsAdmin;
    $this->adminLevel = new modelsAdminLevel;
  }

  public function displayAdminsType($data){
    $foundAdmin = $this->adminLevel->selects($data);
    if(!$foundAdmin){
      return false;
    }
    $data['adminLevel'] = [
      'level' => $foundAdmin[0]->nivel,
      'id' => $foundAdmin[0]->id
    ];
    return $data['adminLevel'];
  }

  public function displayAdmins($data){
    $foundAdmin = $this->admin->selects($data);
    if(!$foundAdmin){
      return false;
    }

    foreach ($foundAdmin as $k => $admin) {
      $value = [
        'idAdmin' => $admin->id
      ];

      $data['admin'][$k] = $this->dataAdmin($value);
    }

    return $data['admin'];
  }


  public function displayAdmin($data){
    $data['admin'] = $this->dataAdmin($data);

    return $data['admin'];
  }


  public function dataAdmin($data){
    $foundAdmin = $this->admin->select($data);
    if(!$foundAdmin){
      return false;
    }


    $value = [
      'idUser' => $foundAdmin[0]->usuario
    ];

    $foundUser = $this->user->select($value);
    

    $data['admin'] = [
      'id' => $foundAdmin[0]->id,
      'email' => $foundUser[0]->email,
      'idUser' => $foundUser[0]->id,
      'name' => $foundAdmin[0]->nome,
      'cpf' => $foundAdmin[0]->cpf,
      'telephone' => $foundAdmin[0]->telefone,
      'level' => $foundAdmin[0]->nivel
    ];

    return $data['admin'];
  }

  public function addAdmin($data){
    if(!$data['form']['email'] || !$data['form']['number'] || !$data['form']['name'] || !$data['form']['cpf'] || !$data['form']['level']){
      return 'Preencha os campos corretamente';
    }

    if (!filter_var($data['form']['email'], FILTER_VALIDATE_EMAIL)) {
      return "Esse endereço de e-mail é considerado válido.";
    }


    $verifyCpf = $this->validaCPF($data['form']['cpf']);
    if(!$verifyCpf){
      return 'Cpf inválido';
    }

    if(strlen($data['form']['number']) != 11){
      return 'Número inválido';
    }

    $password = $this->randomPassword();

    $passwordHash = password_hash($password, PASSWORD_DEFAULT); 

    $email = $this->generaterEmail($data['form']);

    $value = [
      'email' => $email,
      'senha' => $passwordHash,
      'sub' => NULL
    ];

    // registrando usuario
    $this->user->insert($value);

    //buscando id user
    $d = $this->user->findBy("email", $email, null);
    
    $value = [
      'idUser' => $d[0]->id,
      'name' => $data['form']['name'],
      'cpf' => $data['form']['cpf'],
      'number' => $data['form']['number'],
      'level' => $data['form']['level']
    ]; 

    //registrando cliente
    $this->admin->insert($value);
  
    $phpMailer = New UsedPhpMailer;

    $value = [
      'email' => $data['form']['email'] ,
      'subject' => 'Novo Acesso de Administrador no XistoPet',
      'message' => <<<END
              Olá,

              Gostaríamos de informar que um novo acesso de administrador foi criado para a plataforma XistoPet. Aqui estão os detalhes do seu login:

              E-mail: [$email]
              Senha: [$password]

              Por motivos de segurança, recomendamos que você altere sua senha assim que fizer o primeiro login.

              Caso não tenha solicitado esse acesso ou se suspeitar de qualquer atividade não autorizada, entre em contato conosco imediatamente.

              Se precisar de mais informações ou tiver alguma dúvida, nossa equipe de suporte está à disposição para ajudar.

              Atenciosamente,
              Equipe XistoPet
              telefone:(41 99171-3786)

            END,
      ];

    $phpMailer->sendMail($value);

  }

  public function alterAdmin($data){
    if(!$data['form']['idAdmin'] || !$data['form']['level']){
      return 'Preencha os campos corretamente';
    }

    $value = [
      'idAdmin' => $data['form']['idAdmin'],
      'level' => $data['form']['level']
    ];

    $this->admin->update($value);

  }

  public function deleteAdmin($data){
    if(!$data['form']['idAdmin']){
      return 'Preencha os campos corretamente';
    }

    $value = [
      'idAdmin' => $data['form']['idAdmin']
    ];

    $this->admin->delete($value);

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

  private function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); 
  }


  private function generaterEmail($data) {
    $name = strtolower($data['name']);
    $name = trim($name);
    $name = explode(' ', $name);
    $count = count($name);
    $count--;
    $email = $name[0] . '.' . $name[$count];
    $value = [
      'email' => $email . "%"
    ];
    $foundEmail = $this->user->selectEmail($value);

    $countEmail = count($foundEmail);

    $email = $email . $countEmail . "@xistopet.com";

    return $email;
  }


}