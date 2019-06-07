<?php
	require "../../config.php";
	require "../../common.php";

	if (isset($_POST['submit'])) {

		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$new_user = array(
				"UserId" => $_POST['userid'],
                "ProductId" => $_POST['productid'],
                "Quantity" => $_POST['quantity']
			);

			$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"Cart",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
			);

			$statement = $connection->prepare($sql);
			$statement->execute($new_user);

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}

?>

<?php include "../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) {
	echo escape($_POST['Id']); ?> cart successfully added
<?php } ?>

<h1>Add a user</h1>

<form method="post">
	<label for="userid">UserId</label>
	<input type="number" name="userid" id="userid">
	<br>
	<label for="firstname">ProductId</label>
	<input type="number" name="productid" id="productid">
	<br>
	<label for="quantity">Quantity</label>
	<input type="number" name="quantity" id="quantity">

	<br>
	<br>
	<input type="submit" name="submit" value="Submit">
</form>

<br>
<a href="../index.php">Back to home</a>

<?php include "../templates/footer.php"; ?>
