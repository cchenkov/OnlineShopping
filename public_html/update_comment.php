<?php
	require "../config.php";
	require "../common.php";

	if (isset($_POST['submit'])) {
	  try {
	    $connection = new PDO($dsn, $username, $password, $options);

	    $sql = "UPDATE Comment
	            SET Id = :id,
	              	Message = :comment
							WHERE Id = :id";
							
			$statement = $connection->prepare($sql);
			$statement->bindValue(':id', $_POST['id']);
			$statement->bindValue(':comment', $_POST['comment']);
			$statement->execute();

			header("Location: index.php");
			
	  } catch(PDOException $error) {
	    echo $sql . "<br>" . $error->getMessage();
	  }
	}

	if (isset($_GET['id'])) {
	  try {
	    $connection = new PDO($dsn, $username, $password, $options);
	    $id = $_GET['id'];

	    $sql = "SELECT * FROM Comment WHERE Id = :id";
	    $statement = $connection->prepare($sql);
	    $statement->bindValue(':id', $id);
	    $statement->execute();

	    $comment = $statement->fetch(PDO::FETCH_ASSOC);
	  } catch(PDOException $error) {
	      echo $sql . "<br>" . $error->getMessage();
	}
	} else {
	  echo "Something went wrong!";
	  exit;
	}
?>

<h2>Edit comment</h2>

<form method="post">
		<label for="Comment">Comment</label>
		<input type="hidden" name="id" id="id" value="<?php echo $comment["Id"]; ?>">
		<input type="text" name="comment" id="comment" value="<?php echo $comment["Message"]; ?>">
		<br>
		<br>
    <input type="submit" name="submit" value="Submit">
</form>
