<?php

	include ('config/db_connect.php');

	if (isset($_POST['delete'])) {
		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

		if (mysqli_query($conn, $sql)) {
			//success
			header('location: index.php');

		}else{
			echo 'query error: ' . mysqli_error($conn);
		}
	}

	//check GET request id parameter

	if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //make sql
        $sql = "SELECT * FROM pizzas WHERE id = $id";

        //get the query result
        $result = mysqli_query($conn, $sql);

        //fetch the result in an assoc array
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);


	}

?>

<!DOCTYPE html>
<html>

    <?php include 'templates/header.php'; ?>

    <h2 class = "grey-text center">Details</h2>

    <div class="container center">

    	<?php if($pizza): ?>
    		<h5 class="brand-text"><?php echo htmlspecialchars($pizza['type']);?></h5>
    		<p>Ordered by: <?php echo htmlspecialchars($pizza['email']); ?></p>
    		<p><?php echo date($pizza['order_date']); ?></p>
    		<h5>Ingredients:</h5>
    		<p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

    	<!-- Delete Form-->
    	<form action="details.php" method="POST">
    		<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'];?>">
    		<input type="submit" name="delete" value="Delete" class="btn brand z-depth0">
    	</form>


    	<?php else: ?>
    		<h5>No Such Pizza Exists!</h5>

    	<?php endif; ?>

    </div>


    <?php include 'templates/footer.php'; ?>

</html