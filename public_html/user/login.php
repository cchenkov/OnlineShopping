<?php

    session_start();

    require '../../lib/password.php';
    require "../../config.php";
    require "../../common.php";
    
    try {
        if ( isset($_POST['login']) ) {
            if ( !empty( $_POST['username'] ) && !empty( $_POST['password'] ) ) {
                $connection = new PDO($dsn, $username, $password, $options);
    
                $sql = "SELECT * FROM User WHERE Username = :username";
    
                $statement = $connection->prepare($sql);
                $statement->bindValue(':username', $_POST['username']);
                $statement->execute();
    
                $user = $statement->fetch(PDO::FETCH_ASSOC);
    
                if ($user == false) {
                    die('Could not find user with that username!');
                }
                else {

                    $validPassword = password_verify($_POST['password'], $user['Password']);
    
                    if($validPassword){
                        $_SESSION['user_id'] = $user['Id'];
                        $_SESSION['logged_in'] = time();

                        echo '<script>console.log(' . $_SESSION['user_id'] . ');</script>';

                        header('Location: ../index.php');
                        //exit;
                        
                    } else { 
                        die($_POST['password']);
                    }
                }
            }
            else {
                die('Fill in the blanks');
            }
        }
    }
    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        exit;
    }

?>

<?php include '../templates/header.php' ?>


<h1>Login</h1>
<form action="login.php" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"><br>
    <br>
    <input type="submit" name="login" value="Login">
</form>

<br>

<a href="../index.php">Back to home</a>

<?php include '../templates/footer.php' ?>