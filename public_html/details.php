
<?php
    require "../common.php";
    require "../config.php";
    $conn = mysqli_connect($host, $username, $password, $dbname);
	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }else{
		
        if(isset($_GET['id'])){
            $Id = mysqli_real_escape_string($conn, $_GET['Id']);

            $sql = "SELECT * FROM Product WHERE id = $id";

            $result = mysqli_query($conn, $sql);

            $product = mysql_fetch_assoc($result);//for one record

            mysqli_free_result($result);
            mysqli_close($conn);
        }
        $result = mysqli_query($conn, $sql);
	}

?>
    


<!DOCTYPE html>
<html lang="en">
<?php include "templates/header.php"; ?>

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
