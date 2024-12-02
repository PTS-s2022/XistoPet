<?php

namespace app\database\models;

use app\database\Connect;

class AdminLevel extends Model
{
    protected string $table = 'tb_administrador_nivel';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table() values()");

            return $prepare->execute();
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function select($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT * FROM $this->table where id = :idAdminLevel");
            $prepare->execute([
                ":idAdminLevel" => $data['idAdminLevel']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function selects($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT * FROM $this->table where");
            $prepare->execute([]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

}