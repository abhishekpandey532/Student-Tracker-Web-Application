<?php 
$server='localhost';
$username='root';
$password='root';
$database='blog';


if(!mysql_connect($server,$username,$password))
{
	dies('Error:Could Not Connect');

}
if(!mysql_select_db($database))
{
	die('Could not connect databse');
}


?>