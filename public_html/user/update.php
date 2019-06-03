<?php
	require "../../config.php";
	require "../../common.php";

	if (isset($_POST['submit'])) {
		try {

			$connection = new PDO($dsn, $username, $password, $options);

			$sql = "UPDATE User
							SET Id = :userId,
									Username = :username,
									FirstName = :firstname,
									LastName = :lastname,
									Email = :email,
									Password = :password,
									Address = :address,
									PhoneNumber = :phonenumber
							WHERE Id = :userId";

			$statement = $connection->prepare($sql);

			$statement->bindValue(":userId", $_POST['Id']);
			$statement->bindValue(":username", $_POST['Username']);
			$statement->bindValue(":firstname", $_POST['FirstName']);
			$statement->bindValue(":lastname", $_POST['LastName']);
			$statement->bindValue(":email", $_POST['Email']);
			$statement->bindValue(":password", $_POST['Password']);
			$statement->bindValue(":address", $_POST['Address']);
			$statement->bindValue(":phonenumber", $_POST['PhoneNumber']);    

			// can't seem to make it work

			$statement->execute();

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}

	if (isset($_GET['id'])) {
		try {

			$connection = new PDO($dsn, $username, $password, $options);

			$userId = $_GET['id'];

			$sql = "SELECT * FROM User WHERE Id = :userId";

			$statement = $connection->prepare($sql);
			$statement->bindValue(':userId', $userId);
			$statement->execute();

			$user = $statement->fetch(PDO::FETCH_ASSOC);

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	} else {
		echo "Something went wrong! GET";
		exit;
	}

?>

<?php require "../templates/header.php"; ?>

<h2>Edit a user</h2>

<form method="post">
	<?php foreach ($user as $key => $value) : 
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