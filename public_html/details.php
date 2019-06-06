<?php
  require "../common.php";
  require "../config.php";
  $conn = mysqli_connect($host, $username, $password, $dbname);

	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else {
		if(isset($_GET['Id'])){
			$Id = mysqli_real_escape_string($conn, $_GET['Id']);
			$sql = "SELECT * FROM Product WHERE Id = $Id";
			$result = mysqli_query($conn, $sql);
			$product = mysqli_fetch_assoc($result);
		}

		if (isset($_POST['submit'])) {
			try {
				$connection = new PDO($dsn, $username, $password, $options);
				$new_comment = array(
					"Message" => $_POST['comment'],
					"ProductId" => $_GET['Id']
				);
				$sql = sprintf(
					"INSERT INTO %s (%s) values (%s)",
					"Comment",
					implode(", ", array_keys($new_comment)),
					":" . implode(", :", array_keys($new_comment))
				);
				$statement = $connection->prepare($sql);
				$statement->execute($new_comment);
			} catch(PDOException $error) {
				echo $sql . "<br>" . $error->getMessage();
        exit;
			}
		}
		if (isset($_POST['rate'])) {
			try {
				$connection = new PDO($dsn, $username, $password, $options);
				$product_id = mysqli_real_escape_string($connection, $_GET['Id']);

				$new_rating = array(
					"Value" => $_POST['rating'],
					"ProductId" => $_GET['Id']
				);

				$sql = sprintf(
					"INSERT INTO %s (%s) VALUES (%s)",
					"Rating",
					implode(", ", array_keys($new_rating)),
					":" . implode(", :", array_keys($new_rating))
				);

				$statement = $connection->prepare($sql);
				$statement->execute($new_rating);

			} catch(PDOException $error) {
				echo $sql . "<br>" . $error->getMessage();
        exit;
			}
		}
		if(isset($_POST['delete'])){
			$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

			$sql = "DELETE FROM Product WHERE Id = $id_to_delete";

			if(mysqli_query($conn, $sql)){
				header('Location: index.php');
			}
			else {
				echo 'query error:'. mysqli_error($conn);
			}
		}
  }
?>

<!DOCTYPE html>
<html lang="en">

<?php include "templates/header.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/rating_stars.css">
    <title>Document</title>

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

    <h2>Details</h2>

    <?php if($product): ?>
        <h4><?php echo htmlspecialchars($product['ProductName']); ?></h4>
        <p>Type: <?php echo htmlspecialchars($product['ProductType']); ?></p>
        <p>Description: <?php echo htmlspecialchars($product['Descriptoin']); ?></p>
        <p>Stock: <?php echo htmlspecialchars($product['Stock']); ?></p>
        <p>Price: <?php echo htmlspecialchars($product['Price']); ?></p>
        <p>Image:</p>
				<a href="product/update.php?Id=<?php echo $Id; ?>">Update</a>

        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $product['Id'] ?>">
            <input type="submit" name="delete" value="Delete">
        </form>

    <?php else: ?>
      <h5>Doesnt exist!</h5>
    <?php endif; ?>

	<?php if (isset($_POST['submit']) && $statement) {
	  echo escape($_POST['name']); ?> successfully added
	<?php } ?>

  	<form method="POST">
		<label for="comment">Add Comment</label>
		<textarea name="comment" rows="5" cols="40"></textarea>
		<br>
		<br>
		<input type="submit" name="submit" value="Submit Comment">
		<br>
		<br>
		<label for="rating">Rating</label>
			<input type="number" name="rating" id="rating" min="1" max="5">
		<br>
		<br>
		<input type="submit" name="rate" value="Rate">
		<br>
		<br>
	</form>
	<?php echo "<a href=\"all_comments.php?product_id=".$_GET['Id']."\">View comments</a>";?>
	<br>
	<a href="index.php?Id=.$_GET['Id'].">Back to home</a>
</body>

<?php include "templates/footer.php"; ?>

</html>
