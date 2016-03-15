<?php

//set name of page
$page_title="All Users";
//include("includes/header.php");
include("includes/header-internal.php");

include("includes/menu.php");

//db conf
include ("includes/db_conf.php");

//db connect

try {
    $pdo = new PDO("mysql:host=". HOSTNAME . ";" . "dbname=" . DBNAME, USERNAME, PASSWORD);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

    
$sth = $pdo->prepare("SELECT * FROM users");
$sth->execute();

$result = $sth->fetchAll();

//catch empty set
if(sizeof($result)==0){
    echo ("<h1 style=color:red;margin-left:30px;>No Records to Show!</h1>" );
    exit();
    
    
}


?> 

<h1>All Users</h1>

<table id="allcustomers">
    <tr>
        <th>Customer ID</th><th>Creation Date</th><th>Name</th></th><th>Surname<th>Gender</th><th>Address</th><th>Tel</th><th>Email</th><th></th>
    </tr>

    <?php

     foreach ($result as $row) {
            echo '<tr>';
            echo    '<td> <form id="form_select" action="user-details-ind.php" method="post"> <input type="hidden" name="id" value="'. $row['customer_id'] . '"> <input type="submit" value="Show Full Details"> </form> </td> <td>' . $row['creation_date'] . '</td><td>' . $row['name']  . '</td><td>' . $row['surname'] . '</td><td>' . $row['gender'] . '</td><td>' . $row['address'] . '</td><td>' .  $row['telephone_number'] 
            . '</td><td>'. $row['email'] . '</td>' .  '<td><form id="form_delete" action="delete-user.php" method="post" onsubmit="return confirm(\'Delete Entry?\');"><input type="hidden" name="id" value="'. $row['customer_id'] . '"> <input type="submit" value="Delete"> </form> </td>';
           
            echo '</tr>'; 
        }
          
    ?>   
</table>      


<?php

    include("includes/footer.php");
 ?>

