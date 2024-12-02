<?php

namespace app\database\models;

use app\database\Connect;

class Sale extends Model
{
    protected string $table = 'tb_venda';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(cliente, status) values(:client, :status)");

            return $prepare->execute([
                ":client" => $data['idClient'],
                ":status" => 1
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    //client
    public function selectSale(mixed $value)
    {
        $field = ['cliente', 'status'];
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where cliente = :cliente AND status = :status");
            $prepare->execute([
                ":cliente" => $value['idClient'],
                ":status" => $value['status']
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
            $prepare = $connect->prepare("select * from $this->table where cliente = :cliente AND status = :status AND id = :id");
            $prepare->execute([
                ":cliente" => $value['idClient'],
                ":status" => $value['status'],
                ":id" => $value['idSale']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    
    public function selectSales(mixed $value)
    {
        $field = ['cliente', 'status'];
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where cliente = :cliente ORDER BY dateVenda DESC");
            $prepare->execute([
                ":cliente" => $value['idClient']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function update(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE tb_venda 
                                        SET valorTotal = :totalPrice,
                                            endereco = :address,
                                            metodo = :method,
                                            cartao = :card,
                                            status = :status,
                                            dateVenda = :saleDate
                                        WHERE id = :id");

            return $prepare->execute([
                ":totalPrice" => $data['totalPrice'],
                ":address" => $data['address'],
                ":method" => $data['method'],
                ":card" => $data['card'],
                ":id" => $data['id'],
                ":status" => $data['status'],
                ":saleDate" => $data['saleDate']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    //admin

    public function selectSalesMenager()
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where status != :status ORDER BY dateVenda DESC");
            $prepare->execute([
                ":status" => 1
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    
    public function selectSaleMenager(mixed $value)
    {
        $field = ['cliente', 'status'];
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where id = :idSale");
            $prepare->execute([
                ":idSale" => $value['idSale']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function updateSaleMenager(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE tb_venda 
                                        SET status = :status
                                        WHERE id = :idSale");

            return $prepare->execute([
                ":idSale" => $data['idSale'],
                ":status" => $data['status']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function deleteSaleMenager(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("DELETE FROM tb_venda WHERE id = :idSale");

            return $prepare->execute([
                ":idSale" => $data['idSale']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


}