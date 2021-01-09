<?php

function sanitizeData($userData){
  $sanitizeNewData=[];
  foreach($userData as $key=>$value)
  {
    $data=trim($value);
    $data=stripslashes($data);
    $data=htmlspecialchars($data,ENT_QUOTES,'UTF-8');
    $sanitizeNewData[$key]=$data;
  }
  return $sanitizeNewData;
}

function validateUserInput($userData){
  $error=[];
  $fieldValue=[];
  foreach($userData as $key=>$value){
    switch($key){
      case "name":
      if(empty($value)){
        $error["name"]="name can not empty";
      }
        $fieldValue[$key]=$value;

      break;
      case "address":
      if(empty($value)){
        $error["address"]="please fill the address";
      }
              $fieldValue[$key]=$value;

      break;
     
      case "email":
        if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
          $error["email"]="invaild email";

        }
                $fieldValue[$key]=$value;

      break;
      case"phonenumber":
        if(!(preg_match("#^(\+){0,1}(91){0,1}(-|\s){0,1}[0-9]{10}$#",$value))){
        $error["phonenumber"]="invaild phone number";
        }
          $fieldValue[$key]=$value;

        break;


      
    }//switch

  }
  return [$error,$fieldValue];
}
if(isset($_POST["save"]))
{
  $sanitizeNewData=sanitizeData($_POST);
  $validateError=validateUserInput($sanitizeNewData)[0];
  $validateData=validateUserInput($sanitizeNewData)[1];
  
  if(empty($validateError))
  {
    $host = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "task";
    $con = mysqli_connect($host, $username, $password,$dbname);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }	
    $name = $validateData['name'];
    $email=$validateData['email'];
    $phonenumber=$validateData['phonenumber'];
    $address=$validateData['address'];
    $insert = "INSERT INTO user (name, email, phonenumber, address) 
      VALUES('".$name."','".$email."','".$phonenumber."','".$address."')";
    $query = mysqli_query($con, $insert);
    if(! $query ) 
      {
      die('Could not enter data: ' . mysqli_connect_error());
      }
      else
      {
      echo "Data insert successfully";
      header("location:read.php");
      exit();
      }
  }
  
}

?>
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="style.css">

  </head>
<body>
  <div align=center><h2>Add user</h2></div>
<form method="POST" action="form.php"style="background-color:rosybrown";>
  
<div class="input-group">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" value="<?php echo $validateData["name"];?>">
</div>
<div style="color:red;"><?php echo $validateError["name"];?></div>
  <br>
  <div class="input-group">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"value="<?php echo $validateData["email"];?>">
  </div>
    <div style="color:red;"><?php echo $validateError["email"];?></div>

  <br>
  <div class="input-group">
    <label for="phonenumber">Phonenumber:</label><br>
    <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $validateData["phonenumber"];?>">
  </div>
  <div style="color:red;"><?php echo $validateError["phonenumber"];?></div>

  <br>
  <div class="input-group">
    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" value="<?php echo $validateData["address"];?>">
  </div>  
  <div style="color:red;"><?php echo $validateError["address"];?></div>
  <br>
  <input type="submit" name="save" value="save">
</form>
</body>
</html>
