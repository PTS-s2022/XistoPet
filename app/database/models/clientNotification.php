<?php

namespace app\database\models;

use app\database\Connect;

class ClientNotification extends Model
{
    protected string $table = 'tb_cliente_notificacao';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(tipo, venda, itemVenda, client) 
                                values(
                                    :type,
                                    :saleItem,
                                    :sale,
                                    :idClient
                                )");

            return $prepare->execute([
                ':type' =>  $data['type'],
                ':saleItem' => $data['saleItem'],
                ':sale' =>  $data['sale'],
                ':idClient' => $data['idClient']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

}