<?php 

namespace app\libs\product;

use app\database\models\ProductStock as ModelsProductStock;
use app\database\models\SupplierStock as ModelsSupplierStock;

class ProductStock
{

  public readonly ModelsProductStock $productStock;
  public readonly ModelsSupplierStock $supplierStock;

  public function __construct()
  {
    $this->productStock = new ModelsProductStock;
    $this->supplierStock = new ModelsSupplierStock;
  }

  public function addStock($data){
    if(!$data['form']['idSupplier']){
        return 'Selecione um fornecedor!';
    }

    foreach ($data['form']['size'] as $k => $size) {
        if($size['stock']){
            $foundStock = $this->productStock->findBy('produto', $size['id']);

            $value = [
                'idSupplier' => $data['form']['idSupplier'],
                'idProductSizeStock' => $foundStock[0]->id,
                'stock' => $size['stock']
            ];
            $this->supplierStock->insert($value);

            $ammountStock = $foundStock[0]->qtdtotal;

            $ammountStock += $size['stock'];

            $value = [
                'idProductSize' => $size['id'],
                'stock' => $ammountStock
            ];
            $this->productStock->update($value);

        }
        
    }

  }

}
