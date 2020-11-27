<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <!-- Register Page -->
  <?php if ($_SERVER['PHP_SELF'] == '/tuts/admin/index.php') { ?>
    <title>Admin Panel</title>
  <?php } else { ?>
    <title>Delicious Pizzas</title>
  <?php } ?>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style media="screen">
    .brand {
      background: #cbb09c !important
    }

    .brand-text {
      color: #cbb09c !important
    }

    .addForm {
      width: 600px;
      padding: 20px;
      margin: 20px auto;
    }

    .name {
      font-family: cursive;
      font-size: 19px;
    }

    .icon {
      padding-top: 3.5px;
    }
  </style>
</head>

<body class="grey lighten-4">
  <nav class="white z-depth-0">
    <div class="container">
      <!-- Home page -->
      <?php if ($_SERVER['PHP_SELF'] == '/tuts/index.php') { ?>
        <a href="index.php" class="brand-logo brand-text">FreePizzas4All</a>
        // Check if the user is already logged in
        <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
          <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li><a href="users/userInfo.php" class="name grey-text"><i class="material-icons left icon">person</i><?php echo $_SESSION["username"]; ?></a></li>
            <li><a href="users/logout.php" class="btn brand waves-effect z-depth-1">LOGOUT<i class="material-icons right">exit_to_app</i></a></li>
          </ul>
        <?php
        } else { ?>
          <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li><a href="users/login.php" class="btn brand waves-effect z-depth-1">LOGIN<i class="material-icons left">login</i></a></li>
            <li><a href="users/register.php" class="btn brand waves-effect z-depth-1">SIGN UP<i class="material-icons left">person_add</i></a></li>
          </ul>
        <?php } ?>
      <?php } else if ($_SERVER['PHP_SELF'] == '/tuts/users/register.php') { ?>
        <!-- Register Page -->
        <a href="../index.php" class="brand-logo brand-text">FreePizzas4All</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li><a href="login.php" class="btn brand waves-effect z-depth-1">LOGIN<i class="material-icons left">login</i></a></li>
        </ul>
      <?php } else if ($_SERVER['PHP_SELF'] == '/tuts/users/login.php') { ?>
        <!-- Login Page -->
        <a href="../index.php" class="brand-logo brand-text">FreePizzas4All</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li><a href="register.php" class="btn brand waves-effect z-depth-1">SIGN UP<i class="material-icons left">person_add</i></a></li>
        </ul>
      <?php } else if ($_SERVER['PHP_SELF'] == '/tuts/users/userInfo.php') { ?>
        <!-- User Page -->
        <a href="../index.php" class="brand-logo brand-text">FreePizzas4All</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li><a href="logout.php" class="btn brand waves-effect z-depth-1">LOGOUT<i class="material-icons left">exit_to_app</i></a></li>
        </ul>
      <?php } else if ($_SERVER['PHP_SELF'] == '/tuts/admin/index.php') { ?>
        <!-- ADMIN Login Page -->
        <a href="../index.php" class="brand-logo brand-text">Admin Panel</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li><a href="../index.php" class="btn brand waves-effect z-depth-1">BACK TO WEBSITE<i class="material-icons left">exit_to_app</i></a></li>
        </ul>
      <?php } else if ($_SERVER['PHP_SELF'] == '/tuts/admin/login.php') { ?>
        <!-- ADMIN Home Page -->
        <a href="login.php" class="brand-logo brand-text">Admin Panel</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li><a href="add.php" class="btn-floating btn brand waves-effect waves-light red"><i class="material-icons">add</i></a></li>
          <li><a href="viewOrders.php" class="btn brand waves-effect z-depth-1">ORDERS<i class="material-icons left">store</i></a></li>
          <li><a href="logout.php" class="btn brand waves-effect z-depth-1">LOG OUT<i class="material-icons left">exit_to_app</i></a></li>
          </li>
        </ul>

      <?php } else if ($_SERVER['PHP_SELF'] == '/tuts/admin/viewOrders.php') { ?>
        <!-- ADMIN Orders Page -->
        <a href="login.php" class="brand-logo brand-text">Admin Panel</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li><a href="logout.php" class="btn brand waves-effect z-depth-1">LOG OUT<i class="material-icons left">exit_to_app</i></a></li>
        </ul>
        <?php } else if ($_SERVER['PHP_SELF'] == '/tuts/admin/add.php') { ?>?>
        <!-- ADMIN Add Pizza Page -->
        <a href="login.php" class="brand-logo brand-text">Admin Panel</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li><a href="logout.php" class="btn brand waves-effect z-depth-1">LOG OUT<i class="material-icons left">exit_to_app</i></a></li>
        </ul>
        <?php } else if ($_SERVER['PHP_SELF'] == '/tuts/admin/details-admin.php') { ?>?>
        <!-- ADMIN delete Page -->
        <a href="login.php" class="brand-logo brand-text">Admin Panel</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li><a href="logout.php" class="btn brand waves-effect z-depth-1">LOG OUT<i class="material-icons left">exit_to_app</i></a></li>
        </ul>
      <?php } else { ?>
        <a href="index.php" class="brand-logo brand-text">FreePizza4All</a>
      <?php } ?>
    </div>
  </nav>
</body>
<script type="text/javascript" src="js/materialize.min.js"></script>