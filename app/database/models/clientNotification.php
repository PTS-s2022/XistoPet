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
            $prepare = $connect->prepare("insert into $this->table(tipo, venda, itemVenda, cliente) 
                                values(
                                    :type,
                                    :sale,
                                    :saleItem,
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

    public function selects($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT * FROM $this->table where cliente = :cliente ORDER BY id DESC");
            $prepare->execute([
                ":cliente" => $data['idClient']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    public function select($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT * FROM $this->table where cliente = :cliente ORDER BY id DESC limit 5");
            $prepare->execute([
                ":cliente" => $data['idClient']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


}