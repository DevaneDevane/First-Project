<?php

//set name of page
$page_title="Individual users Details";
include("includes/header.php");
//include("includes/headerreadonly.php");
include("includes/menu.php");

//content after here


//prep year range for dropdown box. makes range from current year to 5 years from now
$thisyear=date("Y");
$rangelength=5;
$years = range($thisyear,$thisyear+$rangelength);
$arrlength=count($years);


$customer_id=$_POST['id'];


//db conf
include ("includes/db_conf.php");

try {
    $pdo = new PDO("mysql:host=". HOSTNAME . ";" . "dbname=" . DBNAME, USERNAME, PASSWORD);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}



$sql='SELECT users.customer_id, creation_date, users.name, surname, gender, address, telephone_number, email,card_info.name as card_type,card_number,expiry_date
FROM users,card_info
where users.customer_id=:id
AND users.customer_id=card_info.customer_id';


//customer_id

$s = $pdo->prepare($sql);

$s->bindValue(':id', $customer_id);
$s->execute();


$result = $s->fetch();

//get the date and get month and year for dropdown box

$entry_date = DateTime::createFromFormat('Y-m-d', $result['expiry_date']);
$entry_year=$entry_date->format("Y");
$entry_month=$entry_date->format("m");


?>



    
    <div id="div_form_join">
    
        First Name:<br/>
        <input type="text" readOnly name="firstname" value="<?php echo $result['name']; ?>">
        <br/>

        Last name:<br/>
        <input type="text" readOnly name="lastname" value="<?php echo $result['surname']; ?>">
        <br/>
     
        Gender:<br/>
        <select  disabled name="gender" value="<?php echo $result['gender']; ?>">
			<option selected="selected" value="<?php echo $result['gender']; ?>"><?php echo $result['gender']; ?></Option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <br/>
        
        Address:<br/>   
        <textarea readOnly name="address" rows="10" cols="30"><?php echo $result['address']; ?></textarea>  
        <br/>
                
        Telephone:<br/>
        <input type="text" readOnly name="telephone" value="<?php echo $result['telephone_number']; ?>">
        <br/>
        
        E-mail:<br/>
        <input type="email" readOnly name="email" value="<?php echo $result['email']; ?>">
        <br/>
        
        Credit Card Type:<br/>
        <select disabled name="card_type" value="<?php echo $result['card_type']; ?>">
			<option selected="selected" value="<?php echo $result['card_type']; ?>"><?php echo $result['card_type']; ?></Option>
            <option value="Visa">Visa</option>
            <option value="Access">Access</option>
        </select>
        <br/>
    
        Card Number:<br/>
        <input type="text" readOnly name="credit_card_number" maxlength="20" size="20" value="<?php echo $result['card_number']; ?>">
        <br/>
           
        Expiry Date:<br/>
        Month:     
        <select disabled name="expiry_month">
			<option selected="selected" value="<?php echo $entry_month; ?>"> <?php echo $entry_month; ?></option>								<?php echo $entry_month; ?>
            <option value="1"> 1</option>
            <option value="2"> 2</option>
            <option value="3"> 3</option>
            <option value="4"> 4</option>
            <option value="5"> 5</option>
            <option value="6"> 6</option>
            <option value="7"> 7</option>
            <option value="8"> 8</option>
            <option value="9"> 9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>        
        </select>
    Year:   
	<select disabled name="expiry_year">  
		<option selected="selected" value="<?php echo $entry_year; ?>"> <?php echo $entry_year; ?></option>
        <?php  
			
        for($i=0; $i<=$arrlength-1; $i++){?>
            <option value="<?php  echo $years[$i]; ?>"> <?php echo $years[$i]; ?></option>
        <?php
        }
        ?>
    </select> 
      
    <br/> 
    
     <form id="form_delete" action="delete-user.php" method="post" onsubmit="return confirm('Delete Entry?');">
        <input type="hidden" name="id" value="<?php echo $customer_id; ?>">
        <br/>
        <div style="text-align:center;">
           <input type="submit" value="Delete">  
        </div>
        
        
        
     </form>
        
        
    
    
    </div>
       
 
<br/><br/>



<?php




    include("includes/footer.php");
 ?>

