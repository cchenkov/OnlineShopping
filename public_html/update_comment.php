<?php
	require "../config.php";
	require "../common.php";

	if (isset($_POST['submit'])) {
	  try {
	    $connection = new PDO($dsn, $username, $password, $options);
	    $cmt =[
	      "Id" => $_POST['id'],
	      "Message" => $_POST['comment'],
	    ];

	    $sql = "UPDATE Comment
	            SET Id = :id,
	              	Message = :comment
	            WHERE Id = :id";
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

<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($comment as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
      <br>
      <br>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
