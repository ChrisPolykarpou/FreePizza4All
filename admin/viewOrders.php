<?php
// Initialize the session
session_start();

// Check if the user is logged in.
if (!(isset($_SESSION["ad-loggedin"]) && $_SESSION["ad-loggedin"] === true)) {
    header("location: index.php");
    exit;
}

include('../config/db_connect.php');

if (isset($_POST['dlt-button'])) {

    $deleteItem = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM orders WHERE orderID = $deleteItem";

    if (mysqli_query($conn, $sql)) {
        //data deleted successfuly
        header('location: viewOrders.php');
    } else {
        echo "query error: " . mysqli_error($conn);
    }
}

$sql = 'SELECT * FROM orders, pizzas
        WHERE orders.pizza=ID
        ORDER BY orderID DESC';

// make query and get results
$result = mysqli_query($conn, $sql);
// fetch resulting rows as an array
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

?>

<html>
<style>
    .section {
        width: 1390px;
        margin: auto;
        position: relative;
        margin-bottom: 4px;
    }
</style>
<?php include('../templates/header.php') ?>
<h4 class="center grey-text">ALL ORDERS</h4>
<section class="section">
    <table class="centered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Address</th>
                <th>Pizza</th>
                <th>Ingredients</th>
                <th>Options</th>
            </tr>
        </thead>
        <?php foreach ($orders as $order) : ?>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                    <td><?php echo htmlspecialchars($order['address']); ?></td>
                    <td><?php echo htmlspecialchars($order['title']); ?></td>
                    <td><?php echo htmlspecialchars($order['Ingredients']); ?></td>
                    <td>
                        <form method="post">
                            <div>
                                <input type="hidden" name="id_to_delete" value='<?php echo $order['orderID']; ?>'>
                                <button action=<?php echo $_SERVER['PHP_SELF']; ?> class="brand btn waves-effect waves-light" name="dlt-button">Clear Order
                                    <i class="material-icons right">delete</i>
                                </button>
                            </div>
                        </form>
                    </td>

                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</section>



</html>