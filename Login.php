
<?php
//session_start();

//echo "Destryyyyed";
//echo $_SESSION["name"];
?>

<!DOCTYPE HTML> 
<html>
<head>
<link rel="stylesheet" href="csslink/stylelogin.css">
</head>
<body> 
  
<?php
//session_destroy();
// define variables and set to empty values
//session_destroy();
print_r($_SESSION);
$nameErr ="";
$name = $pswd= "";

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
   if (empty($_POST["password"])) {
     $pswdErr = "Password is required";
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
		
<h1 align="center">LOG IN
<?php
// define variables and set to empty values

//echo "Hell";
//print_r($_SESSION);
//if(!isset($_SESSION["name"]))
  //echo "";
//else
  //echo "";

//print_r($_SESSION);
?></h2>
<h3 align="center">
<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

   Name: <input type="text" placeholder="Username" name="name" value="<?php echo $name;?>">*<?php echo $nameErr; ?>
   <br>
Password: <input type="password" placeholder="password" name="password" value="<?php echo $pswd;?>" >*<?php echo $pswdErr; ?><br/>
   <button type="submit" value="submit" id="login-button">Login</button> <br/><br/>
  <a href="Signup.php">Sign Up </a> <br/><br/>
<script >
function redirect(){
window.location="Signup.php";
}
</script>
  
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
if(!empty($_POST["name"]) && !empty($_POST["password"]))
{
$row_counter = 0;
include('config.php');
//Procedutre to fetch the data.
$chk = "Select count(*) as number from gb_attendance_june where name='$name' AND code='$pswd' ";
echo 'hello';
$data = mysql_query($chk)or die(mysql_error());
$row = mysql_fetch_array($data);
$row_counter = $row['number'];

//validate if a user exists or not.
//Check this condition to see if there are already rows existing
if($row_counter == 0)
{
echo "There is no Such user! PLease Sign Up";
?>
<?php 
}

else
{
 // echo "IN else";
//Login page code


session_start();
$nm="SELECT `name`,`code`  FROM `gb_attendance_june` WHERE `code` = '$pswd'";
$data=mysql_query($nm)or die(mysql_error());
$row=mysql_fetch_array($data);
$_SESSION["name"]=$row[0];
$_SESSION["code"]=$row[1];
//$_SESSION["count"]=1;
//echo $row[0];
print_r($_SESSION);

//if($_SESSION["name"]=="Abhi")
//{
  //echo "Admin Here";
  ?>
<script>
//window.location="Home.php";
</script>


?>
<script>
window.location="Home1.php";
</script>
<?php

}
}
//$nameErr="Please Enter A name first";
$pswdErr="Password Required";
}

 ?>
 


</body>
</html>