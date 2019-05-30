<?php


$host = "localhost";
$username = "tsenko";
$password = "Helicopter_1500";
$dbname = "onlinestore";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

$conn = mysqli_connect($host, $username, $password, $dbname);
	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }else{
		$sql = 'SELECT ProductName, Price, ImageSource, Id FROM Product ORDER BY Price';
		$result = mysqli_query($conn, $sql);
	}

?>