<?php
// Initialize the session
session_start();

include('../config/db_connect.php');
if (isset($_POST['dlt-button'])) {

    $deleteItem = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM favourites WHERE id = $deleteItem";

    if (mysqli_query($conn, $sql)) {
        //data deleted successfuly
        header('location: userInfo.php');
    } else {
        echo "query error: " . mysqli_error($conn);
    }
}
$user = $_SESSION["username"];
$sql = "SELECT * FROM orders, pizzas
        WHERE orders.pizza=ID
        and
        orders.name='$user'
        ORDER BY orderID DESC";

// make query and get results
$result = mysqli_query($conn, $sql);
// fetch resulting rows as an array
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

//get favourites of user
$sql = "SELECT * FROM favourites, pizzas
        WHERE favourites.pizza=pizzas.ID
        and
        favourites.username='$user'
        ORDER BY favourites.id DESC";

// make query and get results
$result = mysqli_query($conn, $sql);
// fetch resulting rows as an array
$favourites = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

?>

<html>
<style>
    .section {
        width: 1150px;
        margin: auto;
        position: relative;
        margin-bottom: 4px;
    }

    .table {
        border-radius: 15px;
        padding: 20px;

    }
</style>
<?php include('../templates/header.php') ?>
<h4 class="center grey-text">FAVOURITES</h4>
<section class="section white table">
    <table>
        <?php if (!empty($favourites)) { ?>
            <thead>
                <tr>
                    <th>Pizza</th>
                    <th>Ingredients</th>
                    <th>Action</th>
                </tr>
            </thead>

            <?php foreach ($favourites as $favourite) : ?>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($favourite['title']); ?></td>
                        <td><?php echo htmlspecialchars($favourite['Ingredients']); ?></td>
                        <td>
                            <form method="post">
                                <div>
                                    <input type="hidden" name="id_to_delete" value='<?php echo $favourite['id']; ?>'>
                                    <button action=<?php echo $_SERVER['PHP_SELF']; ?> class="brand btn waves-effect waves-light" name="dlt-button">Delete Favourite
                                        <i class="material-icons right">delete</i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        <?php } else { ?>
            <div class="center">
                <h3 class="light grey-text">You don't have any Favourites yet!</h3>
            </div>
        <?php } ?>
    </table>
</section>

<h4 class="center grey-text">ORDER HISTORY</h4>
<section class="section white table">
    <table>
        <?php if (!empty($orders)) { ?>
            <thead>
                <tr>
                    <th>Address</th>
                    <th>Pizza</th>
                    <th>Ingredients</th>
                </tr>
            </thead>

            <?php foreach ($orders as $order) : ?>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                        <td><?php echo htmlspecialchars($order['title']); ?></td>
                        <td><?php echo htmlspecialchars($order['Ingredients']); ?></td>

                    </tr>
                </tbody>
            <?php endforeach; ?>
        <?php } else { ?>
            <div class="center">
                <h3 class="light grey-text">You don't have any orders yet!</h3>
            </div>
        <?php } ?>
    </table>
</section>

</html>