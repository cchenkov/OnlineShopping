

<?php
    require "../common.php";
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
    


<?php include "templates/footer.php"; ?>
</html>
