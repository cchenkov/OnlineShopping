<?php

  if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $new_product = array(
        "ProductName" => $_POST['name'],
        "ProductType" => $_POST['type'],
        "Description" => $_POST['description'],
        "Stock" => $_POST['stock'],
        "Price" => $_POST['price'],
        "ImageSource" => $_POST['imgsrc']
      );

      $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "Product",
        implode(", ", array_keys($new_product)),
        ":" . implode(", :", array_keys($new_product))
      );

      $statement = $connection->prepare($sql);
      $statement->execute($new_product);

    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
      exit;
    }
  }

?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) {
  echo escape($_POST['name']); ?> successfully added
<?php } ?>

<h1>Add a Product</h1>
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
  <label for="imgsrc">Image Source</label>
  <input type="file" name="imgsrc" id="imgsrc">
  <br>
  <br>
  <input type="submit" name="submit" value="Submit">
</form>

<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
