<html>

<head>
    <title>Tutorial</title>
    <?php include('templates/header.php') ?>
</head>

<style>
    .section {
        width: 1270px;
        margin: auto;
        position: relative;
    }

    .title {
        padding: 0 0 20px 0px;
    }

    li {
        font-size: 16px;
    }
</style>

<body>


    <div class="section">

        <h4 class="center grey-text title">Everyone Loves pizza! This website provides <b>FREE pizzas</b> for everyone!</h4>
        <div class="divider"></div>
        <div class="section">
            <h5>Getting started</h5>
            <li><a href="user/order.php">Order your first Free Pizza</a></li>
            <li><a href="user/add.php">Create your own favourite pizza</a></li>
        </div>
        <div class="divider"></div>
        <div class="section">
            <h5>Admin Panel</h5>
            <li><a href="admin/login.php">Log in as Admin</a></li>
            <li><a href="admin/remove.php">Remove pizza From the menu</a></li>
            <li><a href="admin/orders.php">View & Configure Orders</a></li>
        </div>
        <div class="divider"></div>
    </div>
</body>

</html>