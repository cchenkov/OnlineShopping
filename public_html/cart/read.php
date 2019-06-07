<?php
	require "../../config.php";
	require "../../common.php";

	$conn = mysqli_connect($host, $username, $password, $dbname);

	if (!$conn) {
		echo 'Connection error: '. mysqli_connect_error();
  }
	else {
		$sql = 'SELECT UserId, ProductId, Quantity, Id FROM Cart ORDER BY Quantity';
		$result = mysqli_query($conn, $sql);
	}

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
            echo $row["UserId"] . '<a href="../user/show.php?id=' . $row["UserId"]  . '"> Profile </a>' . 
            "<br> 
            <br>";

            
		}

	} else {
		echo "0 results";
	}
	mysqli_close($conn);
?>

<a href="../index.php">Back to home</a>