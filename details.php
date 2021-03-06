<?php

include('config/db_connect.php');

if (isset($_POST['dlt-button'])) {

  $deleteItem = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
  $sql = "DELETE FROM pizzas WHERE id = $deleteItem";

  if (mysqli_query($conn, $sql)) {
    //data deleted successfuly
    header('location: index.php');
  } else {
    echo "query error: " . mysqli_error($conn);
  }
}

if (isset($_GET['id'])) {

  $id = mysqli_real_escape_string($conn, $_GET['id']);

  //make sql
  $sql = "SELECT * FROM pizzas WHERE id = $id";

  //get results
  $result = mysqli_query($conn, $sql);

  // save result in array
  $pizza = mysqli_fetch_assoc($result);

  //free and close connection
  mysqli_free_result($result);
  mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<style>
  .details-cont {
    width: 1000px;
    position: relative;
    margin: auto;
  }

  .details {
    padding: 50px;
  }

  .pizza {
    width: 280px;
  }
</style>
<?php include('templates/header.php') ?>

<div class="details-cont">
  <div class="container center details">
    <h3 class="center">Pizza: <?php echo htmlspecialchars($pizza['title']); ?></h3>
    <h5 class="center">Ingredients: <?php echo htmlspecialchars($pizza['Ingredients']); ?></h5>
    <h5 class="center">Created at: <?php echo htmlspecialchars($pizza['CreatedAt']); ?></h5>
    <img src="pizza.jpg" class="circle pizza" alt="pizza-icon">

  </div>
</div>


<?php include('templates/footer.php') ?>

</html>