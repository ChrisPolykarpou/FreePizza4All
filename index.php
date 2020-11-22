<?php

include('config/db_connect.php');

$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY CreatedAt';

// make query and get results
$result = mysqli_query($conn, $sql);
// fetch resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include('templates/header.php') ?>
<style media="screen">
  .pizza {
    width: 180px;
    padding: 20px;
  }

  .box {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: row;
    height: 310px;
  }

  .slidis {
    width: 1270px;
    margin: auto;
    position: relative;
  }

  .bite {
    padding-top: 25px;
  }

  .container {
    width: 1300px;
  }
</style>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>

<!--Other element insitialisations-->
<script type="text/javascript" language="javascript">
  $(document).ready(function() {
    $('.slider').slider();
  });
</script>

<div class="slidis">
  <div class="slider">
    <ul class="slides">
      <li>
        <img src="img/pizza3.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3>Best Pizza in Town!</h3>
          <h5 class="light grey-text text-lighten-3">Order now online!</h5>
        </div>
      </li>
      <li>
        <img src="img/pizza5.jpg"> <!-- random image -->
        <div class="caption right-align">
          <h3 class="bite">Enjoy Every bite</h3>
          <h5 class="light grey-text text-lighten-3">Always fresh and free!</h5>
        </div>
      </li>
      <li>
        <img src="img/delivery3.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3 class="white-text text-lighten-3">Hungry? Order Now!</h3>
          <h5 class="light white-text text-lighten-3">Delivery in no Time.</h5>
        </div>
      </li>
    </ul>
  </div>
</div>

<h4 class="center grey-text">Do good. Be nice. Order pizza. Repeat.</h4>
<div class="container">
  <div class="row">
    <?php foreach ($pizzas as $pizza) : ?>
      <div class="col s6 md3">
        <div class="card box hoverable">
          <img src="pizza.jpg" class="circle pizza" alt="pizza-icon">
          <div class="card-content center">
            <h5><?php echo htmlspecialchars($pizza['title']); ?></h5>
            <ul>
              <?php foreach (explode(',', $pizza['ingredients']) as $ing) : ?>
                <li><?php echo htmlspecialchars($ing); ?></li>
              <?php endforeach; ?>
            </ul>
            <div class="card-action right-align">
              <a href="details.php?id=<?php echo $pizza['id']; ?>" class="brand-text">more info</a>
              <a href="order.php?id=<?php echo $pizza['id']; ?>" class="brand-text">Order Now!</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
  var instance = M.Carousel.init({
    fullWidth: true
  });
</script>

<?php include('templates/footer.php') ?>

</html>