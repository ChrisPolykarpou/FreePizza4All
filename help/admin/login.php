<html>
<?php include('../templates/header.php') ?>
<h3 class="center grey-text">Login as Admin</h3>

<style>
    .section {
        width: 1300px;
        position: realative;
        margin: auto;
        padding: 20px;
        margin-top: 20px;
        border-radius: 20px;
    }

    .img {
        width: 1200px;
    }
</style>
<div class="section white">
    <h5 class="grey-text">You can login to the back of the shop as an admin.</h5>
    <h5 class="grey-text">Admin can configure the <a href="remove.php">menu</a> and <a href="orders.php">orders</a> of the restaurant.
    </h5>
    <h5 class="grey-text">1. type "/admin" into the url bar"</h5>
    <img class="img" src="admin.jpg" alt="admin-login">
    <h5 class="grey-text">2. Next enter your username and password (Default username is "admin" and password "admin")</h5>
    <h5 class="grey-text">3. Configure your shop. <a href="remove.php">Remove a pizza</a> or <a href="orders.php">view & manage orders</a></h5>
</div>

</html>