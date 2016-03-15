<?php

//db conf
include ("includes/db_conf.php");

//setup credit card expiry date for db
$month=$_POST['expiry_month'];
$year=$_POST['expiry_year'];
$maxDaysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year); //returns last day of month for that month.
$today = date("Y-m-d");

//create date from month-year from the form to year-month-day format for db
$expiration_date=$year . "-" . $month  . "-" . $maxDaysInMonth;

//connect to db

try {
    $pdo = new PDO("mysql:host=". HOSTNAME . ";" . "dbname=" . DBNAME, USERNAME, PASSWORD);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


//insert with Prepared Statments/transactions

try{  
    $pdo->beginTransaction();
    
    $sql = 'INSERT INTO users SET
    creation_date =:creation_date,
    name =:name,
    surname =:surname,
    gender =:gender,
    address =:address,
    telephone_number =:telephone_number,
    email =:email';

    $s = $pdo->prepare($sql);

    //bind values
    $s->bindValue(':creation_date', $today);
    $s->bindValue(':name', $_POST['firstname']);
    $s->bindValue(':surname', $_POST['lastname']);
    $s->bindValue(':gender', $_POST['gender']);  
    $s->bindValue(':address', $_POST['address']);
    $s->bindValue(':telephone_number', $_POST['telephone']);
    $s->bindValue(':email', $_POST['email']);

    $s->execute();
        
    //insert into 2nd table card_info
    
    $sql = 'INSERT INTO card_info SET 
    name =:name,
    card_number =:card_number,
    expiry_date =:expiry_date,
    customer_id =:customer_id';
 
    $s = $pdo->prepare($sql);

    //bind values
    $s->bindValue(':name',$_POST["card_type"]);
    $s->bindValue(':card_number',$_POST["credit_card_number"]);
    $s->bindValue(':expiry_date', $expiration_date);
    $s->bindValue(':customer_id',$pdo->lastInsertId());

    $s->execute();
        
    // commit transaction
    $pdo->commit();
    
    
}
catch(PDOException $e){
    $pdo->rollback();
    echo "Query Failed, rollback required: " . $e->getMessage();
}


//redirect
header('Location: '.'all-users.php');


 ?>

