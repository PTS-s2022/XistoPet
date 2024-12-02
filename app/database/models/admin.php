<?php

namespace app\database\models;

use app\database\Connect;

class Admin extends Model
{
    protected string $table = 'tb_administrador';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(nome, cpf, telefone, usuario, nivel) 
                                        values( AES_ENCRYPT(:name, UNHEX(SHA2('". AES_KEY ."', 512))),
                                                AES_ENCRYPT(:cpf, UNHEX(SHA2('". AES_KEY ."', 512))),
                                                AES_ENCRYPT(:number, UNHEX(SHA2('". AES_KEY ."', 512))),  
                                                :idUser,
                                                :level
                                        )");

            return $prepare->execute([
                ':name' => $data['name'],
                ':cpf' => $data['cpf'],
                ':number' => $data['number'],
                ':idUser' => $data['idUser'],
                ':level' => $data['level']
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
                                            AES_DECRYPT(cpf, UNHEX(SHA2('". AES_KEY ."', 512))) cpf,
                                            AES_DECRYPT(telefone, UNHEX(SHA2('". AES_KEY ."', 512))) telefone,
                                            nivel,
                                            usuario
                                        FROM $this->table where id = :idAdmin");
            $prepare->execute([
                ":idAdmin" => $data['idAdmin']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    public function selects($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id FROM $this->table WHERE id != :idAdmin");
            $prepare->execute([
                ':idAdmin' => $data['idAdmin']
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
            $prepare = $connect->prepare("DELETE FROM $this->table WHERE id = :idAdmin");

            return $prepare->execute([
                ':idAdmin' => $data['idAdmin']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

}