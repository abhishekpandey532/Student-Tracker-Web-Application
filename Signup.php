
<!DOCTYPE HTML> 
<html>
<head>
<link rel="stylesheet" href="csslink/css/style.css">

</head>
<body> 
<?php
// define variables and set to empty values
$nameErr = $emailErr = $cardErr = "";
$name = $email =$comment = $card =$pswd= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
     
   if (empty($_POST["card"])) {
     $card = "";
   } else {
     $card = test_input($_POST["card"]);
     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
     //if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
       //$websiteErr = "Invalid URL"; 
     //}
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }

$pswd=$_POST["password"];

   
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

 <div class="wrapper">
	<div class="container">
		
<h1 align="center">SIGN UP</h2>
<h3 align="center">
<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name: <input type="text" placeholder="Username" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br>
   E-mail: <input type="text" placeholder="email" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br>
   Card Number: <input type="text" placeholder="card" name="card" value="<?php echo $card;?>">
   <span class="error"><?php echo $websiteErr;?></span>
   <br>
Password: <input type="password" placeholder="password" name="password" value="<?php echo $website;?>"><br/>
   <button type="submit" value="submit" id="login-button">Login</button> 
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
echo "The Values Are :";
if(!empty($_POST["name"]) && !empty($_POST["email"]))
{
$row_counter = 0;
include('config.php');
//Procedutre to fetch the data.
echo $chk = "Select count(*) as number from users where email='$email'";
echo 'hello';
$data = mysql_query($chk)or die(mysql_error());
$row = mysql_fetch_array($data);
echo $row_counter = $row['number'];

//validate if a user exists or not.
//Check this condition to see if there are already rows existing
if($row_counter > 0)
{
echo "already exists";
}

else
{
mysql_fetch_array($data);
$q = "INSERT INTO `blog`.`users` (`id`, `name`, `email`, `password`, `enabled`) VALUES (NULL, '$name', '$email', '$pswd', '0');";
/*
Login page code
session_start();
$nm="SELECT `name`  FROM `users` WHERE `password` LIKE '$pswd'";
$data=mysql_query($nm)or die(mysql_error());
$row=mysql_fetch_array($data);
$_SESSION["name"]=$row[0];
echo $row[0];
print_r($_SESSION);
*/
?>
<?php

mysql_query($q)or die(mysql_error());
session_start();
$nm="SELECT `name`  FROM `users` WHERE `password` LIKE '$pswd'";
$data=mysql_query($nm)or die(mysql_error());
$row=mysql_fetch_array($data);
$_SESSION["name"]=$row[0];
echo $row[0];
print_r($_SESSION);

echo $name; echo "<br/>";
 echo $email; echo "<br/>";
echo $website; echo "<br/>";
?>
<script>
window.location="Home.php";
</script>
<?php
}
}
}
 ?>

</body>
</html>