<?php

namespace app\database\models;

use app\database\Connect;

class Client extends Model
{
    protected string $table = 'tb_cliente';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(nome,usuario) 
                                values(
                                    AES_ENCRYPT(:nome, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    :usuario
                                )");

            return $prepare->execute([
                ':nome' =>  $data['nome'],
                ':usuario' => $data['idUser']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function select($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id, 
                                            AES_DECRYPT(nome, UNHEX(SHA2('". AES_KEY ."', 512))) nome,
                                            AES_DECRYPT(cpf, UNHEX(SHA2('". AES_KEY ."', 512))) cpf
                                        FROM $this->table where id = :idCliente");
            $prepare->execute([
                ":idCliente" => $data['idClient']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function update($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE $this->table 
                                        SET cpf = AES_ENCRYPT(:cpf, UNHEX(SHA2('". AES_KEY ."', 512))) 
                                        WHERE id = :id ");
            $prepare->execute([
                ":id" => $data['idClient'],
                ":cpf" => $data['form']['cpf']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

}