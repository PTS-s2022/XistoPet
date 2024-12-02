<?php

namespace app\database\models;

use app\database\Connect;

class ClientCard extends Model
{
    protected string $table = 'tb_cliente_cartao';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(numero,nomeTitular,validade,cvv,cliente) 
                                values(
                                    AES_ENCRYPT(:numero, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    AES_ENCRYPT(:nomeTitular, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    AES_ENCRYPT(:validade, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    AES_ENCRYPT(:cvv, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    :cliente
                                )");

            return $prepare->execute([
                ':numero' =>  $data['card']['number'],
                ':nomeTitular' => $data['card']['name'],
                ':validade' =>  $data['card']['validiti'],
                ':cvv' => $data['card']['cvv'],
                ':cliente' => $data['idClient'],
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function update(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE $this->table SET ativo = :active WHERE id = :idCard");

            return $prepare->execute([
                ':idCard' =>  $data['idCard'],
                ':active' => 0
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function select($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id, 
                                            AES_DECRYPT(numero, UNHEX(SHA2('". AES_KEY ."', 512))) numero,
                                            AES_DECRYPT(nomeTitular, UNHEX(SHA2('". AES_KEY ."', 512))) nomeTitular,
                                            AES_DECRYPT(validade, UNHEX(SHA2('". AES_KEY ."', 512))) validade,
                                            AES_DECRYPT(cvv, UNHEX(SHA2('". AES_KEY ."', 512))) cvv
                                        FROM $this->table where cliente = :cliente AND ativo = :ativo");
            $prepare->execute([
                ":cliente" => $data['idClient'],
                ':ativo' => 1
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }



    public function selectCard($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id, 
                                            AES_DECRYPT(numero, UNHEX(SHA2('". AES_KEY ."', 512))) numero,
                                            AES_DECRYPT(nomeTitular, UNHEX(SHA2('". AES_KEY ."', 512))) nomeTitular,
                                            AES_DECRYPT(validade, UNHEX(SHA2('". AES_KEY ."', 512))) validade,
                                            AES_DECRYPT(cvv, UNHEX(SHA2('". AES_KEY ."', 512))) cvv
                                        FROM $this->table where cliente = :cliente AND id = :id AND ativo = :active");
            $prepare->execute([
                ":cliente" => $data['idClient'],
                ":id" => $data['idCard'],
                ':active' => 1
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }
}
