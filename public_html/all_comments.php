<?php
	require '../config.php';
	require '../common.php';
    
    $conn = mysqli_connect($host, $username, $password, $dbname);
	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }else{
		$sql = 'SELECT Message, Id FROM Comment';
		$result = mysqli_query($conn, $sql);
	}
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "Comment: " . $row["Id"]. 
			"<br> Message: " .$row["Message"].
			"<br> ".  
			"<br><br>";
		}
		
	} else {
		echo "0 results";
	}
   
	mysqli_close($conn);

?>