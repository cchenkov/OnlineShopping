<?php include "templates/header.php"; ?>

<?php 
	session_start();
?>

<ul>
	<li>
		<a href="product/read.php"><strong>View all products</strong></a>
	</li>
	<br>
	<?php
	if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) { ?>
		<li>
			<a href="user/create.php"><strong>Register</strong></a> 
		</li>
		<li>
			<a href="user/login.php"><strong>Login</strong></a>
		</li>
	<?php } else { ?>
		<li>
			<a href="user/read.php"><strong>View all users</strong></a>
		</li>
		<li>
			<a href="product/create.php"><strong>Create product</strong></a>
		</li>
		<li>
			<a href="cart/create.php"><strong>Create cart</strong></a>
		</li>
		<li>
			<a href="cart/read.php"><strong>View Cart</strong></a>
		</li>

		<br>

		<li>
			<a href="user/logout.php"><strong>Logout</strong></a>
		</li>
	<?php } ?>
</ul>

<?php include "templates/footer.php"; ?>