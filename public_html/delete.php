<?php
    require "../config.php";
    require "../common.php";

    $success = null;

    if (isset($_POST["submit"])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        
            $id = $_POST["submit"];

            $sql = "DELETE FROM User WHERE Id = :id";

            $statement = $connection->prepare($sql);

            $statement->bindValue(':id', $id);
            $statement->execute();

            $success = "User successfully deleted";
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM User";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
?>
<?php require "templates/header.php"; ?>
        
<h2>Delete users</h2>

<?php if ($success) echo $success; ?>

<form method="post">
  <table>
    <thead>
      <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["Username"]); ?></td>
        <td><?php echo escape($row["FirstName"]); ?></td>
        <td><?php echo escape($row["LastName"]); ?></td>
        <td><?php echo escape($row["Email"]); ?></td>
        <td><?php echo escape($row["Address"]); ?></td>
        <td><?php echo escape($row["PhoneNumber"]); ?></td>
        <td><button type="submit" name="submit" value="<?php echo escape($row["Id"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>