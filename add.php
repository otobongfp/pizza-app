<?php

    include 'config/db_connect.php';

    $email = $type = $ingredients = '';
    $errors = array('email'=> 'a','type' => '', 'ingredients' => '');


    if(isset ($_POST['submit'])):

        if (empty($_POST['email'])){
            $errors['email'] = 'your email is required <br/>';
        }else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "email must be valid <br/>";
            }
        }

        if (empty($_POST['type'])){
            $errors['type'] = 'the type of pizza you need is required <br/>';
        }else{
            $type = $_POST['type'];
            if(!preg_match('/^[a-zA-Z\s]+$/',$type)){
                $errors['type'] = "the name of the pizza must be letters and spaces only <br/>";
            }
        }


        if (empty($_POST['ingredients'])){
            $errors['ingredients'] =  'please add the ingredients <br/>';
        }else{
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = "ingredients must be comma seperated <br/>";
            }
        }


        if (!array_filter($errors)) {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            //create sql
            $sql = "INSERT INTO pizzas(type,email,ingredients) VALUES('$type', '$email', '$ingredients')";

            // save to db and check
            if(mysqli_query($conn, $sql)){
                //Success
                header('location: index.php');
            }else{
                //error
                echo 'query error: ' . mysqli_error($conn);
            }

        }

    endif;#end of post check
	

?>


<!DOCTYPE html>
<html>

	<?php include 'templates/header.php';?>

    <section class = "container grey-text">
        <h4 class = "center">Add a Pizza</h4>
        <form class ="white" action="add.php" method = "POST">
            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class = 'red-text'><?php echo $errors['email'].'<br/>';?></div>

            <label>Type of Pizza:</label>
            <input type="text" name="type" value="<?php echo htmlspecialchars($type) ?>">
            <div class = 'red-text'><?php echo $errors['type'].'<br/>';?></div>

            <label>Ingredients (comma seperated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class = 'red-text'><?php echo $errors['ingredients'].'<br/>';?></div>

            <div class = "center">
            <input type= "submit" name = "submit" value = "submit" class = "btn brand z-depth-0">
            </div>
        </form>
    </section>

	<?php include 'templates/footer.php';?>
</html>