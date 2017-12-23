<?php
include("config.php");
session_start();
?>

<html>
<head>
</head>
<body>


	<h1 align="center">Enter the Values For The Day Office was closed</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<h3 align="Center">Leave Date:<input type="text" name="date"><br/>
	Reason For The Leave:<input type="text" name="remark">

	<input type="submit" name="submit" value="submit">
</h3>
</form>
<?php
?>
	<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$date=$_POST["date"];
 	    $name=$_SESSION["name"];
		$remark=$_POST["remark"];
		echo $addedon=date("d-m-Y");
		echo $month=$_GET['month'];

$q1="INSERT INTO `blog`.`leave` (`id`, `date`, `added_by`, `Remark`, `added_on`) VALUES (NULL, '$date', '$name', '$remark', '$addedon')";
	mysql_query($q1) or die(mysql_error());
	echo "Leave Inserted";
	?>
	<script>
window.location="Home1.php?month=<?php echo $month; ?>";
	</script>

<?php
	}

	?>
	<!--<input type="text" name="date">
	-->
	
</body>
</html>