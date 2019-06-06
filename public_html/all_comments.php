<?php
	try {
	  require "../config.php";
	  require "../common.php";

	  $connection = new PDO($dsn, $username, $password, $options);
		$product_id = $_GET['product_id'];
		$sql = "SELECT * FROM Comment WHERE ProductId = $product_id";
		$result = mysqli_query($conn, $sql);
		$comment = mysqli_fetch_assoc($result);

		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();

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

		<?php if($comment): ?>
		<center><h1>Product Comments</h1></center>
		<table>
			<thead>
			    <tr>
			      <th>#</th>
			      <th>Comment</th>
			       <th>Delete</th>
			    </tr>
			</thead>
			<tbody>
				<?php foreach ($result as $row) : ?>
				<tr>
				  <td><?php echo htmlspecialchars($comment['Id']); ?></td>
				  <td><?php echo htmlspecialchars($comment['Message']); ?></td>
				  <td><a href="delete_comment.php?id=<?php echo escape($comment["Id"]); ?>">Delete</a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php else: ?>
	    <h5>Doesnt exist!</h5>
	  <?php endif; ?>

	</body>
</html>
