<?php

namespace app\libs\authenticate;

use app\database\models\Admin;
use app\database\models\Client;
use app\database\models\User;

class Login
{
  public readonly User $user;
  private array $data;


  public function __construct()
  {
    $this->user = new User;
  }


  public function authGoogle($data)
  {
      $user = new User;
      $userFound = $user->findBy('email', $data->email, null);

      if (!$userFound) {
        $d = [
          'nome' => $data->name,
          'email' => $data->email,
          'sub' => $data->id,
          'senha' => NULL
        ];
        $register = new Register;
        $register->register($d);
        $userFound = $user->findBy('email', $data->email, null);
      }

      $d = [
        'email' => $data->email,
        'idUser' => $userFound[0]->id
      ];
      $this->data = $d;

      $this->auth();
  }


  public function auth()
  {
    $this->data['level'] = $this->findLevel();


    $_SESSION['user']['email'] = $this->data['email'];
    $_SESSION['user']['id'] = $this->data['idUser'];
    $_SESSION['user']['nivel'] = $this->data['level']['level'];
    $_SESSION['user']['client'] = $this->data['level']['idClient'];
    $_SESSION['user']['admin'] = $this->data['level']['idAdmin'];

    $control = $this->header();
    $_SESSION['CONTROL'] = false;
    header($control);
  }


  public function verifyData(array $data){
    //verifica se os campos estão preenchidos corretamente
    if(empty($data['email']) || empty($data['senha'])){
      return "Preencha os campos corretamente!!";
    }

    //verifica o email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      return "Esse endereço de e-mail é considerado válido.";
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
    var_dump($success);
    if(!$success){
      return 'Preencha a caixa "não sou robo" corretamente';
    }

    //verifica se esse usuario já existe
    $userFound = $this->user->findBy("email", $data['email'], null);
    if(!$userFound){
      return "Esse usuário não existe";
    }

    //verifica se a senha está correta
    if(!password_verify($data['senha'], $userFound[0]->senha))
    {
      return "Senha incorreta";
    }

    

    $data['idUser'] = $userFound[0]->id;
    $this->data = $data;

    return false;
  }


  public function findLevel(){
    $client = new Client;
    $foundClient = $client->findBy("usuario", $this->data['idUser'], null);
    if($foundClient){
      return [
        'level' => 1,
        'idClient' => $foundClient[0]->id,
        'idAdmin' => NULL
      ];
    }

    $admin = new Admin;
    $foundAdmin = $admin->findBy("usuario", $this->data['idUser'], null);
    
    return[
      'level' => $foundAdmin['0']->nivel,
      'idAdmin' => $foundAdmin[0]->id,
      'idClient' => NULL
    ]; 
     
  }


  public function header(){
    switch ($_SESSION['CONTROL']) {
      case 'carrinho':

        return "Location: ../public/carrinho.php";
        break;
      
      case 'addProduto':

        return  "Location: ..\private\adicionaProdCarrinho.php";
        break;
        case 'notificacoes':

          return "notificacoes.php";
          break;      
      default:

          return"Location: ../public/index.php";
        break;
    }
  }


  public function logout()
  {
      unset($_SESSION['user'], $_SESSION['auth']);
      header('Location:/');
  }

}
