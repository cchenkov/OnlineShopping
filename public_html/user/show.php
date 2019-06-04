<?php
	require "../../config.php";
	require "../../common.php";

	if (isset($_GET['id'])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$userId = $_GET['id'];

			$sql = "SELECT * FROM User WHERE Id = :userId";

			$statement = $connection->prepare($sql);
			$statement->bindValue(':userId', $userId);
			$statement->execute();

			$user = $statement->fetch();
		} catch (PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	} else {
		echo "Something went wrong!";
		exit;
	}

?>

<?php include "../templates/header.php"; ?>

<h1>Selected User</h1>

<strong>Username - </strong><?php echo escape($user["Username"]); ?><br>
<strong>First Name - </strong><?php echo escape($user["FirstName"]); ?><br>
<strong>Last Name - </strong><?php echo escape($user["LastName"]); ?><br>
<strong>Email - </strong><?php echo escape($user["Email"]); ?><br>
<strong>Address - </strong><?php echo escape($user["Address"]); ?><br>
<strong>Phone Number - </strong><?php echo escape($user["PhoneNumber"]); ?><br>

<br>
<br>

<a href="read.php">Back to all users</a>

<?php include "../templates/footer.php"; ?>
