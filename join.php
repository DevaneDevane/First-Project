<?php

//set name of page
$page_title="Join";
include("includes/header.php");
include("includes/menu.php");

//content after here

//prep year range for dropdown box. makes dropdown value range from current year to 5 years from now
$thisyear=date("Y");
$rangelength=5;
$years = range($thisyear,$thisyear+$rangelength);
$arrlength=count($years);
//
?>

<h1>Join</h1>

<form id="form_join" action="insert-user.php" method="post" onsubmit="return confirm('Add Entry?');">
    
    <div id="div_form_join">
    
        First Name:<br/>
        <input type="text" name="firstname" required pattern=".{1,45}">
        <br/>

        Last name:<br/>
        <input type="text" name="lastname" required pattern=".{1,45}">
        <br/>
     
        Gender:<br/>
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <br/>
        
        Address:<br/>   
        <textarea name="address" rows="5" cols="30" required pattern=".{5,45}"></textarea>  
        <br/>
                
        Telephone:<br/>
        <input type="text" name="telephone" minlength="4" maxlength="16" required pattern="[0-9]+([-\,][0-9]+)?">
        <br/>
        
        E-mail:<br/>
        <input type="email" name="email" required pattern=".{6,18}">
        <br/>
        
        Credit Card Type:<br/>
        <select name="card_type">
            <option value="Visa">Visa</option>
            <option value="Access">Access</option>
        </select>
        <br/>
    
        Card Number:<br/>
        <input type="text" name="credit_card_number" maxlength="20" size="20" required pattern=".{16,20}">
        <br/>
           
        Expiry Date:<br/>
        Month:     
        <select name="expiry_month">
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
        <select name="expiry_year">  
            <?php  
            for($i=0; $i<=$arrlength-1; $i++){?>
                <option value="<?php  echo $years[$i]; ?>"> <?php echo $years[$i]; ?></option>
            <?php
            }
            ?>
        </select> 
          
        <br/> 
        <input type="submit">
    
    </div>
       
</form> 

<?php
    include("includes/footer.php");
 ?>

