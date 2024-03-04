<?php
    class Cart{
        // Db data
        private $conn;

        // Request Properties
        public $product_id;
        public $user_id;
        public $dateofinsertion;
        
        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        public function checkInCart($user_id,$product_id){
            $collection = $this->conn->estore->carts;
            $filter = [
                'userid' => $user_id,
                'productid' =>new MongoDB\BSON\ObjectId($product_id)
            ];
            $cursor = $collection->findOne($filter);
            // var_dump($cursor);
            if($cursor){
                return true;
            }
            return false;
        }

        public function addCart($user_id, $product_id, $datetime){
            $collection = $this->conn->estore->carts;
            $document = ['_id' => new MongoDB\BSON\ObjectId(), 'userid' => $user_id, 'productid' => new MongoDB\BSON\ObjectId($product_id), 
            'dateofinsertion' => $datetime];
            try {
                $insertOneResult = $collection->insertOne($document);
            } catch (Exception $e) {
                return false;
            }
            return (string)$insertOneResult->getInsertedId();
            
        }

        public function getProductsInCarts($user_id){
            $carts = $this->conn->estore->carts;
            try{
                $temp = $carts->distinct( "productid", ["userid" =>$user_id]);
            }
            catch(Exception $e){
                return false;
            }
            return $temp;
        }

        public function lastInsertion($user_id,$product_id){
            $collection = $this->conn->estore->carts;
            $product_id = new MongoDB\BSON\ObjectId($product_id);

            $filter = ['productid' => $product_id, 'userid' => $user_id];
            $options = ['sort' => ['dateofinsertion' => -1],
                        'limit' => 1, 
                        'projection' => ['dateofinsertion' => 1]];
            try{
                $cursor = $collection->find($filter,$options)->toArray();
            }
            catch(Exception $e){
                return "0000-00-00 00:00:00";
            }
            $ret = null;
            foreach($cursor as $doc){
                $ret = $doc['dateofinsertion'];
            }
            return $ret;
        }

        public function productCartApperances($user_id,$product_id){
            // NEW
            $collection = $this->conn->estore->carts;
            $product_id = new MongoDB\BSON\ObjectId($product_id);

            $filter = ['userid'=>$user_id, 'productid' => $product_id];
            try{
                $count = $collection->count($filter);
            }
            catch(Exception $e){
                $count = 0;
            }
            return $count;
        }

        public function deleteCartOne($user_id,$product_id){
            // data
            $product_id = new MongoDB\BSON\ObjectId($product_id);
           
            $collection = $this->conn->estore->carts;

            $filter = ['userid' => $user_id, 'productid' => $product_id];
            $options = ['sort'=>['dateofinsertion' => 1]];
            try{
                $deleteResult = $collection->findOneAndDelete($filter,$options); 
            }
            catch(Exception $e){
                $deleteResult = false;
            }
            return $deleteResult;
        }

        public function deleteCart($user_id,$product_id){
            // data
            
            $product_id = new MongoDB\BSON\ObjectId($product_id);
            $collection = $this->conn->estore->carts;

            $filter = ['userid' => $user_id, 'productid' => $product_id];
            try{
                $deleteResult = $collection->deleteMany($filter); 
            }
            catch(Exception $e){
                return false;
            }
            if($deleteResult->getDeletedCount()>0){
                return $deleteResult->getDeletedCount();
            }
            return false;
        }

    }

?>