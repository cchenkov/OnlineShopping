<?php

if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
      "Username" => $_POST['username'],
      "FirstName" => $_POST['firstname'],
      "LastName" => $_POST['lastname'],
      "Email" => $_POST['email'],
      "Password" => $_POST['password'],
      "Address" => $_POST['address'],
      "PhoneNumber" => $_POST['phone']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "User",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) {
  echo escape($_POST['firstname']); ?> successfully added
<?php } ?>

<h1>Add a user</h1>
<form method="post">
  <label for="username">Username</label>
  <input type="text" name="username" id="username">
  <br>
  <label for="firstname">First Name</label>
  <input type="text" name="firstname" id="firstname">
  <br>
  <label for="lastname">Last Name</label>
  <input type="text" name="lastname" id="lastname">
  <br>
  <label for="email">Email Address</label>
  <input type="text" name="email" id="email">
  <br>
  <label for="password">Password</label>
  <input type="password" name="password" id="password">
  <br>
  <label for="address">Address</label>
  <input type="text" name="address" id="address">
  <br>
  <label for="phone">Phone Number</label>
  <input type="text" name="phone" id="phone">
  <br>
  <br>
  <input type="submit" name="submit" value="Submit">
</form>

<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>