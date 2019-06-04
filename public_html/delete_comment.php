<?php
	require "../config.php";
	require "../common.php";

	if (isset($_GET["id"])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$id = $_GET["id"];

			$sql = "DELETE FROM Comment WHERE Id = :id";

			$statement = $connection->prepare($sql);
			$statement->bindValue(':id', $id);
			$statement->execute();

			header('Location: all_comments.php');
		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}
?>
