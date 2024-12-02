<?php

namespace app\libs\cart;

use app\database\models\Sale;
use app\database\models\SaleItem;
use app\libs\client\Client;
use app\libs\product\DisplayProduct;

Class Cart
{
  public readonly DisplayProduct $displayProduct;
  public readonly Sale $sale;
  public readonly SaleItem $saleItem;
  public readonly Client $client;

  public function __construct()
  {
    $this->client = new Client;
    $this->sale = new Sale;
    $this->saleItem = new SaleItem;
    $this->displayProduct = new DisplayProduct;
  }


  public function displayCart($data){

    $data['cart'] = $this->dataCart($data);

    $data['cart'] = $this->dataCartItem($data);

    if(isset($data['cart']['address'])){
      $value = [
        'idAddress' => $data['cart']['address'],
        'idClient' => $data['idClient']
      ];
      
      $foundAddress = $this->client->dataAddress($value);


        if ($foundAddress) {
          $data['cart']['address'] = [
            'id' => $foundAddress[0]->id,
            'neighborhood' => $foundAddress[0]->bairro,
            'complement' => $foundAddress[0]->complemento,
            'publicPlace' => $foundAddress[0]->logradouro,
            'city' => $foundAddress[0]->cidade,
            'state' => $foundAddress[0]->estado,
            'cep' => $foundAddress[0]->cep,
            'number' => $foundAddress[0]->numero
          ];
        }
    
    }

    return $data;
  }


  public function addProductCart($data){
    $verifyData = $this->verifyData($data);
    if($verifyData){
      return [
        'ERROR' => $verifyData 
      ];
    }

    $data['cart'] = $this->dataCart($data);
    
    $data['productSize'] = $this->displayProduct->dataProductSize($data);
    $value = [
      "idSale" => $data['cart']['idCart'],
      "idProductSize" => $data['idProductSize'],
      'amount' => $data['amount'],
      'priceTotal' => $data['productSize']['price'] * $data['amount']
    ];
    $saleItemFound = $this->saleItem->selectSaleItem($value);
    
    if(!$saleItemFound){
      $this->saleItem->insert($value);
    }
    else{
      if (isset($data['op'])) {
        $value['amount'] = $saleItemFound[0]->quantidade;
        $value['amount']--;
      }
      else {
        $value['amount'] += $saleItemFound[0]->quantidade;
      }
      
      $value['idSaleItem'] = $saleItemFound[0]->id;
      $value['priceTotal'] = $data['productSize']['price'] * $value['amount'];


      $verifyData = $this->verifyData($value);
      if($verifyData){
       return [
         'ERROR' => $verifyData 
        ];
      }

      $this->saleItem->update($value);
    }

    return $data;
  }


  public function deleteProductCart($data) {
    $data['cart'] = $this->dataCart($data);

    $value = [
      'idProductSize' => $data['idProductSize'],
      'idSale' => $data['cart']['idCart']
    ];

    $cartItemFound = $this->saleItem->selectSaleItem($value);

    $value['idSaleItem'] = $cartItemFound[0]->id; 

    $this->saleItem->delete($value);
  }


  public function deleteProductCartAll($data){
    $data['cart'] = $this->dataCart($data);

    $cartItemFound = $this->saleItem->findBy('venda', $data['cart']['idCart']);
    if(!$cartItemFound){
      return false;
    }
    echo"a";
    foreach ($cartItemFound as $k => $item) {
      $value = [
        'idSaleItem' => $item->id
      ];

      $this->saleItem->delete($value);
    }
  }


  public function verifyData($data){
    if(empty($data['idProductSize']) || empty($data['amount'])){
      return 'Preencha os dados corretamentes';
    }

    if(!is_numeric($data['amount']) || $data['amount'] < -1 || str_contains($data['amount'], ".")){
      return 'quantidade inválida';
    }

    $verifySize = $this->displayProduct->verifySize($data);
    if(!$verifySize){
      return 'Produto não encontrado';
    }

    $verifyStock = $this->displayProduct->dataStock($data);
    if($verifyStock < $data['amount']){
      return 'Quantidade inválida';
    }


  }

  public function verifyDataStock($data){

    $verifyStock = $this->displayProduct->dataStock($data);

    if($verifyStock < $data['amount']){
      return $verifyStock;
    }

  }

  public function dataCart($data){
    $value = [
      'status' => 1,
      'idClient' => $data['idClient']
    ];

    $cartFound = $this->sale->selectSale($value);
    if (!$cartFound) {
      $this->sale->insert($data);
      $cartFound = $this->sale->selectSale($value);
    }

    $data['cart'] = [
      'idCart' => $cartFound[0]->id,
      'method' => $cartFound[0]->metodo,
      'address' => $cartFound[0]->endereco,
      'totalPrice' => 0,
      'totalAmount' => 0,
      'saleDate' => $cartFound[0]->dateVenda
    ];

    return $data['cart'];
  }


  public function dataCartItem($data){
    $cartItemFound = $this->saleItem->findBy('venda', $data['cart']['idCart']);
    if(!$cartItemFound){
      return false;
    }
  
    foreach ($cartItemFound as $k => $item) {
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

      //verifica se o estoque condiz com a quantidade desse produto 
      $verifyDataStock = $this->displayProduct->dataStock($value);

      if($verifyDataStock < $value['amount']){
        $value['amount'] = $verifyDataStock;
        $value['priceTotal'] = $dataProduct['size']['price'] * $value['amount'];  


        $this->saleItem->update($value);
      }

      $dataProduct['size']['stock'] = $this->displayProduct->dataStock($value);

      $data['cart']['item'][$k] = [
        'idCardItem' => $item->id, 
        'amount' => $value['amount'],
        'priceSubTotal' => $value['priceTotal'],
        'productSize' => $dataProduct['size'],
        'product' => $dataProduct['product']
      ];

      $data['cart']['totalItem'] = count($data['cart']['item']); 
      $data['cart']['totalAmount'] += $value['amount'];
      $data['cart']['totalPrice'] += $value['priceTotal'];
       
    }

    return $data['cart'];
  }
}