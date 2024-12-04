<?php

namespace app\libs\payment;

use Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;


Class payment
{
  public readonly Payload $payload;
 
  public function displayPix($data){
    // instancia principal do pay load pix
    $obPayload = (new Payload) -> setPixKey('+5541991713786')
    -> setdescription('Compra realizada no site XistoPet')
    -> setMerchantName('Matheus Vieira Rodrigues')
    -> setMerchantCity('CORONEL MACEDO')
    -> setamount($data['price'])
    -> settxid($data['idSale']);


    // codigo de pagamento PIX
    $payloadQrCode = $obPayload -> getPayload();

    // qr code
    $obQrCode = new QrCode($payloadQrCode);

    // gera a imagem do qr code
    $image = (new Output\Png)->output($obQrCode,400);

    $data['pix'] = [
      'image' => $image,
      'key' => $payloadQrCode
    ];
    
    return $data['pix'];
  }
}
