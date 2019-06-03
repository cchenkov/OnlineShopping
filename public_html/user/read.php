<?php
    require "../config.php";
    require "../common.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM User";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
?>

<?php include "templates/header.php"; ?>

<head>
    <link rel="stylesheet" href="css/table.css">
</head>

<?php
    if ($result && $statement->rowCount() > 0) { ?>
        <h1>All Users</h1>

        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Show</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo escape($row["Username"]); ?></td>
                        <td><?php echo escape($row["FirstName"]); ?></td>
                        <td><?php echo escape($row["LastName"]); ?></td>
                        <td><?php echo escape($row["Email"]); ?></td>
                        <td><?php echo escape($row["Address"]); ?></td>
                        <td><?php echo escape($row["PhoneNumber"]); ?></td>
                        <td><a href="show.php?id=<?php echo $row["Id"]; ?>">Show</a></td>
                        <td><a href="update.php?id=<?php echo $row["Id"]; ?>">Edit</a></td>
                        <td><a href="delete.php?id=<?php echo $row["Id"]; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <blockquote>No users found.</blockquote>
    <?php }
?>

<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>