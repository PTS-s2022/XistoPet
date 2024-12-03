<?php

namespace app\database\models;

use app\database\Connect;

class Supplier extends Model
{
    protected string $table = 'tb_fornecedor';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(nome, cnpj, telefone) 
                                        values( AES_ENCRYPT(:name, UNHEX(SHA2('". AES_KEY ."', 512))),
                                                AES_ENCRYPT(:cnpj, UNHEX(SHA2('". AES_KEY ."', 512))),
                                                AES_ENCRYPT(:number, UNHEX(SHA2('". AES_KEY ."', 512)))
                                        )");

            return $prepare->execute([
                ':name' => $data['name'],
                ':cnpj' => $data['cnpj'],
                ':number' => $data['number']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function selects(){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id, 
                                            AES_DECRYPT(nome, UNHEX(SHA2('". AES_KEY ."', 512))) nome,
                                            AES_DECRYPT(cnpj, UNHEX(SHA2('". AES_KEY ."', 512))) cnpj,
                                            AES_DECRYPT(telefone, UNHEX(SHA2('". AES_KEY ."', 512))) telefone

                                        FROM $this->table where ativo = :active");
            $prepare->execute([
                'active' => 1
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
            $prepare = $connect->prepare("UPDATE $this->table SET nivel = :level WHERE id = :idAdmin");

            return $prepare->execute([
                ':idAdmin' => $data['idAdmin'],
                ':level' => $data['level']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function delete(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE $this->table SET ativo = :active WHERE id = :idSupplier");

            return $prepare->execute([
                ':idSupplier' => $data['idSupplier'],
                ':active' => 0
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

}