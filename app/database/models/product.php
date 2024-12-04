<?php

namespace app\database\models;

use app\database\Connect;

class Product extends Model
{
  protected string $table = 'tb_produto';

  public function insert(array $data)
  {
    try {
      $connect = Connect::connect();
      $prepare = $connect->prepare("insert into $this->table(nome,categoria,descricao,tamanho) values(:name,:category,:description, :size)");

      return $prepare->execute([
          ':name' => $data['name'],
          ':category' => $data['category'],
          ':description' => $data['description'],
          ':size' => $data['size']
        ]);
      } catch (\PDOException $th) {
        var_dump($th->getMessage());
      }
  }

  public function select(array $data){
    try {
        $connect = Connect::connect();
        $prepare = $connect->prepare("SELECT * FROM $this->table WHERE nome = :name AND ativo = :active ORDER BY id DESC");
        $prepare->execute([
            ':name' =>  $data['name'],
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
                                      SET nome = :name,
                                          descricao = :description,
                                          categoria = :category
                                      WHERE id = :idProduct");

          return $prepare->execute([
              ":name" => $data['name'],
              ":description" => $data['description'],
              ":category" => $data['category'],
              ":idProduct" => $data['idProduct']
          ]);
      } catch (\PDOException $th) {
          var_dump($th->getMessage());
      }
  }


  public function updateCategory(array $data)
  {
      try {
          $connect = Connect::connect();
          $prepare = $connect->prepare("UPDATE  $this->table
                                      SET categoria = :category
                                      WHERE id = :idProduct");

          return $prepare->execute([
              ":category" => null,
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


  public function selectProduct(array $value)
  {
    $field = [
      0 => "categoria",
      1 => "ativo",
      2 => "avaliacao",
    ];
    try {
      $connect = Connect::connect();
      $prepare = $connect->prepare("select * from $this->table where " . $field[0] ." = :". $field[0] ." AND ". $field[1] ." = :" . $field[1] . " ORDER BY " . $field[2] . " DESC LIMIT " . $value['limit']);
      $prepare->execute([ 
          ":" . $field[0] => $value[0],
          ":" . $field[1] => 1
      ]);

      return $prepare->fetchAll();
    } catch (\Throwable $th) {
      var_dump($th->getMessage());
    }

  }

  public function selectProduct1(array $value)
  {
    try {
      $connect = Connect::connect();
      $prepare = $connect->prepare("select * from $this->table where categoria = :categoria AND ativo = :ativo ORDER BY avaliacao DESC");
      $prepare->execute([ 
          ":categoria" => $value['category'],
          ":ativo" => 1
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
      $prepare = $connect->prepare("select avaliacao from $this->table where id = :idProduct");
      $prepare->execute([ 
          ":idProduct" => $value['idProduct']
      ]);

      return $prepare->fetchAll();
    } catch (\Throwable $th) {
      var_dump($th->getMessage());
    }

  }

  public function updateAssess(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("UPDATE  $this->table
                                        SET avaliacao = :assess
                                        WHERE id = :idProduct");

            return $prepare->execute([
                ":assess" => $data['assess'],
                ":idProduct" => $data['idProduct']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

    public function searchProduct(array $value)
  {
    try {
      $connect = Connect::connect();
      $prepare = $connect->prepare("select id from $this->table where nome LIKE :search AND ativo = :active");
      $prepare->execute([ 
          ":search" => $value['search'],
          ":active" => 1
      ]);

      return $prepare->fetchAll();
    } catch (\Throwable $th) {
      var_dump($th->getMessage());
    }

  }

  

}