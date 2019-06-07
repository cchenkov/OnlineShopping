<?php
	require "../../config.php";
	require "../../common.php";	
	
	session_start();

	try {
		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT Id, ProductName, Price, ImageSource FROM Product ORDER BY Price";

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	}
	catch (PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
		exit;
	}

	if (isset($_POST['add_to_cart'])) {
		try {		
			if(isset($_SESSION['user_id'])) {
				$connection = new PDO($dsn, $username, $password, $options);

				$product_id = $_POST['add_to_cart'];

				echo '<script>console.log("' . $product_id . '");</script>';

				$sql = "INSERT INTO Cart(UserId, ProductId, Quantity) VALUES(:userId, :productId, :quantity)";

				$statement = $connection->prepare($sql);

				$statement->bindValue(':userId', $_SESSION['user_id']);
				$statement->bindValue(':productId', $product_id);
				$statement->bindValue(':quantity', 1);
				$statement->execute();

				echo 'Successfully added to cart';
			}
			else {
				die('Please log in to add to cart');
			}

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}

	if (isset($_POST["delete"])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$id = $_POST["delete"];

			$sql = "DELETE FROM Product WHERE Id = :id";

			$statement = $connection->prepare($sql);

			$statement->bindValue(':id', $id);
			$statement->execute();

			$success = "Product successfully deleted";
		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}
?>

<?php include "../templates/header.php"; ?>

<head>
  <link rel="stylesheet" href="../css/table.css">
</head>

<?php if ($success) echo escape($success) ?>

<form method="post">
	<?php
		if ($result && $statement->rowCount() > 0) { ?>
			<h1>All Products</h1>

			<table>
				<thead>
					<tr>
						<th>Product</th>
						<th>Price</th>
						<th>Image</th>
						<th>More Info</th>
						<th>Add to cart</th>
						<th>Delete</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($result as $row) { ?>
						<tr>
							<td><?php echo escape($row["ProductName"]); ?></td>
							<td><?php echo escape($row["Price"]); ?></td>
							<td><?php echo escape($row["ImageSource"]); ?></td>
							<td><a href="../details.php?Id= <?php echo $row["Id"]; ?>">Details</a></td>
							<td><button type="submit" name="add_to_cart" value="<?php echo $row["Id"]; ?>">Add to cart</button></td>
							<td><button type="submit" name="delete" value="<?php echo $row["Id"]; ?>">Delete</button></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } else { ?>
			<blockquote>No products found.</blockquote>
		<?php }
	?>
</form>

<br>
<a href="../index.php">Back to home</a>

<?php include '../templates/footer.php' ?>
