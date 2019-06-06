<?php
	require "../config.php";
	require "../common.php";

	if (isset($_GET["comment_id"])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$id = mysqli_real_escape_string($conn, $_POST['id']);

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
