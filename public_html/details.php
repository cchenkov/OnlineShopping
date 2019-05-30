<?php
if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);
 
    $new_comment = array(
      "Message" => $_POST['comment'],
      //"ProductId" => $_POST[$this->product->id]
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
  }
}

if (isset($_POST['rate'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);
 
    $new_rating = array(
      "Value" => $_POST['rating'],
      //"ProductId" => $_POST[$this->product->id]
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "Rating",
      implode(", ", array_keys($new_rating)),
      ":" . implode(", :", array_keys($new_rating))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_rating);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
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

</head>
<body>
    <h2>Details</h2>

	<?php if (isset($_POST['submit']) && $statement) {
	  echo escape($_POST['name']); ?> successfully added
	<?php } ?>
    <form method="post">
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
	<button><a href="all_comments.php">Show all comments</a></button> 
</body>

<?php include "templates/footer.php"; ?>
</html>
