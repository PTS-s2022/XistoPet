<?php

namespace app\libs\sale;

use app\database\models\ProductStock;
use app\libs\sale\Sale as Sale;
use app\database\models\Sale as modelsSale;
use app\database\models\SaleItem as modelsSaleItem;
use app\database\models\SaleStatus as modelsSaleStatus;
use app\libs\client\Client;
use app\libs\product\DisplayProduct;

Class SaleMenager
{
  public readonly Sale $sale;
  public readonly modelsSale $saleModels;
  public readonly modelsSaleItem $saleItem;
  public readonly modelsSaleStatus $saleStatus;
  public readonly DisplayProduct $product;
  public readonly ProductStock $productStock;
  public readonly Client $client;


  public function __construct()
  {
    $this->sale = new Sale;
    $this->saleModels = new modelsSale;
    $this->saleItem = new modelsSaleItem;
    $this->saleStatus = new modelsSaleStatus;
    $this->product = new DisplayProduct;
    $this->productStock = new ProductStock;

  }

  public function displaySale(){
    $data['sale'] = $this->dataSales();
    if(!$data['sale']){
      return false;
    }

    $data['sale'] = $this->dataSaleItems($data);

    return $data['sale'];
  }


  public function updateSale($data){
    $data['sale'][0] = $this->dataSale($data);
    if(!$data['sale']){
      return true;
    }
    $data['sale'] = $this->dataSaleItems($data);


    if($data['sale']['status'] == $data['form']['status'] || !$data['form']['status']){
      return true;
    }

    
    $value = [
      'idSale' => $data['form']['idSale'],
      'status' => $data['form']['status']
    ];
    
    $this->saleModels->updateSaleMenager($value);

    $client = new Client;
    switch ($value['status']) {
      case '3':
        $value = [
          'type' => 2,
          'saleItem' => null,
          'sale' => $data['form']['idSale'],
          'idClient' => $data['sale'][0]['client']
        ];

        $client->aadNotification($value);
        break;
      
      case '4':
        $value = [
          'type' => 3,
          'saleItem' => null,
          'sale' => $data['form']['idSale'],
          'idClient' => $data['sale'][0]['client']
        ];

        $client->aadNotification($value);
        break;
      case '5':
        $value = [
          'type' => 4,
          'saleItem' => null,
          'sale' => $data['form']['idSale'],
          'idClient' => $data['sale'][0]['client']
        ];

        $client->aadNotification($value);

        foreach ($data['sale'][0]['item'] as $k => $item) {

          $value = [
            'type' => 1,
            'saleItem' => $item['id'],
            'sale' => null,
            'idClient' => $data['sale'][0]['client']
          ];
          $client->aadNotification($value);
 
        }
        break;
    }


    
  }


  public function deleteSale($data){
    $data['sale'][0] = $this->dataSale($data);
    if(!$data['sale']){
      return true;
    }
    $data['sale'] = $this->dataSaleItems($data);

    foreach ($data['sale'][0]['item'] as $k => $item) {

      $value = [
        'idProductSize' => $item['product']['size']['id']
      ];

      $foundStock = $this->productStock->findBy('produto', $value['idProductSize']);
      if(!$foundStock){
        echo 'aqui';
      }
      $value = [
        'idProductSize' => $foundStock[0]->produto,
        'stock' => $foundStock[0]->qtdtotal + $item['quantity']
      ];

      $this->productStock->update($value);

    }

    $value = [
      'idSale' => $data['form']['idSale']
    ];
    
    $this->saleModels->deleteSaleMenager($value);
    

    $client = new Client;

    $value = [
      'type' => 5,
      'saleItem' => null,
      'sale' => $data['sale'][0]['id'],
      'idClient' => $data['sale'][0]['client']
    ];

    $client->aadNotification($value);
    
  }



  public function dataSales(){
    $foundSale = $this->saleModels->selectSalesMenager();
    if(!$foundSale){
      return false;
    }

    foreach ($foundSale as $k => $sale) {
      if($sale->status == 1){
        continue;
      }
      $status = $this->saleStatus->findBy('id', $sale->status);


      $data['sale'][$k] = [
        'id' => $sale->id,
        'priceTotal' => $sale->valorTotal,
        'status' => $status[0]->status,
        'saleDate' => $sale->dateVenda,
        'deliveryDate' => $sale->dateEntrega
      ];
    }
    return $data['sale'];

  }


  public function dataSale($data){
    $value = [
      'idSale' => $data['form']['idSale']
    ];
    $foundSale = $this->saleModels->selectSaleMenager($value);
    if(!$foundSale){
      return false;
    }

    $data['sale'] = [
      'id' => $foundSale[0]->id,
      'priceTotal' => $foundSale[0]->valorTotal,
      'status' => $foundSale[0]->status,
      'saleDate' => $foundSale[0]->dateVenda,
      'deliveryDate' => $foundSale[0]->dateEntrega,
      'client' => $foundSale[0]->cliente
    ];
    
    return $data['sale'];

  }


  public function dataSaleItems($data){
    
    foreach ($data['sale'] as $k => $sale) {
  
      $value = [
        'idSale' => $sale['id']
      ];

      $foundSaleItem = $this->saleItem->selectItem($value);
      if(!$foundSaleItem){
        return false;

      }
      
      foreach ($foundSaleItem as $a => $saleItem) {
        $value = [
          'idProductSize' => $saleItem->produto
        ];
        $foundProduct = $this->product->selectProduct1($value);


        $data['sale'][$k]['item'][$a] = [
          'id' => $saleItem->id,
          'quantity' => $saleItem->quantidade,
          'price' => $saleItem->subTotal,
          'assess' => $saleItem->avaliar,
          'product' => $foundProduct
        ];

      } 
    }
    return $data['sale'];

    
  }

  public function dataSaleItem($data){
      $value = [
        'idSale' => $data['sale']['id']
      ];

      $foundSaleItem = $this->saleItem->selectItem($value);
      if(!$foundSaleItem){
        return false;

      }
      
      foreach ($foundSaleItem as $a => $saleItem) {
        $value = [
          'idProductSize' => $saleItem->produto
        ];
        $foundProduct = $this->product->selectProduct1($value);


        $data['sale']['item'][$a] = [
          'id' => $saleItem->id,
          'quantity' => $saleItem->quantidade,
          'price' => $saleItem->subTotal,
          'assess' => $saleItem->avaliar,
          'product' => $foundProduct
        ];

      } 
    
    return $data['sale'];

    
  }
}
    