<?php

	include 'config/db_connect.php';


	// Write Query for all Pizzas
	$sql = 'SELECT id,type,ingredients FROM pizzas ORDER BY order_date';

	// Make query and get result
	$result = mysqli_query($conn, $sql);

	// Fetch the result
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);
	// Close connection
	mysqli_close($conn);

	//print_r($pizzas);

?>


<!DOCTYPE html>
<html>

	<?php include 'templates/header.php';?>

	<h4 class="center grey-text">Pizzas!</h4>
	<div class="container">
		<div class="row">
			
			<?php foreach($pizzas as $pizza): ?>

				<div class="col s6 md3">
					<div class= "card">
						<div class="card-content center">
							<h5><?php echo htmlspecialchars($pizza['type']);?></h5>
							<ul>
								<?php foreach(explode(',', $pizza['ingredients']) as $ingred): ?>
									<li><?php echo htmlspecialchars($ingred); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align ">
							<a  class="brand-text" href="details.php?id=<?php echo $pizza['id'];?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include 'templates/footer.php';?>
	
</html>