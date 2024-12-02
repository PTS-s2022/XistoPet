<?php

namespace app\libs\client;

use app\database\models\Client as modelsClient;
use app\database\models\ClientFavorite as modelsClientFavorite;
use app\libs\product\DisplayProduct;

Class ClientFavorite
{
  public readonly modelsClient $client;
  public readonly modelsClientFavorite $clientFavorite;
  public readonly DisplayProduct $product;

  public function __construct()
  {
    $this->client = new modelsClient;
    $this->clientFavorite = new modelsClientFavorite;
    $this->product = new DisplayProduct;

  }

  public function crudFavorite($data){
    $verifyData = $this->verifyData($data);
    if($verifyData){
      return $verifyData;
    }

    $value = [
      'idProduct' => $data['idProduct'],
      'idClient' => $data['idClient']
    ];

    $foundFavorite = $this->selectFavorite($value);
    if(!$foundFavorite){
      $data['switch'] = 'add';
    }
    else{
      $data['switch'] = 'delete';
    }

    switch ($data['switch']) {
      case 'add':
        $value = [
          'idProduct' => $data['idProduct'],
          'idClient' => $data['idClient']
        ];

        $this->clientFavorite->insert($value);
        break;
      
      case 'delete':
        $value = [
          'idFavorite' => $foundFavorite['id']
        ];

        $this->clientFavorite->delete($value);
        break;
    }
    

  }


  public function verifyData($data){
    $value = [
      'idProduct' => $data['idProduct']
    ];
    $foundProduct = $this->product->dataProduct($value);
    if(!$foundProduct){
      return [
        'ERROR' => 'Produto não existe'
      ];
    }

  }

  public function selectFavorite($data){
    $foundFavorite = $this->clientFavorite->selectFavorite($data);
    if(!$foundFavorite){
      return false;
    }
    $data['favorite'] = [
      'id' => $foundFavorite[0]->id,
      'product' => $foundFavorite[0]->produto
    ];

    
    return $data['favorite'];
  }


  public function dataFavorite($data){
    $value = [
      'idClient' => $data['idClient']
    ];
    $foundFavorites = $this->clientFavorite->select($value);

    if(!$foundFavorites){
      return false;
    }
    foreach ($foundFavorites as $k => $favorite) {
      $value = [
        'idProduct' => $favorite->produto
      ];

      $foundProduct = $this->product->selectProduct($value);
      
      $data['favorite'][$k] = [
        'idFavorite' => $favorite->id,
        'product' => $foundProduct
      ];
    }

    return $data['favorite'];
  }
  
}