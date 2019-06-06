<?php
	require "../../config.php";
	require "../../common.php";

	if (isset($_POST['submit'])) {
		try {

			$connection = new PDO($dsn, $username, $password, $options);

			$sql = "UPDATE Product
							SET Id = :ProductId,
									ProductName = :name,
									ProductType = :type,
									Description = :description,
									Stock = :stock,
									Price = :price,
									ImageSource = :imgsrc
							WHERE Id = :ProductId
							";

			$statement = $connection->prepare($sql);

			$statement->bindValue(":ProductId", $_POST['Id']);
            $statement->bindValue(":name", $_POST['ProductName']);
            $statement->bindValue(":type", $_POST['ProductType']);
			$statement->bindValue(":description", $_POST['Description']);
			$statement->bindValue(":stock", $_POST['Stock']);
			$statement->bindValue(":price", $_POST['Price']);
			$statement->bindValue(":imgsrc", $_POST['ImageSource']);



			$statement->execute();

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}

	if (isset($_GET['Id'])) {
		try {

			$connection = new PDO($dsn, $username, $password, $options);

			$ProductId = $_GET['Id'];

			$sql = "SELECT * FROM Product WHERE Id = :ProductId";

			$statement = $connection->prepare($sql);
			$statement->bindValue(':ProductId', $ProductId);
			$statement->execute();

			$product = $statement->fetch(PDO::FETCH_ASSOC);

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	} else {
		echo "Something went wrong! GET";
		exit;
	}

?>

<?php require "../templates/header.php"; ?>

<h2>Edit a product</h2>

<?php if (isset($_POST['submit']) && $statement) {
	echo escape($_POST['ProductName']); ?> successfully updated
<?php } ?>

<form method="post">
	<?php foreach ($product as $key => $value) :
		if ($key == "Id") { ?>
			<input type="hidden" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
		<?php
			continue;
		}
		?>
		<label for="<?php echo $key; ?>">
			<?php echo ucfirst($key); ?>
		</label>
		<input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
		<br>
	<?php endforeach; ?>
	<br>
	<input type="submit" name="submit" value="Submit">

</form>

<br>

<a href="../index.php">Back to home</a>

<?php require "../templates/footer.php"; ?>
