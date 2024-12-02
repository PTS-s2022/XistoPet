<?php

namespace app\database\models;

use app\database\Connect;

abstract class Model
{
    protected string $table;

    public function findBy(string $field, mixed $value)
    {
        // $limit = "";
        // $like = "";
        // $execute = [];
        // $sql = "select * from $this->table where ";
        // if ($parameter != null) {
        //     if($parameter['limit'] != null){
        //         $limit = "LIMIT :limit";
        //         $execute[":limit"] = $parameter['limit'];
        //     }

        //     if($parameter['like'] != null){
        //         $like = $parameter['like']['field'] . " LIKE :like" ;
        //         $execute[":like"] = $parameter['like']['value'];
        //     }

        // }
        // if (is_array($fields)){
        //     $i = count($fields);
        //     $i--;
        //     foreach ($fields as $k => $field) {
        //         if($i = $k){
        //             $sql .= "$field = :$field ";
        //         }
        //         else{
        //             $sql .= "$field = :$field AND ";
        //         }
        //         $execute[":field"] = $values[":field"];
        //     }

        // }
        // else{
        //     $sql .= "$fields = :$fields";
        //     $execute[":$fields"] = $values;
        // }
        
        //$sql .= "$like $limit";

        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where $field = :$field");
            $prepare->execute([
                ":$field" => $value
            ]);

            return $prepare->fetchAll();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }
    
}
