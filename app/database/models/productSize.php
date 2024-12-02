<?php

namespace app\database\models;

use app\database\Connect;

class ProductSize extends Model
{
  protected string $table = 'tb_produto_tamanho';

  public function insert(array $data)
  {
    try {
      $connect = Connect::connect();
      $prepare = $connect->prepare("insert into $this->table(tamanho,preco,produto) values(:size,:price,:product)");

      return $prepare->execute([
          ':size' => $data['size'],
          ':price' => $data['price'],
          ':product' => $data['product']
        ]);
    } catch (\PDOException $th) {
      var_dump($th->getMessage());
    }
  }

  public function select(array $data){
    try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("SELECT * FROM $this->table WHERE produto = :product AND ativo = :active ORDER BY id DESC");
        $prepare->execute([
            ':product' =>  $data['product'],
            ':active' => 1
        ]);

        return $prepare->fetchAll();
    } catch (\PDOException $th) {
        var_dump($th->getMessage());
    }
  }

  public function update(array $data)
  {
      try {
          $connect = Connect::connect();
          $prepare = $connect->prepare("UPDATE  $this->table
                                      SET preco = :price
                                      WHERE id = :idProduct");

          return $prepare->execute([
              ":price" => $data['price'],
              ":idProduct" => $data['idProduct']
          ]);
      } catch (\PDOException $th) {
          var_dump($th->getMessage());
      }
  }

  public function delete(array $data)
  {
      try {
          $connect = Connect::connect();
          $prepare = $connect->prepare("UPDATE  $this->table
                                      SET ativo = :active
                                      WHERE id = :idProduct");

          return $prepare->execute([
              ":idProduct" => $data['idProduct'],
              ":active" => 0
          ]);
      } catch (\PDOException $th) {
          var_dump($th->getMessage());
      }
  }

  public function selectProductSize(string $value)
  {
    $field = [
      0 => "produto",
      1 => "ativo",
    ];
    try {
      $connect = Connect::connect();
      $prepare = $connect->prepare("select MAX(preco) as max, MIN(preco) as min from $this->table where " . $field[0] ." = :". $field[0] ." AND ". $field[1] ." = :" . $field[1]);
      $prepare->execute([ 
          ":" . $field[0] => $value,
          ":" . $field[1] => 1
      ]);

      return $prepare->fetchAll();
    } catch (\Throwable $th) {
      var_dump($th->getMessage());
    }
  
    }

}