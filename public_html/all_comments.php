<?php
	require "../config.php";
	require "../common.php";
	if (isset($_POST["submit"])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$id = $_POST["submit"];

			$sql = "DELETE FROM Comment WHERE Id = :id";

			$statement = $connection->prepare($sql);

			$statement->bindValue(':id', $id);
			$statement->execute();

			$success = "Comment successfully deleted";
		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}
	try {

	  $connection = new PDO($dsn, $username, $password, $options);
		$product_id = $_GET['product_id'];
		$sql = "SELECT c.Id AS id, c.Message AS comment_message, p.ProductName AS product_name, u.Username AS username FROM Comment c
						LEFT JOIN Product p ON c.ProductId = p.Id
						LEFT JOIN User u ON c.UserId = u.Id
						WHERE ProductId = $product_id";

		$result = mysqli_query($conn, $sql);
		$comment = mysqli_fetch_assoc($result);

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
		$productName = $result[0]["product_name"];

	} catch(PDOException $error) {
	  echo $sql . "<br>" . $error->getMessage();
		exit;
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>

		<style type="text/css">
    	table {
		  border-collapse: collapse;
		  width: 100%;
		}

		th, td {
		  padding: 8px;
		  text-align: left;
		  border-bottom: 1px solid #ddd;
		}
    </style>

	</head>
	<body>
		<form method="post">
			<?php if($result && $statement->rowCount() > 0): ?>
			<h1>Comments for <?php echo $productName; ?> </h1>
			<table>
				<thead>
				    <tr>
							<th>User</th>
				      <th>Comment</th>
				      <th>Edit</th>
				      <th>Delete</th>
				    </tr>
				</thead>
				<tbody>
					<?php foreach ($result as $row) : ?>
					<tr>
						<td><?php echo $row['username']; ?></td>
					  <td><?php echo htmlspecialchars($row['comment_message']); ?></td>
					  <td><a href="update_comment.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
					  <td><button type="submit" name="submit" value="<?php echo $row["id"]; ?>">Delete</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php else: ?>
		    <h1>There are no comments</h1>
		  <?php endif; ?>
		</form>
		<br>
		<br>
		<?php echo "<a href=\"details.php?Id=".$_GET['product_id']."\">Back to product</a>";?>
	</body>
</html>
