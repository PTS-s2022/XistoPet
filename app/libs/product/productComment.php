<?php 

namespace app\libs\product;

use app\libs\product\DisplayProduct as Product;
use app\database\models\Product as ModelsProduct;
use app\database\models\ProductComment as ModelsProductComment;
use app\database\models\ProductSize as ModelsProductSize;
use app\libs\client\Client;
use app\libs\sale\Sale;

class ProductComment
{
  public readonly Product $displayProduct;
  public readonly ModelsProduct $product;
  public readonly Sale $sale;
  public readonly ModelsProductSize $productSize;
  public readonly ModelsProductComment $productComment;
  public readonly Client $client;

  public function __construct()
  {
    $this->displayProduct = new Product;
    $this->sale = new Sale;
    $this->product = new ModelsProduct;
    $this->productSize = new ModelsProductSize;
    $this->productComment = new ModelsProductComment;
    $this->client = new Client;

  }


  public function comment($data){
    $verifyData = $this->verifyComment($data);
    if($verifyData){
      return $verifyData;
    }

    $value = [
      'idClient' => $data['idClient'],
      'idSaleItem' => $data['form']['saleItem'],
      'idProduct' => $data['form']['idProduct']
    ];
    $data['assess'] = $this->displayAssess($value);

    $value = [
      'idClient' => $data['idClient']
    ];
    $data['client'] = $this->client->dataClient($value);

    $value = [
      'assess' => $data['form']['assess'],
      'comment' => $data['form']['comment'],
      'saleItem' => $data['form']['saleItem'],
      'productSize' => $data['assess']['product']['size']['id'],
      'nameClient' => $data['client']['name'],
      'product' => $data['assess']['product']['id']
    ];

    $this->productComment->insert($value);

    $value = [
      'idSaleItem' => $data['form']['saleItem']
    ];

    $this->sale->updateAssess($value);


    $value = [
      'idProduct' => $data['assess']['product']['id']
    ];

    $countAssess = $this->productComment->selectAssess($value);

    $assess = $this->product->selectAssess($value);

    $sumAssess =  ($countAssess[0]->avaliacao * $assess[0]->avaliacao) + $data['form']['assess'];

    $countAssess[0]->avaliacao++;

    $mean = $sumAssess/$countAssess[0]->avaliacao;

    $value = [
      'assess' => $mean,
      'idProduct' => $data['assess']['product']['id']
    ];

    $this->product->updateAssess($value);

  }

  public function verifyComment($data){
    if(empty($data['form']['assess']) || empty($data['form']['comment']) || empty($data['form']['saleItem'])){
      return [
        'ERROR' => 'Preencha todos os campos'
      ] ;
    }

  }

  public function displayAssess($data){
    $foundSaleItem = $this->sale->dataSaleItem($data);
    if(!$foundSaleItem || $foundSaleItem['product']['id'] != $data['idProduct']){
      return false;
    }
    $data['assess'] = $foundSaleItem;

    return $data['assess'];
  }


}
