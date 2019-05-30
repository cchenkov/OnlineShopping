
<?php
    require "../common.php";
    require "../config.php";
    $conn = mysqli_connect($host, $username, $password, $dbname);
	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }else{

        if(isset($_POST['delete'])){
            $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

            $sql = "DELETE FROM Product WHERE Id = $id_to_delete";

            if(mysqli_query($conn, $sql)){
                header('Location: index.php');
            }{
                echo 'query error:'. mysqli_error($conn);
            }
        }
		
        if(isset($_GET['Id'])){
            $Id = mysqli_real_escape_string($conn, $_GET['Id']);

            $sql = "SELECT * FROM Product WHERE Id = $Id";

            $result = mysqli_query($conn, $sql);

            $product = mysqli_fetch_assoc($result);//for one record

        }
    }
    


?>
    

<!DOCTYPE html>
<html lang="en">
<?php include "templates/header.php"; ?>

    <h2>Details</h2>

    <?php if($product): ?>
        <h4><?php echo htmlspecialchars($product['ProductName']); ?></h4>
        <p>Type: <?php echo htmlspecialchars($product['ProductType']); ?></p>
        <p>Description: <?php echo htmlspecialchars($product['Descriptoin']); ?></p>
        <p>Stock: <?php echo htmlspecialchars($product['Stock']); ?></p>
        <p>Price: <?php echo htmlspecialchars($product['Price']); ?></p>
        <p>Image:</p>

        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $product['Id'] ?>">
            <input type="submit" name="delete" value="Delete">
        </form>

    <?php else: ?> 
      <h5>Doesnt exist!</h5>
    
    <?php endif; ?>




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
    <a href="index.php">Back to home</a>
</body>

<?php include "templates/footer.php"; ?>
</html>
