<?php 
   
	require 'config.php';
	require 'common.php';
    
    $conn = mysqli_connect($dsn, $username, $password, $options);
	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }
    
    $sql = 'SELECT ProductName, Price, ImageSource FROM Product ORDER BY created_at';
	$result = mysqli_query($conn, $sql);
	
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Products</h4>

	<div class="container">
		<div class="row">

			<?php foreach($products as $product){ ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($product['ProdcutName']); ?></h6>
							<div><?php echo htmlspecialchars($product['Price']); ?></div>
                            <div><?php echo htmlspecialchars($product['ImageSource']); ?></div>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="#">more info</a>
						</div>
					</div>
				</div>

			<?php } ?>

		</div>
	</div>

</html>