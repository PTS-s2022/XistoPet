<?php

namespace app\database\models;

use app\database\Connect;

class ProductImage extends Model
{
    protected string $table = 'tb_produto_imagem';

    public function insert(array $data)
    {
        try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("insert into $this->table(produto,imagem) values(:product, :image)");

        return $prepare->execute([
            ':product' => $data['product'],
            ':image' => $data['image']
            ]);
        } catch (\PDOException $th) {
        var_dump($th->getMessage());
        }
    }

    public function selectMax(array $data){
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT imagem FROM $this->table WHERE produto = :product ORDER BY id DESC");
            $prepare->execute([
                ':product' =>  $data['product']
            ]);
    
            return $prepare->fetchAll();
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
      }

      public function delete(array $data)
    {
        try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("DELETE FROM $this->table WHERE id = :idImage");

        return $prepare->execute([
            ':idImage' => $data['idImage']
            ]);
        } catch (\PDOException $th) {
        var_dump($th->getMessage());
        }
    }

}