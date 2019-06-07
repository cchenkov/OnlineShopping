<?php
	require "../../config.php";
	require "../../common.php";	
	
	session_start();

	$conn = mysqli_connect($host, $username, $password, $dbname);

	if (!$conn) {
		echo 'Connection error: '. mysqli_connect_error();
  	}
	else {
		$sql = 'SELECT ProductName, Price, ImageSource, Id FROM Product ORDER BY Price';
		$result = mysqli_query($conn, $sql);
	}

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$row_id = $row['Id'];

			echo "<strong>Name: </strong>" . $row["ProductName"] ."<br> ".
			 $row["ImageSource"]."<br> ".
			 '<a href="../details.php?Id=' . $row["Id"] . '">More Info</a><br>'.
			"<br><strong>Price: </strong>" .  $row["Price"] . "<br><br>" . "<form action='read.php' method='post'><button type='submit' name='order' value='$row_id'>Order</button></form>" .
			"<p>-------------------------</p><br>
			<br><br>";
		}

	} else {
		echo "0 results";
	}
	mysqli_close($conn);

	if (isset($_POST['order'])) {
		try {		
			if(isset($_SESSION['user_id'])) {
				$connection = new PDO($dsn, $username, $password, $options);

				$product_id = $_POST['order'];

				$sql = "INSERT INTO ProductOrder(UserId, ProductId, Quantity, ApprovalStatus) VALUES(:userId, :productId, :quantity, :approvalStatus)";

				$statement = $connection->prepare($sql);

				$statement->bindValue(':userId', $_SESSION['user_id']);
				$statement->bindValue(':productId', $product_id);
				$statement->bindValue(':quantity', 1);
				$statement->bindValue(':approvalStatus', 'Order sent');
				$statement->execute();

				echo 'Successfully ordered';
			}
			else {
				die('Please log in to order');
			}

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}
?>

<a href="../index.php">Back to home</a>

<?php include '../templates/footer.php' ?>
