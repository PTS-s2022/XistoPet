<?php

namespace app\database\models;

use app\database\Connect;

class ClientAddress extends Model
{
    protected string $table = 'tb_cliente_endereco';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(cep,estado,cidade,bairro,logradouro,numero,complemento,cliente) 
                                values(
                                    :cep,
                                    :estado,
                                    :cidade,
                                    AES_ENCRYPT(:bairro, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    AES_ENCRYPT(:logradouro, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    AES_ENCRYPT(:numero, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    AES_ENCRYPT(:complemento, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    :cliente
                                )");

            return $prepare->execute([
                ':cep' =>  $data['address']['cep'],
                ':estado' => $data['address']['state'],
                ':cidade' =>  $data['address']['city'],
                ':bairro' => $data['address']['neighborhood'],
                ':logradouro' =>  $data['address']['publicPlace'],
                ':numero' => $data['address']['number'],
                ':complemento' =>  $data['address']['complement'],
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
            $prepare = $connect->prepare("UPDATE $this->table SET ativo = :active WHERE id = :idAddress");

            return $prepare->execute([
                ':idAddress' =>  $data['address']['addressDisable'],
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
                                            cep,
                                            estado,
                                            cidade,
                                            AES_DECRYPT(bairro, UNHEX(SHA2('". AES_KEY ."', 512))) bairro,
                                            AES_DECRYPT(logradouro, UNHEX(SHA2('". AES_KEY ."', 512))) logradouro,
                                            AES_DECRYPT(numero, UNHEX(SHA2('". AES_KEY ."', 512))) numero,
                                            AES_DECRYPT(complemento, UNHEX(SHA2('". AES_KEY ."', 512))) complemento
                                        FROM $this->table where cliente = :cliente AND ativo = :active");
            $prepare->execute([
                ":cliente" => $data['idClient'],
                ':active' => 1
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }


    public function selectAddress($data){

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("SELECT id, 
                                            cep,
                                            estado,
                                            cidade,
                                            AES_DECRYPT(bairro, UNHEX(SHA2('". AES_KEY ."', 512))) bairro,
                                            AES_DECRYPT(logradouro, UNHEX(SHA2('". AES_KEY ."', 512))) logradouro,
                                            AES_DECRYPT(numero, UNHEX(SHA2('". AES_KEY ."', 512))) numero,
                                            AES_DECRYPT(complemento, UNHEX(SHA2('". AES_KEY ."', 512))) complemento
                                        FROM $this->table where cliente = :cliente AND id = :id");
            $prepare->execute([
                ":cliente" => $data['idClient'],
                ":id" => $data['idAddress'],
                
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }
}
