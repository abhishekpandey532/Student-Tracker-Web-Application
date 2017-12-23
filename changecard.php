<html>
<head>
	</head>
	<body>
		<h1 align="center">SWITCH CARD</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
		<h3 align="center">Card Number:<input type="text" name="prev">
	<br/>	<br/>New User Name:<input type="text" name="user">
	<br/><br/>	<input type="submit" name="submit" value="submit">
<?php
/*
First fetch the user name  usnig the card number value.
Then delete all the records related to that name in the attendance table.
Once All the values in the db have been deleted.

Simply insert a new row with the same card number and the name of the new user


*/
?>

<script>
window.location="Home1.php";
</script>

	</body>