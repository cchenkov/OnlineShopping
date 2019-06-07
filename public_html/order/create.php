<?php
    require "../../config.php";
    require "../../common.php";
    
    if (isset($_POST['order'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
			exit;
        }
    }
?>