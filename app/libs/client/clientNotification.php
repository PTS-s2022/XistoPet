<?php


namespace app\libs\client;

use app\database\models\Client as modelsClient;
use app\database\models\ClientNotification as ModelsClientNotification;
use app\database\models\ClientNotificationType as ModelsClientNotificationType;

use app\libs\sale\Sale as Sale;

Class ClientNotification
{
  public readonly modelsClient $client;
  public readonly ModelsClientNotification $clientNotification;
  public readonly ModelsClientNotificationType $clientNotificationType;


  public function __construct()
  {
    $this->client = new modelsClient;
    $this->clientNotification = new ModelsClientNotification;

  }

  public function displayNotification($data){
    $foundNotification = $this->clientNotification->findBy('cliente', $data['idClient']);
    if(!$foundNotification){
      return false;
    }
    $sale = new Sale;
    foreach ($foundNotification as $k => $notification) {
      $foundNotificationType = $this->clientNotificationType->findBy('id', $notification->tipo);

      $data['notification'][$k] = [
        'type' => $foundNotificationType[0]->tipo
      ];
      
      if($notification->itemVenda){
        $value = [
          'idSaleItem' => $notification->itemVenda
        ];
        $foundItem = $sale->displaySaleItem($value);

        $data['notification'][$k]['item'] = $foundNotificationType[0]->tipo;

      }

      if($notification->venda){
        $data['notification'][$k]['sale'] = $foundNotificationType[0]->tipo;
      }

    }

    return $data['notification'];
  }

  
}