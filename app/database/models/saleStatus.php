<?php

namespace app\database\models;

use app\database\Connect;

class SaleStatus extends Model
{
    protected string $table = 'tb_venda_status';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(status) values(:status)");

            return $prepare->execute([
                ":status" => $data['idClient']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function select()
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id, status FROM $this->table ");
            $prepare->execute([]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }






}