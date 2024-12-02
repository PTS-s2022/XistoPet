<?php

namespace app\libs\sale;

use app\database\models\ProductStock;
use app\database\models\Sale as modelsSale;
use app\database\models\SaleItem as modelsSaleItem;
use app\database\models\SaleStatus as modelsSaleStatus;
use app\libs\cart\Cart;
use app\libs\client\Client;
use app\libs\product\DisplayProduct;


Class Sale
{
  public readonly Cart $cart;
  public readonly Client $client;
  public readonly modelsSale $sale;
  public readonly modelsSaleItem $saleItem;
  public readonly modelsSaleStatus $saleStatus;
  public readonly DisplayProduct $displayProduct;
  public readonly ProductStock $productStock;

  public function __construct()
  {
    $this->sale = new modelsSale;
    $this->saleItem = new modelsSaleItem;
    $this->saleStatus = new modelsSaleStatus;
    $this->client = new Client;
    $this->cart = new Cart;
    $this->displayProduct = new DisplayProduct;
    $this->productStock = new ProductStock;
    
  }


  public function finishSale($data){
    $data = $this->cart->displayCart($data);
    $data['client'] = $this->client->dataClient($data);
    $data['switch'] = $this->verifySale($data);

    switch ($data['switch']['switch']) {
      case 'product':

        $data['switch'] = [
            'switch' => $data['switch'],
            'location' => "carrinho.php"
        ];
        return $data['switch'];
        die();

        break;
      case 'address':

        if(!isset($data['form']['address'])){
          $data['switch'] = [
              'switch' => $data['switch'],
              'location' => "venda.php"
          ];
          return $data['switch'];
        }
        $value = [
          'id' => $data['cart']['idCart'],
          'totalPrice' => $data['cart']['totalPrice'],
          'address' => $data['form']['address'],
          'method' =>  $data['cart']['method'],
          'card' =>  $data['cart']['method'],
          'status' =>  1,
          'date' => $data['cart']['saleDate']
         ];
        $this->sale->update($value);
        

        break;
      case 'cpf':
        if(!$data['form']['cpf']){
          $data['switch'] = [
            'switch' => 'cpf',
            'location' => 'venda.php'
          ];
          return $data['switch'];
        }

        $this->client->updateClient($data);

        break;
      case 'paymentMethod':
        if(!isset($data['form']['method'])){
          $data['switch'] = [
            'switch' => 'paymentMethod',
            'location' => 'venda.php'
          ];
          return $data['switch'];
        }
        $status = 3;
        if(!isset($data['form']['card'])){
          $data['form']['card'] = null;
          $status = 2;
        }

        $value = [
          'id' => $data['cart']['idCart'],
          'totalPrice' => $data['cart']['totalPrice'],
          'address' => $data['cart']['address']['id'],
          'method' =>  $data['form']['method'],
          'card' =>  $data['form']['card'],
          'status' =>  $status,
          'saleDate' => date('Y-m-d')
        ];

        $this->sale->update($value);

        foreach ($data['cart']['item'] as $item ) {
          $value = [
            'idProductSize' => $item['productSize']["idProductSize"],
            'idSaleItem' => $item['idCardItem'],
          ];

          $verifyDataStock = $this->displayProduct->dataStock($value);
          $verifyDataStock -= $item['amount'];

          $value['stock'] = $verifyDataStock;
          
          $this->productStock->update($value);
        }


        $data['switch'] = [
          'switch' => $data['switch'],
          'location' => "vendaFinalizada.php?idSale=" . $data['cart']['idCart']
        ];
        return $data['switch'];

        break;
      case 'finish':

        $data['switch'] = [
          'switch' => $data['switch'],
          'location' => "venda.php?"
        ];
        return $data['switch'];

        
        break;
      default:
        # code...
        break;
    }
    return $data['switch'];




    // $data['cart']['totalPrice'] = 0;
    // foreach ($data['cart']['item'] as $key => $item) {
    //   // verifica se o produto está diponivel
    //   if(!$item['amount']){
    //     return [
    //       'ERROR' => "Produto indisponivel"
    //     ];
    //   }
    //   $data['cart']['totalPrice'] += $item['priceSubTotal'];
    // }


  }

  public function verifySale($data){

    $data['client'] = $this->client->dataClient($data);

    if(!isset($data['cart']['item'])){
      $data['switch'] = [
        'switch' => 'product',
        'location' => 'venda.php'
      ];
      return $data['switch'];
      die();
    }
    foreach ($data['cart']['item'] as $key => $item) {
      // verifica se o produto está diponivel
      if(!$item['amount']){
        $data['switch'] = [
          'switch' => 'product',
          'location' => 'venda.php'
        ];
        return $data['switch'];
        die();
      }
    }


    if(!$data['cart']['address'] || isset($data['switch']) || isset($data['form']['address'])){
      $data['switch'] = [
        'switch' => 'address',
        'location' => 'venda.php'
      ];

      return $data['switch'];
      die();
    }
    if(!$data['client']['cpf']){
      $data['switch'] = [
        'switch' => 'cpf',
        'location' => 'venda.php'
      ];
      return $data['switch'];
      die();
    }

    $data['switch'] = [
      'switch' => 'paymentMethod',
      'location' => 'venda.php'
    ];
    return $data['switch'];
    die();

  }

  public function payment($data){
    $value = [
      'idClient' => $data['idClient'],
      'idSale' => $data['idSale'],
      'status' => 2
    ];
    $data['sale'] = $this->sale->select($value);
    if (!$data['sale']) {
      header('Location: ../public/index.php');
    }

    $saleItemFound = $this->saleItem->findBy('venda', $data['idSale']);
    if(!$saleItemFound){
      return false;
    }
  
    foreach ($saleItemFound as $k => $item) {
      $value = [
        'idProductSize' => $item->produto,
        'idSaleItem' => $item->id,
        'amount' => $item->quantidade,
        'priceTotal' => $item->subTotal
      ];

      //seleciona os dados do tamanho do produto
      $dataProduct['size'] = $this->displayProduct->dataProductSize($value);

      //seleciona os dados do produto 
      $dataProduct['product'] = $this->displayProduct->dataProduct($dataProduct['size']);
      $dataProduct['product'] = [
        'idProduct' => $dataProduct['product']['idProduct'],
        'name' => $dataProduct['product']['name'],
      ];
      
      $dataProduct['product']['image'] = $this->displayProduct->dataImage($dataProduct['product']);

      $dataProduct['product']['image'] = $dataProduct['product']['image'][0];

      $data['sale']['item'][$k] = [
        'idCardItem' => $item->id, 
        'amount' => $value['amount'],
        'priceSubTotal' => $value['priceTotal'],
        'productSize' => $dataProduct['size'],
        'product' => $dataProduct['product']
      ];

      $data['sale']['totalItem'] = count($data['sale']['item']); 
      $data['sale']['totalAmount'] = $value['amount'];
      $data['sale']['totalPrice'] = $value['priceTotal'];
       
    }

    
    
    return $data['sale'];
  }


  public function displaySale($data){
    $data['sale'] = $this->dataSale($data);
    if(!$data['sale']) {
      return false;
    }
    $data['sale'] = $this->dataSaleItems($data);

    return $data['sale'];
  }

  public function displaySaleItem($data){
    $foundSaleItem = $this->saleItem->findBy('id', $data['idSaleItem']);
    if(!$foundSaleItem) {
      return false;
    }

    $foundSale = $this->sale->findBy('id', $foundSaleItem[0]->venda);
    if(!$foundSale) {
      return false;
    }

    $value = [
      'idProductSize' => $foundSaleItem[0]->produto
    ];
    $foundProduct = $this->displayProduct->selectProduct1($value);


    $data['sale'] = [
      'saleDate' => $foundSale[0]->dateVenda,
      'deliveryDate' => $foundSale[0]->dateEntrega,
      'item' => [
        'id' => $foundSaleItem[0]->id,
        'quantity' => $foundSaleItem[0]->quantidade,
        'price' => $foundSaleItem[0]->subTotal,
        'assess' => $foundSaleItem[0]->avaliar,
        'product' => $foundProduct
        ]
    ];
    return $data['sale'];
  }


  public function dataSale($data){
    $foundSale = $this->sale->selectSales($data);
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
        $foundProduct = $this->displayProduct->selectProduct1($value);


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
    
    $foundSaleItem = $this->saleItem->selectItem1($data);
    if(!$foundSaleItem){
      return false;

    }

    $foundSale = $this->sale->findBy('id',  $foundSaleItem[0]->venda);
    if($foundSale[0]->cliente != $data['idClient']){
      return false;
    }

    $value = [
      'idProductSize' => $foundSaleItem[0]->produto
    ];
    $foundProduct = $this->displayProduct->selectProduct1($value);


    $data['item'] = [
      'id' => $foundSaleItem[0]->id,
      'quantity' => $foundSaleItem[0]->quantidade,
      'price' => $foundSaleItem[0]->subTotal,
      'product' => $foundProduct
    ];

    return $data['item'];

    
  }


  public function updateAssess($data){
    $this->saleItem->updateAssess($data);

  }

}

  