<?php

namespace app\database\models;

use app\database\Connect;

class ClientFavorite extends Model
{
    protected string $table = 'tb_cliente_favorito';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(produto, cliente) 
                                values(
                                    :product,
                                    :client
                                )");

            return $prepare->execute([
                ':product' =>  $data['idProduct'],
                ':client' => $data['idClient'],

            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function delete(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("DELETE FROM $this->table WHERE id = :idFavorite");

            return $prepare->execute([
                ':idFavorite' =>  $data['idFavorite'],
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function select($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id, produto
                                        FROM $this->table where cliente = :cliente");
            $prepare->execute([
                ":cliente" => $data['idClient']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function selectFavorite($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id, 
                                            produto
                                        FROM $this->table where cliente = :cliente AND produto = :product");
            $prepare->execute([
                ":cliente" => $data['idClient'],
                ":product" => $data['idProduct']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }
}
