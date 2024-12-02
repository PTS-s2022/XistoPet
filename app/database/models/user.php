<?php

namespace app\database\models;

use app\database\Connect;

class User extends Model
{
    protected string $table = 'tb_usuario';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(email,senha,sub) values(:email,:senha,:sub)");

            return $prepare->execute([
                ':email' => $data['email'],
                ':senha' => $data['senha'],
                ':sub' => $data['sub']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function updatePassword(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE $this->table SET senha = :password WHERE id = :idUser");

            return $prepare->execute([
                ':idUser' => $data['idUser'],
                ':password' => $data['password']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }


    public function updateToken(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE $this->table SET token = :token, expiry = :expiry WHERE email = :email");

            return $prepare->execute([
                ':email' => $data['email'],
                ':token' => $data['tokenHash'],
                ':expiry' => $data['expiry']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function select($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT * FROM $this->table where id = :idUser");
            $prepare->execute([
                ":idUser" => $data['idUser']
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    public function selectEmail($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT * FROM $this->table where email LIKE :email");
            $prepare->execute([
                ":email" => $data['email'] . '%'
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

}