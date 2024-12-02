<?php

use app\libs\admin\Admin;

require_once("../vendor/autoload.php");
require_once("../config.php");
require_once("..\bug\phpMailer\phpMailer.php");


$admin = new Admin;

session_start();
if($_SERVER['REQUEST_METHOD'] != "POST"){
  die("acesso negado.");
}

if(!isset($_SESSION['user']['admin'])){
  header("Location: index.php");
  die();
}

$data['switch'] = $_POST['switch'];


switch ($data['switch']) {
  case 'add':
    $data['form'] = [
      'name' => $_POST['name'],
      'cpf' => $_POST['cpf'],
      'number' => $_POST['number'],
      'email' => $_POST['email'],
      'level' => $_POST['level']
    ];

    $admin->addAdmin($data);

    break;
  case 'alter':
    $data['form'] = [
      'idAdmin' => $_POST['idAdmin'],
      'level' => $_POST['level']
    ];

    $admin->alterAdmin($data);

    break;
  case 'delete':
    $data['form'] = [
      'idAdmin' => $_POST['idAdmin']
    ];

    $admin->deleteAdmin($data);

    break;
  default:
    # code...
    break;
}

header('Location: ../public/adminGerenciar.php');