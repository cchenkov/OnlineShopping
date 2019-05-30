<?php 
	require '../config.php';
	require '../common.php';
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "id: " . $row["Id"]. "<br> Name: " .
			 $row["ProductName"] ."<br> ".
			 $row["ImageSource"]."<br> ".
			 '<a href="details.php?Id=' . $row["Id"] . '">More Info</a>'.
			"<br> Price: " .  $row["Price"]. "<br> .
			<br> <br>";
		}
		
	} else {
		echo "0 results";
	}  
	mysqli_close($conn);
?>

<a href="index.php">Back to home</a>



