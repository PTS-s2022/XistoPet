<?php

namespace app\database\models;

use app\database\Connect;

class ProductComment extends Model
{
    protected string $table = 'tb_produto_comentario';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(avaliacao, comentario, produtoTamanho, produtoCor, itemVenda, produto) 
                                values(
                                    :avaliacao,
                                    :comentario,
                                    :produtoTamanho,
                                    :produtoCor,
                                    :itemVenda,
                                    :produto
                                )");

            return $prepare->execute([
                ':avaliacao' =>  $data['assess'],
                ':comentario' => $data['comment'],
                ':produtoTamanho' =>  $data['productSize'],
                ':produtoCor' => $data['productColor'],
                ':itemVenda' =>  $data['saleItem'],
                ':produto' => $data['product'],
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function selectComment(mixed $value)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where produto = :product ORDER BY id DESC LIMIT ". $value['limit']);
            $prepare->execute([
                ':product' => $value['idProduct']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function selectComments(mixed $value)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where produto = :product ORDER BY id DESC");
            $prepare->execute([
                ':product' => $value['idProduct']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function select(mixed $value)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where produto = :product");
            $prepare->execute([
                ':product' => $value['idProduct']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function selectAssess(array $value)
    {
        try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("select count(avaliacao) as avaliacao from $this->table where produto = :idProduct");
        $prepare->execute([ 
            ":idProduct" => $value['idProduct']
        ]);

        return $prepare->fetchAll();
        } catch (\Throwable $th) {
        var_dump($th->getMessage());
        }

    }

}