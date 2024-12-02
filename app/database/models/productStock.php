<?php

namespace app\database\models;

use app\database\Connect;

class ProductStock extends Model
{
    protected string $table = 'tb_produto_estoque';

    public function insert(array $data)
    {
        try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("insert into $this->table(produto) values(:product)");

        return $prepare->execute([
            ':product' => $data['product']
            ]);
        } catch (\PDOException $th) {
        var_dump($th->getMessage());
        }
    }

    public function select(array $data){
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT * FROM $this->table WHERE produto = :product AND ativo = :active ORDER BY id DESC");
            $prepare->execute([
                ':product' =>  $data['product'],
                ':active' => 1
            ]);

            return $prepare->fetchAll();
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function update(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE tb_produto_estoque 
                                        SET qtdtotal = :stock
                                        WHERE produto = :idProduct");

            return $prepare->execute([
                ":stock" => $data['stock'],
                ":idProduct" => $data['idProductSize']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

}