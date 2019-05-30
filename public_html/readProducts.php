<?php 
   
	require '../config.php';
	require '../common.php';
    
    $conn = mysqli_connect($host, $username, $password, $dbname);
	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }else{
		$sql = 'SELECT ProductName, Price, ImageSource, Id FROM Product ORDER BY Price';
		$result = mysqli_query($conn, $sql);
	}
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "id: " . $row["Id"]. "<br> Name: " .
			 $row["ProductName"] ."<br> ".
			 $row["ImageSource"].
			"<br> Price: " .  $row["Price"]. "<br> ".  
			'<a href="details.php?id=<?php echo $row["Id"]?>More Info</a>'.
			"<br><br>";
		}
		
	} else {
		echo "0 results";
	}
   
	mysqli_close($conn);


?>

<a href="index.php">Back to home</a>



