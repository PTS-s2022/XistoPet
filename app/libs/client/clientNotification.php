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
    $this->clientNotificationType = new ModelsClientNotificationType;

  }

  public function displayNotifications($data){
    $value = [
      'idClient' => $data['idClient']
    ];
    $foundNotification = $this->clientNotification->selects($value);
    if(!$foundNotification){
      return false;
    }

    $data['notification'] = $this->dataNotification($foundNotification);

    return $data['notification'];
  }


  public function displayNotification($data){
    $value = [
      'idClient' => $data['idClient']
    ];
    $foundNotification = $this->clientNotification->select($value);
    if(!$foundNotification){
      return false;
    }

    $data['notification'] = $this->dataNotification($foundNotification);

    return $data['notification'];
  }


  public function addNotification($data){

    $value = [
      'type' => $data['type'],
      'saleItem' => $data['saleItem'],
      'sale' => $data['sale'],
      'idClient' => $data['idClient']
    ];

    $this->clientNotification->insert($value);
  }

  public function dataNotification($foundNotification){
    $sale = new Sale;
    foreach ($foundNotification as $k => $notification) {
      $foundNotificationType = $this->clientNotificationType->findBy('id', $notification->tipo);

      $data['notification'][$k] = [
        'type' => $foundNotificationType[0]->tipo,
        'date' => $notification->date
      ];
      
      if($notification->itemVenda){
        $data['notification'][$k]['item'] = $notification->itemVenda;

      }

      if($notification->venda){
        $value = [
          'idSale' => $notification->venda
        ];


        $data['notification'][$k]['sale'] = $notification->venda;
      }

    }

    return $data['notification'];
  }
}