<?php
    session_start();

	require "../../config.php";
	require "../../common.php";

	if (isset($_POST['submit'])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$sql = "UPDATE Cart
                    SET Id = :cartId,
                        Quantity = :quantity
                    WHERE Id = :cartId
                    ";

			$statement = $connection->prepare($sql);

			$statement->bindValue(":cartId", $_POST['id']);
            $statement->bindValue(":quantity", $_POST['quantity']);

			$statement->execute();

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}

	if (isset($_GET['id'])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$cartItemId = $_GET['id'];

			$sql = "SELECT c.Id AS id, p.ProductName AS product, c.Quantity AS quantity, p.Price as price
					FROM Cart c
					LEFT JOIN Product p ON c.ProductId = p.Id
					WHERE c.UserId = :userid AND c.Id = :cartItemId";

			$statement = $connection->prepare($sql);
            $statement->bindValue(':userid', $_SESSION["user_id"]);
            $statement->bindValue(':cartItemId', $cartItemId);
			$statement->execute();

            $cartItem = $statement->fetch(PDO::FETCH_ASSOC);

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	} else {
		echo "Something went wrong! GET";
		exit;
	}

?>

<?php require "../templates/header.php"; ?>

<h2>Edit Order Status</h2>

<?php 
    if (isset($_POST['submit']) && $statement) {
        echo escape('Order status updated successfully');
    } 
?>

<form method="post">
    <input type="hidden" name="id" id="id" value="<?php echo $cartItem["id"]; ?>">
    <label for="Product">Product:</label>
    <p><?php echo $cartItem["product"] ?></p>
    <label for="Price">Price:</label>
    <p><?php echo $cartItem["price"] ?></p>
    <label for="Quantity">Quanity:</label>
    <input type="text" name="quantity" id="quantity" value="<?php echo $cartItem["quantity"]; ?>">
	<br>
    <br>
	<input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="read.php">Back to all orders</a>

<?php require "../templates/footer.php"; ?>
