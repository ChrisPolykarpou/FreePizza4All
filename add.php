<?php

include("config/db_connect.php");

$errors = ['email' => '', 'title' => '', 'Ingredients' => ''];
$email = '';
$title = '';
$ingredients = '';
//check forms
if (isset($_POST['submit'])) {
  if (empty($_POST['email'])) {
    $errors['email'] = "Email is required";
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Please insert valid email";
    }
  }
  if (empty($_POST['title'])) {
    $errors['title'] = "Pizza Title is required";
  } else {
    $title = $_POST['title'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
      $errors['title'] = "Title must be letters only";
    }
  }
  if (empty($_POST['Ingredients'])) {
    $errors['Ingredients'] = "Ingredients are required";
  } else {
    $ingredients = $_POST['Ingredients'];
  }

  if (array_filter($errors)) {
  } else {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['Ingredients']);

    $sql = "INSERT INTO pizzas(title, email, Ingredients) VALUES('$title', '$email', '$ingredients')";
    if (mysqli_query($conn, $sql)) {
      //data inserted
      header('location: index.php');
    } else {
      echo "query error: " . mysqli_error($conn);
    }
  }
}
?>

<html>

<body>
  <?php include('templates/header.php') ?>

  <section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form class="white addForm" action="add.php" method="POST">
      <label>Your email:</label>
      <input type="text" name="email" value=<?php echo htmlspecialchars($email) ?>>
      <div class="red-text"><?php echo $errors['email']; ?></div>
      <label>Pizza Title:</label>
      <input type="text" name="title" value=<?php echo htmlspecialchars($title) ?>>
      <div class="red-text"><?php echo $errors['title']; ?></div>
      <label>Ingredients (comma seperated):</label>
      <input type="text" name="Ingredients" value=<?php echo htmlspecialchars($ingredients) ?>>
      <div class="red-text"><?php echo $errors['Ingredients']; ?></div>
      <div class="center">
        <input type="submit" name="submit" value="Create Pizza" class="btn brand z-depth 0">
      </div>
    </form>
  </section>


  <?php include('templates/footer.php') ?>

</html>