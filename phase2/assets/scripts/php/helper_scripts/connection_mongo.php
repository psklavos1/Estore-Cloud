<?php
    require '/var/www/vendor/autoload.php';  
    // connect to mongodb
    try{
        $dbClient = new MongoDB\Client("mongodb://root:pass@mongo-db:27017");
    }
    catch(Exception $e){
        echo "Connection to MongoDB Failed with Error: {$e}";
        exit();
    }
    assert($dbClient);

    // $db = $dbClient->estore;
    // // echo "Connected to db";
    // $collection = $db->products;
    // $record = $collection->find();
    // foreach ($record as $product){
    //     var_dump($product);
    // }

?>