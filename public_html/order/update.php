<?php
    session_start();

	require "../../config.php";
	require "../../common.php";

	if (isset($_POST['submit'])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$sql = "UPDATE ProductOrder
                    SET Id = :orderId,
                        ApprovalStatus = :approvalStatus
                    WHERE Id = :orderId
                    ";

			$statement = $connection->prepare($sql);

			$statement->bindValue(":orderId", $_POST['Id']);
            $statement->bindValue(":approvalStatus", $_POST['ApprovalStatus']);

			$statement->execute();

		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
			exit;
		}
	}

	if (isset($_GET['id'])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$orderId = $_GET['id'];

			$sql = "SELECT * FROM ProductOrder WHERE Id = :orderId";

			$statement = $connection->prepare($sql);
			$statement->bindValue(':orderId', $orderId);
			$statement->execute();

            $order = $statement->fetch(PDO::FETCH_ASSOC);

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
    <input type="hidden" name="Id" id="Id" value="<?php echo $order["Id"]; ?>">
    <label for="ApprovalStatus">ApprovalStatus</label>
    <input type="text" name="ApprovalStatus" id="ApprovalStatus" value="<?php echo $order["ApprovalStatus"]; ?>">
	<br>
    <br>
	<input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="read.php">Back to all orders</a>

<?php require "../templates/footer.php"; ?>
