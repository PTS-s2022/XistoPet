<?php

namespace app\libs\user;

use app\database\models\User as ModelsUser;
use UsedPhpMailer as UsedPhpMailer;

Class User
{
  public readonly ModelsUser $user;


  public function __construct()
  {
    $this->user = new ModelsUser;
  }


  public function displayClient($data){
    $data['user'] = $this->dataUser($data);

    return $data['user'];
  }


  public function dataUser($data){
    $data['user'] = $this->user->findBy('id', $data['idUser']);

    $data['user'] = [
      'id' => $data['user'][0]->id,
      'email' => $data['user'][0]->email
    ];

    return $data['user'];
    
  }


  public function alterPassword($data){
    $verifyData = $this->verifyDataPass($data);
    if($verifyData){
      return $verifyData;
    }

    $data['password'] = password_hash($data['form']['passwordNew'], PASSWORD_DEFAULT);

    $this->user->updatePassword($data);

    $phpMailer = New UsedPhpMailer;

    $value = [
      'email' => $data['email'] ,
      'subject' => 'Aviso de Alteração de Senha no XistoPet',
      'message' => <<<END
              Olá,

              Informamos que sua senha foi alterada com sucesso na plataforma XistoPet. Caso tenha sido você quem fez a alteração, não há motivo para preocupação.

              Se você não solicitou a alteração da senha, por favor, entre em contato conosco imediatamente. Para sua segurança, recomendamos que você faça login e altere sua senha o mais rápido possível.

              Se precisar de mais assistência ou tiver alguma dúvida, nossa equipe de suporte está à disposição para ajudá-lo.

              Atenciosamente,
              Equipe XistoPet
              telefone:(41 99171-3786)

            END,
      ];

    $phpMailer->sendMail($value);


  }


  public function verifyDataPass($data){
    //verifica se os dados foram preenchidos corretamente
    if(!$data['form']['password'] || !$data['form']['passwordNew'] || !$data['form']['passwordNewVerify'] || $data['form']['passwordNew'] != $data['form']['passwordNewVerify']){
      return  'Preencha os campos corretamente';
    }
    
    if(strlen($data['form']['passwordNew']) < 8){
      return "Preencha a senha com mais de 8 caracteres";
    }

    //verifica se esse usuario já existe
    $userFound = $this->user->findBy("id", $data['idUser']);
    if(!$userFound){
      return 'Esse usuário não existe'; 

    }

    //verifica se a senha está correta
    if(!password_verify($data['form']['password'], $userFound[0]->senha))
    {
      return 'Senha incorreta';
    }
  }

  public function forgotPassword($data){
    $verifyEmail = $this->verifyDataEmail($data);
    if($verifyEmail){
      return $verifyEmail;
    }

    $switch = $this->switchForgot($data);

    switch ($switch) {
      case 'forgot':
        $data['token'] = $this->randomPassword();
        $token = $data['token'];
        $data['tokenHash'] = password_hash($data['token'], PASSWORD_DEFAULT);

        $value =[
          'tokenHash' => password_hash($data['token'], PASSWORD_DEFAULT),
          'expiry' => date('Y-m-d H:i:s', time() + 60 * 15),
          'email' => $data['form']['email']
        ];
        
        $this->user->updateToken($value);

        $phpMailer = New UsedPhpMailer;

        $value = [
          'email' => $data['form']['email'],
          'subject' => 'Redefinição de Senha',
          'message' => <<<END
                  Olá,

                  Recebemos uma solicitação para redefinir a senha da sua conta. Se você fez essa solicitação, por favor, use o código abaixo para redefinir sua senha:

                  Código de Redefinição: $token

                END,
          ];

        $phpMailer->sendMail($value);

        return  [
          'location' => '../public/senhaEsqueceu.php?switch=token&&email=' . $data['form']['email']
        ];

        break;
      case 'token':
        if(!isset($data['form']['token'])){
          return  [
            'location' => '../public/senhaEsqueceu.php?switch=token&&email=' . $data['form']['email']
          ];
        }

        $userFound = $this->user->findBy("email", $data['form']['email']);

        if(!password_verify($data['form']['token'], $userFound[0]->token))
        {
          return  [
            'ERROR' => 'Token incorreto',
            'location' => '../public/senhaEsqueceu.php?switch=token&&email=' . $data['form']['email']
          ];
        }

        return  [
          'location' => '../public/senhaCodigo.php?token='. $data['form']['token'] .'&&email=' . $data['form']['email']
        ];
        break;
      case 'alter':
        if(empty($data['form']['passwordNew']) || empty($data['form']['passwordNewVerify'])){
          return  [
            'location' => '../public/senhaCodigo.php?token='. $data['form']['token'] .'&&email=' . $data['form']['email']
          ];
        }
        if(strlen($data['form']['passwordNew']) < 8){
          return  [
            'ERROR' => 'Preencha a senha com mais de 8 caracteres',
            'location' => '../public/senhaCodigo.php?token='. $data['form']['token'] .'&&email=' . $data['form']['email']
          ];
        }
        if($data['form']['passwordNew'] != $data['form']['passwordNewVerify']){
          return  [
            'ERROR' => 'Preencha os campos corretamente ',
            'location' => '../public/senhaCodigo.php?token='. $data['form']['token'] .'&&email=' . $data['form']['email']
          ];
        }

        $userFound = $this->user->findBy("email", $data['form']['email']);


        $value = [
          'password' => password_hash($data['form']['passwordNew'], PASSWORD_DEFAULT),
          'idUser' => $userFound[0]->id
        ];
        $this->user->updatePassword($value);
        
        $value =[
          'tokenHash' => NULL,
          'expiry' => NULL,
          'email' => $data['form']['email']
        ];
        
        $this->user->updateToken($value);

        return  [
          'location' => '../public/login.php'
        ];
        break;
    }
    

    


  }


  public function verifyDataEmail($data){
    //verifica se os dados foram preenchidos corretamente
    if(!$data['form']['email']){
      return  [
        'ERROR' => 'Preencha os campos corretamente',
        'location' => '../public/senhaEsqueceu.php'
      ];
    }


    //verifica se esse usuario já existe
    $userFound = $this->user->findBy("email", $data['form']['email']);
    if(!$userFound){
      return [
        'ERROR' => 'Esse email não foi cadastrado',
        'location' => '../public/senhaEsqueceu.php'
      ];

    }

  }

  public function switchForgot($data){
    $userFound = $this->user->findBy("email", $data['form']['email']);

    if($userFound[0]->expiry < date('Y-m-d H:i:s')){
      return 'forgot';
    }


    if(!isset($data['form']['token'])){
      return 'token';
    }


    if(!password_verify($data['form']['token'], $userFound[0]->token))
    {
      return 'token';
    }

    return 'alter';
    


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
}