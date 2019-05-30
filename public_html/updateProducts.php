<?php
    require '../config.php';
    require '../common.php';

    $conn = mysqli_connect($host, $username, $password, $dbname);
	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }else{

        if(isset($_GET['Id'])){
            $Id = mysqli_real_escape_string($conn, $_GET['Id']);

            $sql = "SELECT * FROM Product WHERE Id = $Id";

            $result = mysqli_query($conn, $sql);

            $product = mysqli_fetch_assoc($result);//for one record
            

        }
        
        if(isset($_POST['edit'])){
            $Id = $_POST['Id'];
            $name = $_POST['ProductName'];
            $type = $_POST['ProductType'];
            $desc = $_POST['Description'];
            $stock = $_POST['Stock'];
            $price = $_POST['Price'];

            mysql_query("UPDATE Product SET ProductType = '$type', ProductName = '$name', Description = '$desc', Stock = '$stock', Price = '$price' WHERE id = $id");

        }

    }

?>

<?php include "templates/header.php"; ?>
<h2>Update a Product</h2>

<form method="post">
  <label for="name">Name</label>
  <input type="text" name="name" id="name">
  <br>
  <label for="type">Type</label>
  <input type="text" name="type" id="type">
  <br>
  <label for="description">Description</label>
  <input type="text" name="description" id="description">
  <br>
  <label for="stock">Stock</label>
  <input type="number" name="stock" id="stock">
  <br>
  <label for="price">Price</label>
  <input type="number" name="price" id="price">
 
  <br>
  <input type="submit" name="edit" value="Update">
</form>

<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>