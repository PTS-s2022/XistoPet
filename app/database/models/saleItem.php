<?php

namespace app\database\models;

use app\database\Connect;

class SaleItem extends Model
{
    protected string $table = 'tb_venda_item';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(quantidade, subTotal, venda, produto) values(:quantidade, :subTotal, :venda, :produto)");

            return $prepare->execute([
                ":quantidade" => $data['amount'],
                ":subTotal" => $data['priceTotal'],
                ":venda" => $data['idSale'],
                ":produto" => $data['idProductSize']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function selectSaleItem(mixed $value)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where produto = :produto AND venda = :venda");
            $prepare->execute([
                ":produto" => $value['idProductSize'],
                ":venda" => $value['idSale']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function selectItem(mixed $value)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where venda = :venda");
            $prepare->execute([
                ":venda" => $value['idSale']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function selectItem1(mixed $value)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where id = :idSaleItem and avaliar = :assess");
            $prepare->execute([
                ":idSaleItem" => $value['idSaleItem'],
                ":assess" => 0
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    public function update(array $value)
    {
      try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("UPDATE $this->table SET quantidade = :quantidade, subTotal = :subTotal WHERE id = :id");
        $prepare->execute([
            ":id" => $value['idSaleItem'],
            ":quantidade" => $value['amount'],
            ":subTotal" => $value['priceTotal']
        ]);

        return $prepare->fetchAll();
      } catch (\Throwable $th) {
          var_dump($th->getMessage());
      }
    }


    public function updateAssess(array $value)
    {
      try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("UPDATE $this->table SET avaliar = :assess WHERE id = :id");
        $prepare->execute([
            ":id" => $value['idSaleItem'],
            ":assess" => 1
        ]);

        return $prepare->fetchAll();
      } catch (\Throwable $th) {
          var_dump($th->getMessage());
      }
    }


    public function delete(array $value)
    {
      try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("DELETE FROM $this->table WHERE id = :id");
        $prepare->execute([
            ":id" => $value['idSaleItem']
        ]);

        return $prepare->fetchAll();
      } catch (\Throwable $th) {
          var_dump($th->getMessage());
      }
    }

}