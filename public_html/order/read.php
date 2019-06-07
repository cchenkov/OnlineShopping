<?php
  session_start();

	require "../../config.php";
	require "../../common.php";

	try {
		if (isset($_SESSION['user_id'])) {
			$connection = new PDO($dsn, $username, $password, $options);

			$sql = "SELECT o.Id AS id, p.ProductName AS product, o.Quantity AS quantity, p.Price AS price, o.ApprovalStatus AS approval_status
					FROM ProductOrder o
					LEFT JOIN Product p ON o.ProductId = p.Id
					WHERE o.UserId = :userid";
	
			$statement = $connection->prepare($sql);
			$statement->bindValue(':userid', $_SESSION['user_id']);
			$statement->execute();
	
			$result = $statement->fetchAll();
		} else {
			die('Please login to see your orders');
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

<form method="post">
	<?php
		if ($result && $statement->rowCount() > 0) { ?>
			<h1>Your orders</h1>

			<table>
				<thead>
					<tr>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Approval Status</th>
						<th>Update</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($result as $row) { ?>
						<tr>
							<td><?php echo escape($row["product"]); ?></td>
							<td><?php echo escape($row["quantity"]); ?></td>
							<td><?php echo escape($row["price"]); ?></td>
							<td><?php echo escape($row["approval_status"]); ?></td>
              <td><a href="update.php?id=<?php echo $row["id"]; ?>">Update Status</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } else { ?>
			<blockquote>You don't have any orders.</blockquote>
		<?php }
	?>
</form>

<br>
<a href="../index.php">Back to home</a>

<?php include "../templates/footer.php"; ?>