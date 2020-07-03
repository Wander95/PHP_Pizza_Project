<?php 
  include('./config/dbConnection.php');

  $errors = array('email'=>'','title'=>'','ingredients'=>'');
  $email ='';
  $title ='';
  $ingredients ='';

  if (isset($_POST['submit'])) {
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['ingredients']);

    if(empty($_POST['email'])){
      $errors['email'] = 'Put an email'; 
    }else{
      $email = "{$_POST['email']}" ;
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
    }

    if(empty($_POST['title'])){
      $errors['title'] = 'A title is required';
    }else{
      $title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
    }

    if(empty($_POST['ingredients'])){
      $errors['ingredients'] = 'At least one ingredient is required';
    }else{
      $ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
    }

    if(!array_filter($errors)){
      header('location:index.php');
    }


    if(array_filter($errors) ){

    }else{
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $title = mysqli_real_escape_string($con,$_POST['title']);
      $ingredients = mysqli_real_escape_string($con,$_POST['ingredients']);
    
      $sql = "INSERT INTO pizzas(title,email,ingredients) 
              VALUES('$title','$email','$ingredients')";
      if(mysqli_query($con,$sql)){
  
      }else{
        echo 'query error: ' . mysqli_error($con);
      }
    }
  }


  

?>


<!DOCTYPE html>
<html lang="en">
  <?php include('templates/header.php') ?>

  <section class="container grey-text">
      <h4 class="center">Add a pizza</h4>
      <form action="add.php" method="POST" class="white" >
        <label for="">Your Email</label>
        <input type="email" name="email" 
          value="<?php echo htmlspecialchars($email) ?>">
          <div class="red-text">
            <?php echo $errors['email']?>
          </div>

        <label for="">Pizza Title</label>
        <input type="text" name="title" 
          value="<?php echo htmlspecialchars($title) ?>">
          <div class="red-text">
            <?php echo $errors['title']?>
          </div>
        <label for="">Ingredients (comma separated):</label>
        <input type="text" name="ingredients" 
          value="<?php echo htmlspecialchars($ingredients) ?>">
          <div class="red-text">
            <?php echo $errors['ingredients']?>
          </div>
        <div class="center">
          <input 
            type="submit" name="submit" 
            value="submit" class='btn brand z-depth-0'>
        </div>
      </form>
    </section>

  <?php include('templates/footer.php') ?>
</html>