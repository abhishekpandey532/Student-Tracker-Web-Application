<?php
session_start();
include('config.php');
?>




<html>
<head>
	<style>
table, td, th {
    border: 1px solid green;
}

th {
    background-color: green;
    color: white;
}
</style>
<title>HOME</title>
</head>
<body>


<h1><a href="Home.php">HOME</a></h1>

<?php

session_start();

if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) 
{
  echo "Session is set";

 ?>


<br/><br/>

<?php
$code=$_SESSION["code"];
echo "<b>"."Your Attendance Report"."</b>"."<br/><br/>";
$q1="SELECT `date`,`name`,`in_time`,`out_time` FROM `gb_attendance_june` WHERE `code` = $code";
$q2="SELECT `date`,`remark`,`added_by` FROM `leave`";

$data=mysql_query($q1) or die(mysql_error());

$data2=mysql_query($q2) or die(mysql_error());
$row2=mysql_fetch_array($data2);


?>

<table align="center">
<tr>
<th>DATE</th>
<th>IN TIME</th>
<th>OUT TIME</th>

<th>FULL,HALF DAY</th>
</tr>

<?php 
while($row=mysql_fetch_array($data))
{

?>

<tr>
	<td><?php echo $row[0]; ?></td>
	<td><?php echo $row[2]; ?></td>
	<td><?php echo $row[3]; ?></td>
	
	<td> 
		<?php
		
 $check = strtotime("9:30:00");
//	echo "<br/>";
 $ro=strtotime($row["in_time"]); 

  if($ro<$check)
    	echo "Full Day";
    else
    	echo "Half Day";

//echo $row[2]; 
    
    ?> 

     </td>

</tr>
<tr>
	<?php 

	$nxt=date('d-m-Y', strtotime('+1 day', strtotime($row['date'])));
	$curr=date('d-m-Y',strtotime($row2['date']))."<br/>";
	
	  if((int)$nxt==(int)$curr) {
		echo "IN IF";
		?>

		<td colspan="5" bgcolor="#FF0000">LEAVE DAY</td>

		<?php
	}


}//while ends
//echo (int)$nxt;
//echo "<br/>".(int)$curr;
//if((int)$nxt==(int)$curr)
//	echo "Equal";
//else
//	echo "NOt Equl";
?>


</table>

<?php
//}

}
else 
{

?>
<script >
window.location="Login.php?error=please login first.";
</script>

<?php

}

?>

</body>
</html>
