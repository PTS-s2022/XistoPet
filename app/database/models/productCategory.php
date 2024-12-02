<?php

namespace app\database\models;

use app\database\Connect;

class ProductCategory extends Model
{
    protected string $table = 'tb_categoria';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(categoria) 
                                values(
                                    :categoria
                                )");

            return $prepare->execute([
                ':categoria' =>  $data['name']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function select(array $data){
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT * FROM $this->table WHERE categoria = :category AND ativo = :active ORDER BY id DESC");
            $prepare->execute([
                ':category' =>  $data['name'],
                ':active' => 1
            ]);

            return $prepare->fetchAll();
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function update(array $data){
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE $this->table SET imagem = :image, categoria = :category WHERE id = :idCategory");

            return $prepare->execute([
                ':idCategory' =>  $data['idCategory'],
                ':image' =>  $data['image'],
                ':category' =>  $data['category']

            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function delete(array $data){
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("DELETE FROM $this->table WHERE id = :idCategory");

            return $prepare->execute([
                ':idCategory' =>  $data['idCategory']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function updateImage(array $data){
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE $this->table SET imagem = :image WHERE id = :idCategory");

            return $prepare->execute([
                ':idCategory' =>  $data['idCategory'],
                ':image' =>  $data['image'],

            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

}