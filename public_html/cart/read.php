<?php
	session_start();

	require "../../config.php";
	require "../../common.php";

	$success = null;

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

	if (isset($_POST["delete"])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$id = $_POST["delete"];

			$sql = "DELETE FROM Cart WHERE Id = :id";

			$statement = $connection->prepare($sql);

			$statement->bindValue(':id', $id);
			$statement->execute();

			$success = "Product successfully removed from cart";
		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}

	try {
		if (isset($_SESSION['user_id'])) {
			$connection = new PDO($dsn, $username, $password, $options);

			$sql = "SELECT c.Id AS Id, p.ProductName AS product, c.Quantity AS quantity, p.Price AS price FROM Cart c
					INNER JOIN Product p
					WHERE c.UserId = :userid";
	
			$statement = $connection->prepare($sql);
			$statement->bindValue(':userid', $_SESSION['user_id']);
			$statement->execute();
	
			$result = $statement->fetchAll();
		} else {
			die('Please login to see your cart');
		}
	
	} catch (PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
		exit;
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
			<h1>Cart</h1>

			<table>
				<thead>
					<tr>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Order</th>
						<th>Remove</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($result as $row) { ?>
						<tr>
							<td><?php echo escape($row["product"]); ?></td>
							<td><?php echo escape($row["quantity"]); ?></td>
							<td><?php echo escape($row["price"]); ?></td>
							<td><button type="submit" name="order" value="<?php echo $row["Id"]; ?>">Order</button></td>
							<td><button type="submit" name="delete" value="<?php echo $row["Id"]; ?>">Delete</button></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } else { ?>
			<blockquote>No products in cart.</blockquote>
		<?php }
	?>
</form>

<br>
<a href="../index.php">Back to home</a>

<?php include "../templates/footer.php"; ?>
