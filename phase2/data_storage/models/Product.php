<?php

    class Product{
      // Db data
      private $conn;

      // Request Properties
      // public $id;
      // public $name;
      // public $category;
      // public $sellername;
      // public $productcode;
      // public $price;
      // public $dateofwithdrawal;
      
      // Constructor with DB
      public function __construct($db) {
          $this->conn = $db;
      }

      // CRUD operations
      public function getProductsAll() {
          // Create query
          $collection = $this->conn->estore->products;
          try {
            $cursor = $collection->find()->toArray();
          } catch (Exception $ex) {
            return false;
          }
          return $cursor;
      }

      public function getAvailable($product_id){
        $collection = $this->conn->estore->products;
        $product_id = new MongoDB\BSON\ObjectId($product_id);
        $filter =['_id' => $product_id];
        $options = ['projection' => ['available' => 1]];
        try {
          $cursor = $collection->find($filter,$options)->toArray();
        } catch (Exception $ex) {
          return -1; // Error
        }
        $available=0;
        foreach($cursor as $doc){
          $available = $doc['available'];
        }
        return intval($available);
      }

      public function decrementAvailable($product_id){
        $product_id = new MongoDB\BSON\ObjectId($product_id);
        $collection = $this->conn->estore->products;
        $filter = ['_id' => $product_id];
        $options = ['$inc' => ['available' => -1]];
        try{
          return $collection->updateOne($filter,$options);
        }
        catch(Exception $e){
            return false;
        }
      }

      public function incrementAvailableOne($product_id){
        $product_id = new MongoDB\BSON\ObjectId($product_id);
        $collection = $this->conn->estore->products;
        $filter = ['_id' => $product_id];
        $options = ['$inc' => ['available' => +1]];
        try{
          return $collection->updateOne($filter,$options);
        }
        catch(Exception $e){
            return false;
        }
      }

      public function incrementAvailableMany($product_id,$many){
        $product_id = new MongoDB\BSON\ObjectId($product_id);
        $collection = $this->conn->estore->products;
        $filter = ['_id' => $product_id];
        $options = ['$inc' => ['available' => $many]];
        try{
          return $collection->updateOne($filter,$options);
        }
        catch(Exception $e){
            return false;
        }
      }

      public function searchProducts($searchBy, $searchText){
          // Create query
          $collection = $this->conn->estore->products;
          if($searchBy != 'price' && $searchBy != 'dateofwithdrawal'){
            $regex = new \MongoDB\BSON\Regex('^'.$searchText , 'i');
            $filter = [$searchBy=>$regex];
          }
          else{
            if($searchBy == 'price')
              $filter = [$searchBy => ['$lte'=>floatval($searchText)]];
            else 
              $filter = [$searchBy => ['$lte'=>$searchText]];
          }

          try {
            $cursor = $collection->find($filter)->toArray();
          } catch (Exception $ex) {
            return false;
          }
          if($searchText =="")
            return false;
          return $cursor;
      }

      public function getPrice($product_id){
        $collection = $this->conn->estore->products;
        $product_id = new MongoDB\BSON\ObjectId($product_id);
        $filter =['_id' => $product_id];
        $options = ['projection' => ["price"=> 1]];
        try {
          $cursor = $collection->find($filter,$options)->toArray();
        } catch (Exception $ex) {
          return -1; // Error
        }
        return floatval($cursor['price']);
      }


      public function getProductsInfo($set){
        $collection = $this->conn->estore->products;
        $filter = ['_id' => ['$in' => $set]];
        try{
          $cursor = $collection->find($filter)->toArray();
        }
        catch(Exception $e){
          return false;
        }
        return $cursor;
      }

      public function getSellerProducts($username){
        // Db Funcs 
        $collection = $this->conn->estore->products;
        $filter = ['sellername' => $username];

        try{
          $cursor = $collection->find($filter)->toArray();
        }
        catch(Exception $e){
          return false;
        }
        return $cursor;
      }
      
      public function addProduct($name,$productcode, $price,$category,
      $dateofwithdrawal,$sellername,$available){
        $collection = $this->conn->estore->products;
        $document = ['_id' => new MongoDB\BSON\ObjectId(), 'sellername' => $sellername,
        'name'=>$name, 'productcode'=> $productcode, 'price'=>$price,
        'category' =>$category, 'dateofwithdrawal' => $dateofwithdrawal, 'available' =>$available];
        try {
            $insertOneResult = $collection->insertOne($document);
        } catch (Exception $e) {
            return false;
        }
        return (string)$insertOneResult->getInsertedId();
      }

      public function deleteProduct($product_id){
        // data
        $product_id = new MongoDB\BSON\ObjectId($product_id);
        $collection = $this->conn->estore->products;
        $filter = ['_id' => $product_id];

        try{
            $deleteResult = $collection->deleteOne($filter); 
        }
        catch(Exception $e){
            return false;
        }

        if($deleteResult->getDeletedCount() == 0) return false;
        else return $deleteResult->getDeletedCount();
      } 
    
      public function updateProduct($product_id,$name,$productcode,$price,$category,$dateofwithdrawal,$available){
        // data
        $product_id = new MongoDB\BSON\ObjectId($product_id);
        $collection = $this->conn->estore->products;
        $filter = ['_id' => $product_id];
        $options = [ '$set' => [ 'name' => $name, 'productcode'=>$productcode,
                               'dateofwithdrawal'=>$dateofwithdrawal, 'category'=> $category, 
                               'price'=>$price, 'available' => $available]];

        try{
            $updateResult = $collection->updateOne($filter,$options); 
        }
        catch(Exception $e){
            return false;
        }
        $mod_count = $updateResult->getModifiedCount();

        if ($mod_count > 0)
            return $mod_count;
        
        else return false;


      }
    }


?>