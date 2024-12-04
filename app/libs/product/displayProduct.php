<?php

namespace app\libs\product;

use app\database\models\Product;
use app\database\models\ProductCategory;
use app\database\models\ProductColor;
use app\database\models\ProductComment;
use app\database\models\ProductImage;
use app\database\models\ProductSize;
use app\database\models\ProductStock;

Class DisplayProduct
{
  public readonly Product $product;
  public readonly ProductStock $productStock;
  public readonly ProductImage $productImage;
  public readonly ProductSize $productSize;
  public readonly ProductColor $productColor;
  public readonly ProductComment $productComment;
  public readonly ProductCategory $productCategory;

  public function __construct()
    {
      $this->product = new Product;
      $this->productStock = new ProductStock;
      $this->productImage = new ProductImage;
      $this->productSize = new ProductSize;
      $this->productColor = new ProductColor;
      $this->productComment = new ProductComment;
      $this->productCategory = new ProductCategory;
    }


  public function displayCategories(){
    $selectCategory = $this->productCategory->findBy('ativo', 1);
    if(!$selectCategory){
      return false;
    }
    foreach ($selectCategory as $k => $category) {
      $data['selectCategory'][$k] = [
        "id" => $category->id,
        "name" => $category->categoria,
        "image" => $category->imagem
      ];
    }
    return $data['selectCategory'];
  }

  public function displayCategory($data){
    $foundCategory = $this->productCategory->findBy('id', $data['idCategory']);
    if(!$foundCategory){
      return false;
    }
    $data['selectCategory'] = [
      "id" => $foundCategory[0]->id,
      "name" => $foundCategory[0]->categoria,
      "image" => $foundCategory[0]->imagem
    ];
    return $data['selectCategory'];
  }

  public function displayProduct(array $data){
    $verifyProduct = $this->verifyProduct($data);
    if($verifyProduct){
      return false;
    }
    
    $data = $this->dataProduct($data);    

    $data['image'] = $this->dataImage($data);

    $data['size'] = $this->dataSize($data);

    $data['color'] = $this->dataColor($data);

    $data['comment'] = $this->dataComment($data);
  
    return $data;
  }

  public function displayProduct1(array $data){
    $verifyProduct = $this->verifyProduct($data);
    if($verifyProduct){
      return false;
    }
    
    $data = $this->dataProduct($data);    

    $data['image'] = $this->dataImage1($data);

    $data['size'] = $this->dataSize($data);

    $data['color'] = $this->dataColor($data);

    $data['comment'] = $this->dataComment($data);
  
    return $data;
  }

  public function displayProducts(){
    $productFound = $this->product->findBy("ativo", 1);
    if(!$productFound){
      return false;
    }  
    
    foreach ($productFound as $k => $product) {
      $value = [
        'idProduct' => $product->id
      ];

      $dataProduct = $this->selectProduct($value);

      $data['product'][$k] = $dataProduct;
    }

  
    return $data['product'];
  }

  public function displayComment(array $data){
    $verifyProduct = $this->verifyProduct($data);
    if($verifyProduct){
      return false;
    }

    $data['comment'] = $this->productComment->select($data);
  }


  public function verifyProduct($data){
    //verifica se o codigo foi passado
    if($data['idProduct'] == NULL){
        return true;
    }

    //verifica se o produto existe
    $productFound = $this->product->findBy("id",$data['idProduct'], null);
    if(!$productFound){
      return true;
    }  

    //verifica se o produto está ativo
    if($productFound[0]->ativo == 0){
      return true;
    }

  }


  public function verifySize($data){
    $sizeFound = $this->productSize->findBy("id",$data['idProductSize']);
    if($sizeFound){
      return true;
    }  
  }


  public function dataProductSize($data){
    $sizeProductFound = $this->productSize->findBy("id",$data['idProductSize']);
    $data = [
      'idProductSize' => $data['idProductSize'],
      'price' => $sizeProductFound[0]->preco,
      'size' => $sizeProductFound[0]->tamanho,
      'idProduct' => $sizeProductFound[0]->produto
    ];
    return $data;
  }


  public function dataProduct(array $data){
    $productFound = $this->product->findBy("id",$data['idProduct']);
    $data = [
      'idProduct' => $data['idProduct'],
      'name' => $productFound[0]->nome,
      'description' => $productFound[0]->descricao,
      'assessment' => $productFound[0]->avaliacao,
      'size' => $productFound[0]->tamanho,
      'color' => $productFound[0]->cor,
      'category' => $productFound[0]->categoria
    ];
    return $data;
  }



  public function dataImage(array $data){
    $imageFound = $this->productImage->findBy("produto",$data['idProduct'], null);
    foreach ($imageFound as $k => $image) {
      
      $data['image'][$k] = $image->imagem;

    }

    return $data['image'];
  }

  public function dataImage1(array $data){
    $imageFound = $this->productImage->findBy("produto",$data['idProduct'], null);
    foreach ($imageFound as $k => $image) {
      
      $data['image'][$k] = [
        'id' => $image->id,
        'image' => $image->imagem
      ];

    }

    return $data['image'];
  }


  public function dataSize(array $data){
    if($data['size'] == 1){
      $data['size'] = [];

      $sizeFound = $this->productSize->findBy("produto",$data['idProduct'], null);
      foreach ($sizeFound as $k => $size) {
        $data['idProductSize'] = $size->id;
        $stock = $this->dataStock($data);
        $data['size'][$k] = [
          "id" => $size->id,
          "size" => $size->tamanho,
          'price' => $size->preco,
          "stock" => $stock
        ];
      }
    }

    return $data['size'];
  }


  public function dataColor(array $data){
    if($data['color'] == 1){
      $colorFound = $this->productColor->findBy("produto",$data['idProduct'], null);
      $data['color'] = [];
      foreach ($colorFound as $k => $color) {
  
        $data['color'][$k] = [
          "id" => $color->id,
          "color" => $color->cor,
        ];
      }
    }

    return $data['color'];
  }


  public function dataStock(array $data){
    $stockFound = $this->productStock->findBy("produto",$data['idProductSize'], null);
    $data['stock'] = $stockFound[0]->qtdtotal;
    

    return $data['stock'];
  }


  public function dataComment($data){
    $value = [
      'idProduct' => $data['idProduct'],
      'limit' => 5
    ];

    $commentFound = $this->productComment->selectComment($value);
    if (!$commentFound) {
      return 0;
    }

    foreach ($commentFound as $k => $comment) {
  
      $data['comment'][$k] = [
        "id" => $comment->id,
        "assess" => $comment->avaliacao,
        "comment" => $comment->comentario
      ];
    }

    return $data['comment'];
  }

  public function dataComments($data){
    $value = [
      'idProduct' => $data['idProduct'],
    ];

    $commentFound = $this->productComment->selectComments($value);
    if (!$commentFound) {
      return 0;
    }

    foreach ($commentFound as $k => $comment) {
  
      $data['comment'][$k] = [
        "id" => $comment->id,
        "assess" => $comment->avaliacao,
        "comment" => $comment->comentario
      ];
    }

    return $data['comment'];
  }


  public function searchProduct($data){
    $value = [
      'search' => '%' . $data['form']['search'] . '%'
    ];

    $foundProducts = $this->product->searchProduct($value);

    if(!$foundProducts){
      return false;
    }
    foreach ($foundProducts as $k => $product) {
      $value = [
        'idProduct' => $product->id
      ];

      $data['product'][$k] = $this->selectProduct($value);

    }; 

    return $data['product'];
    
  }


  public function selectProducts($data){
    $value = [
      0 => $data['category'],
      'limit' => 15
    ];

    $selectProduct = $this->product->selectProduct($value);
    if(!$selectProduct){
      return false;
    }

    $data['selectProduct'][0] = 0;
    foreach ($selectProduct as $k => $product) {
      if(isset($data['idProduct'])){
        if ($product->id == $data['idProduct']) {
          
          continue;
        }
      }
      if($k == 0 ){
        $data['selectProduct'] = [];
      }
      $image['idProduct'] =  $product->id;
      $selectProductSize = $this->productSize->selectProductSize($product->id);
      $productImage = $this->dataImage($image);
      $data['selectProduct'][$k] = [
        "id" => $product->id,
        "name" => $product->nome,
        "assess" => $product->avaliacao,
        "image" => $productImage[0],
        "price" => [
            'max' => $selectProductSize[0]->max,
            'min' => $selectProductSize[0]->min
          ]
      ];
    }
    if(!$data['selectProduct']){
      return false;  
    }
    return $data['selectProduct'];
  }


  public function selectProducts1($data){
    $value = [
      "category" => $data['form']['category'],
    ];

    $selectProduct = $this->product->selectProduct1($value);
    if(!$selectProduct){
      return false;
    }
    foreach ($selectProduct as $k => $product) {
      if(isset($data['idProduct'])){
        if ($product->id == $data['idProduct']) {
          continue;
        }
      }
      $image['idProduct'] =  $product->id;
      $selectProductSize = $this->productSize->selectProductSize($product->id);
      $productImage = $this->dataImage($image);
      $data['selectProduct'][$k] = [
        "id" => $product->id,
        "name" => $product->nome,
        "assess" => $product->avaliacao,
        "image" => $productImage[0],
        "price" => [
            'max' => $selectProductSize[0]->max,
            'min' => $selectProductSize[0]->min
          ]
      ];
    }
    return $data['selectProduct'];
  }


  public function selectProduct($data){
    $foundProduct = $this->product->findBy('id', $data['idProduct']);

    $image['idProduct'] =  $foundProduct[0]->id;

    $selectProductSize = $this->productSize->selectProductSize($foundProduct[0]->id);
    
    $productImage = $this->dataImage($image);
    
    $data['selectProduct'] = [
      "id" => $foundProduct[0]->id,
      "name" => $foundProduct[0]->nome,
      "image" => $productImage[0],
      "assess" => $foundProduct[0]->avaliacao,
      "category" => $foundProduct[0]->categoria,
      "price" => [
          'max' => $selectProductSize[0]->max,
          'min' => $selectProductSize[0]->min
        ]
    ];
  
    return $data['selectProduct'];
  }

  public function selectProduct1($data){
    
    $foundProductSize = $this->productSize->findBy('id', $data['idProductSize']);

    $foundProduct = $this->product->findBy('id', $foundProductSize[0]->produto);

    $image['idProduct'] =  $foundProduct[0]->id;

    $selectProductSize = $this->productSize->selectProductSize($foundProduct[0]->id);
    
    $productImage = $this->dataImage($image);
    
    $data['selectProduct'] = [
      "id" => $foundProduct[0]->id,
      "name" => $foundProduct[0]->nome,
      "image" => $productImage[0],
      'size' => [
        'id' => $foundProductSize[0]->id,
        'size' => $foundProductSize[0]->tamanho
      ],
      "price" => $foundProductSize[0]->preco
    ];
  
    return $data['selectProduct'];
  }


  public function selectCategory($data){
    $foundCategory = $this->productCategory->findBy('id', $data['category']);
    if (!$foundCategory) {
      return false;
    }

    return $foundCategory[0]->categoria;
  }


  //add

  public function addCategory($data){
    if(!$data['form']['name'] || !$data['form']['image']){
      return 'Preencha os campos corretamente';
    }    

    $value = [
      'type' => $data['form']['image']['type']
    ];

    $varifyType = $this->verifyMimeTypes($value);
    if($varifyType){
      return $varifyType;
    }


    $value = [
      'name' => $data['form']['name']
    ];
    $this->productCategory->insert($value);

    $foundCategory = $this->productCategory->select($value);
    if(!$foundCategory){
      return false;
    }


    $location = '../imagem/categoria/';
    $mime = explode('.', $data['form']['image']['name']);  
    $count = count($mime) - 1;
    $nameImage = str_replace(' ', "_", $foundCategory[0]->id .'_'. $data['form']['name']."_". 1 . '.' . $mime[$count]);
    
    $value = [
      'idCategory' => $foundCategory[0]->id,
      'image' => $nameImage 
    ];

    $this->productCategory->updateImage($value);

    move_uploaded_file($data['form']['image']['tmp_name'], $location . $nameImage);
  }


  public function alterCategory($data){
    if(!$data['form']['name'] || !$data['form']['image'] || !$data['form']['idCategory']){
      return 'Preencha os campos corretamente';
    }

    $foundCategory = $this->productCategory->findBy('id', $data['form']['idCategory']);
    if(!$foundCategory){
      return false;
    }

    $nameImage = $foundCategory[0]->imagem;
    $name = $foundCategory[0]->categoria;

    if($data['form']['image']['name'] != $foundCategory[0]->imagem && $data['form']['image']['name']){
      $value = [
        'type' => $data['form']['image']['type']
      ];
  
      $varifyType = $this->verifyMimeTypes($value);
      if($varifyType){
        return $varifyType;
      }

      $location = '../imagem/categoria/';
      $mime = explode('.', $data['form']['image']['name']);  
      $count = count($mime) - 1;
      $nameImage = str_replace(' ', "_", $foundCategory[0]->id .'_'. $data['form']['name'] .'.' . $mime[$count]);

      unlink('../imagem/categoria/' . $foundCategory[0]->imagem);


      move_uploaded_file($data['form']['image']['tmp_name'], $location . $nameImage);
    }
    if($data['form']['name'] != $foundCategory[0]->categoria){
      
      $name = $data['form']['name'];
    }
    
    
    $value = [
      'idCategory' => $data['form']['idCategory'],
      'category' => $name, 
      'image' => $nameImage 
    ];

    $this->productCategory->update($value);

  }


  public function deleteCategory($data){
    if(!$data['form']['idCategory']){
      return 'Preencha os campos corretamente';
    }


    $foundCategory = $this->productCategory->findBy('id', $data['form']['idCategory']);
    if(!$foundCategory){
      return false;
    }

    $value = [
      'idCategory' => $data['form']['idCategory']
    ];

    $this->productCategory->delete($value);

    unlink('../imagem/categoria/' . $foundCategory[0]->imagem);

    $foundProduct = $this->product->findBy('categoria', $data['form']['idCategory']);
    if(!$foundProduct){
      return false;
    }
    foreach ($foundProduct as $k => $product) {
      $valeu = [
        'idProduct' => $product->id
      ];
      
      $this->product->updateCategory($valeu);
    }
    

  }


  public function addProduct($data){
    if(!$data['form']['name'] || !$data['form']['description'] || !$data['form']['category']){
      return 'Preencha os campos corretamente';
    }    

    foreach ($data['form']['size'] as $k => $size) {
      if(!$size['size'] || !$size['price']){
        return 'Preencha os campos corretamente';
      }
    }

    $value = [
      'name' => $data['form']['name'],
      'description' => $data['form']['description'],
      'category' => $data['form']['category'],
      'size' => 1
    ];

    $this->product->insert($value);

    $foundProduct = $this->product->select($value);
    if(!$foundProduct){
      return false;
    }

    foreach ($data['form']['size'] as $k => $size) {
      $value = [
        'size' => $size['size'],
        'price' => str_replace(',','.', $size['price']),
        'product' => $foundProduct[0]->id
      ];

      $this->productSize->insert($value);

      $foundProductSize = $this->productSize->select($value);
      if(!$foundProductSize){
        return false;
      }

      $value = [
        'product' => $foundProductSize[0]->id
      ];

      $this->productStock->insert($value);
    }
    
    if($data['form']['image']){
      $i = 0;
      foreach ($data['form']['image'] as $k => $image) {
        $i++;
        $value = [
          'type' => $image['type']
        ];


        $varifyType = $this->verifyMimeTypes($value);
        if($varifyType){
          return $varifyType;
        }



        $location = '../imagem/';
      
        $mime = explode('.', $image['name']);
        
        $count = count($mime) - 1;

        $nameImage = str_replace(' ', "_", $foundProduct[0]->id .'_'. $data['form']['name'] ."_". $i . '.' . $mime[$count]);
        
        $value = [
          'product' => $foundProduct[0]->id,
          'image' => $nameImage 
        ];

        $this->productImage->insert($value);

        move_uploaded_file($image['tmp_name'], $location . $nameImage);
      }
    }
    
    header('Location: ../public/estoque.php?idProduct='. $foundProduct[0]->id);
    die();
  }


  public function alterProduct($data){
    if(!$data['form']['name'] || !$data['form']['description'] || !$data['form']['category']){
      return 'Preencha os campos corretamente';
    }    

    foreach ($data['form']['size'] as $k => $size) {
      if(!$size['size'] || !$size['price']){
        return 'Preencha os campos corretamente';
      }
    }

    $value = [
      'name' => $data['form']['name'],
      'description' => $data['form']['description'],
      'category' => $data['form']['category'],
      'idProduct' => $data['form']['idProduct']
    ];
    
    $this->product->update($value);


    foreach ($data['form']['size'] as $k => $size) {
      if($size['id']){

        $value = [
          // 'size' => $size['size'],
          'price' => str_replace(',','.', $size['price']),
          'idProduct' => $size['id']
        ];
        
        $this->productSize->update($value);

      }
      else{
        $value = [
          'size' => $size['size'],
          'price' => str_replace(',','.', $size['price']),
          'product' => $data['form']['idProduct']
        ];
  
        $this->productSize->insert($value);
  
        $foundProductSize = $this->productSize->select($value);
        if(!$foundProductSize){
          return false;
        }
  
        $value = [
          'product' => $foundProductSize[0]->id
        ];
  
        $this->productStock->insert($value);
      }
    }

    $foundImage = $this->productImage->findBy('produto', $data['form']['idProduct']);
    if($foundImage){
      foreach ($foundImage as $k => $image) {
        if(!in_array($image->id, $data['form']['idImage'])){
          $value = [
            'idImage' => $image->id
          ];

          $this->productImage->delete($value);

          unlink('../imagem/' . $image->imagem);
        }
        
      }
    }

    //insere as imagem
    if($data['form']['image']){
      $i = 0;
      $value = [
        'product' => $data['form']['idProduct']
      ];
      $foundImage = $this->productImage->selectMax($value);
      if($foundImage){

        $maxI = str_replace('.','_',$foundImage[0]->imagem);
        $maxI = explode('_',$maxI);
        $count = count($maxI) - 2;
        $i = $maxI[$count];
      }

      foreach ($data['form']['image'] as $k => $image) {
        $i++;
        $value = [
          'type' => $image['type']
        ];


        $varifyType = $this->verifyMimeTypes($value);
        if($varifyType){
          return $varifyType;
        }



        $location = '../imagem/';
      
        $mime = explode('.', $image['name']);
        
        $count = count($mime) - 1;

        $nameImage = str_replace(' ', "_", $data['form']['idProduct'] .'_'. $data['form']['name'] ."_". $i . '.' . $mime[$count]);
        
        $value = [
          'product' => $data['form']['idProduct'],
          'image' => $nameImage 
        ];

        $this->productImage->insert($value);

        move_uploaded_file($image['tmp_name'], $location . $nameImage);
      }


    }


    
    
  }


  public function deleteProduct($data){
    if(!$data['form']['idProduct']){
      return 'Preencha os campos corretamente';
    }    


    $value = [
      'idProduct' => $data['form']['idProduct']
    ];

    $this->product->delete($value);

    $foundSize = $this->productSize->findBy('produto', $data['form']['idProduct']);

    foreach ($foundSize as $k => $size) {
      $value = [
        'idProduct' => $size->id
      ];

      $this->productSize->delete($value);

    }
    
  }    


  public function verifyMimeTypes($data){
    $mimeTipes = [
      'image/png', 
      'image/jpeg',
      'image/webp'
    ];

    if(!in_array($data['type'], $mimeTipes)){
      return 'Arquivo inválido';
    }
  }

}