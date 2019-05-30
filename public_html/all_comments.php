<?php
try {
  require "../config.php";
  require "../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Comment";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
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
		<center><h1>Product Comemnts</h1></center>
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
				  <td><?php echo escape($row["Id"]); ?></td>
				  <td><?php echo escape($row["Message"]); ?></td>
				  <td><a href="delete_comment.php?id=<?php echo escape($row["Id"]); ?>">Delete</a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</body>
</html>