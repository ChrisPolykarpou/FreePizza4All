<?php

include('../config/db_connect.php');

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
<?php include('../templates/adminHeader.php') ?>
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
</style>

<h4 class="center grey-text">Configure Pizza Shop</h4>
<div class="container">
  <div class="row">
    <?php foreach ($pizzas as $pizza) : ?>
      <div class="col s6 md3">
        <div class="card box hoverable">
          <img src="../pizza.jpg" class="circle pizza" alt="pizza-icon">
          <div class="card-content center">
            <h5><?php echo htmlspecialchars($pizza['title']); ?></h5>
            <ul>
              <?php foreach (explode(',', $pizza['ingredients']) as $ing) : ?>
                <li><?php echo htmlspecialchars($ing); ?></li>
              <?php endforeach; ?>
            </ul>
            <div class="card-action right-align">
              <a href="details-admin.php?id=<?php echo $pizza['id']; ?>" class="brand-text">info&remove</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include('../templates/footer.php') ?>

</html>