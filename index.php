<?php 
  include('./config/dbConnection.php');
  
  $sql = 'SELECT * FROM pizzas';

  $result = mysqli_query($con,$sql);

  $pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);

  mysqli_free_result($result);

  explode(',',$pizzas[0]['ingredients']);

  mysqli_close($con);

?>
<!DOCTYPE html>

<html lang="en">

  <?php include('templates/header.php') ?>

    <h4 class="center gray-text">Pizzas</h4>

    <div class="container">
      <div class="row">
        <?php foreach ($pizzas as $pizza) :?>
          <div class="col s6 md3">
            <div class="card z-depth-0">
              <img class="pizza" src="images/pizza.svg" alt="nothing" srcset="">
              <div class="card-content center">
                <h6><?php echo htmlspecialchars($pizza['title']) ?></h6>
                <ul>
                  <?php $ingredient = explode(',',$pizza['ingredients']); 
                    foreach ($ingredient as $recipe) { ?>
                    <li class="center"><?php echo htmlspecialchars($recipe) ?></li>
                  <?php }?>
                </ul>
              </div>

              <div class="card-action right-align">
                <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">More info</a>
              </div>

            </div>
          </div>
        <?php endforeach;?>
          
      </div>
    </div>


    <?php include('templates/footer.php'); ?>
</html>