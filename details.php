<?php 
  include('./config/dbConnection.php');

  if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);

		$sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

		if(mysqli_query($con, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($con);
		}

	}

  if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($con,$_GET['id']);

    $sql = "SELECT * FROM pizzas where id = $id";

    $result = mysqli_query($con,$sql);

    $pizza = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($con);
  }


  
?>

<!DOCTYPE html>
<html>
  <?php include('templates/header.php') ?>

    <div class="container center">
      <?php if($pizza): ?>
        <h4><?php echo htmlspecialchars($pizza['title'])?></h4>
        <p><?php echo htmlspecialchars($pizza['email'])?></p>
        <h5>Ingredients: </h5>
        <p><?php echo htmlspecialchars($pizza['ingredients'])?></p>
      
      <form action="details.php" method="POST">
      <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
      </form>
      
      <?php else: ?>
        <h5>No such a pizza exits</h5>
      <?php endif ?>
    </div>
  <?php include('templates/footer.php'); ?>
</html>