<?php

namespace app\libs\supplier;

use app\database\models\Supplier as ModelsSupplier;


Class Supplier
{
  public readonly ModelsSupplier $supplier;


  public function __construct()
  {
    $this->supplier = new ModelsSupplier;

  }


  public function displaySuppliers(){
    $foundSupplier = $this->supplier->selects();
    if(!$foundSupplier){
      return false;
    }

    foreach ($foundSupplier as $k => $supplier) {
      $data['supplier'][$k] = [
        'id' => $supplier->id,
        'telephone' => $supplier->telefone,
        'cnpj' => $supplier->cnpj,
        'name' => $supplier->nome
      ];
    }

    return $data['supplier'];
  }


  public function addSupplier($data){
    if(!$data['form']['name'] || !$data['form']['cnpj'] || !$data['form']['number']){
      return 'Preencha os campos corretamente';
    }


    $verifyCnpj = $this->validar_cnpj($data['form']['cnpj']);
    if(!$verifyCnpj){
      return 'Cnpj inválido';
    }


    $value = [
      'name' => $data['form']['name'],
      'cnpj' => $data['form']['cnpj'],
      'number' => $data['form']['number']
    ]; 

    //registrando fornecedor
    $this->supplier->insert($value);

  }


  public function deleteSupplier($data){
    if(!$data['form']['idSupplier']){
      return 'Preencha os campos corretamente';
    }

    $value = [
      'idSupplier' => $data['form']['idSupplier']
    ];

    $this->supplier->delete($value);

  }


  function validar_cnpj($cnpj)
  {
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
    
    // Valida tamanho
    if (strlen($cnpj) != 14)
      return false;
  
    // Verifica se todos os digitos são iguais
    if (preg_match('/(\d)\1{13}/', $cnpj))
      return false;	
  
    // Valida primeiro dígito verificador
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
    {
      $soma += $cnpj[$i] * $j;
      $j = ($j == 2) ? 9 : $j - 1;
    }
  
    $resto = $soma % 11;
  
    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
      return false;
  
    // Valida segundo dígito verificador
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
    {
      $soma += $cnpj[$i] * $j;
      $j = ($j == 2) ? 9 : $j - 1;
    }
  
    $resto = $soma % 11;
  
    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
  }
  


}