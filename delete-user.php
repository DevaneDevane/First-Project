<?php

//set name of page
$page_title="Delete Users";
include("includes/header.php");
//include("includes/menu.php");

//db conf
include ("includes/db_conf.php");

//content after here


try {
    $pdo = new PDO("mysql:host=". HOSTNAME . ";" . "dbname=" . DBNAME, USERNAME, PASSWORD);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
 

echo("Delete user number : " . $_POST['id']);



try{  
    $pdo->beginTransaction();
        
    $sql = 'DELETE FROM card_info 
    WHERE 
    customer_id=:id';    

    $s = $pdo->prepare($sql);

    //bind value
    $s->bindValue(':id', $_POST['id']);
   
    $s->execute();
        
    //insert into 2nd table card_info
    $sql = 'DELETE FROM users 
    WHERE 
    customer_id=:id';    

    $s = $pdo->prepare($sql);

    //bind value
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
     
    // commit transaction
    $pdo->commit();    
    
}
catch(PDOException $e){
    $pdo->rollback();
    echo "Query Failed, rollback required: " . $e->getMessage();
    //exit();
}



//redirect
header('Location: '.'all-users.php');




 
 ?>

