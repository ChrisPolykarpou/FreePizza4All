<?php
if (!isset($_SESSION)) {
    session_start();
}
//if user is logged in add to his favourites
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // Get Pizza ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    //get username
    $user = $_SESSION["username"];
    include('../config/db_connect.php');
    // Check if pizza already exist in favourites
    //get favourites of user
    $sql = "SELECT * FROM favourites
        WHERE
        favourites.username='$user'
        ORDER BY favourites.id DESC";

    // make query and get results
    $result = mysqli_query($conn, $sql);
    // fetch resulting rows as an array
    $favourites = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    foreach ($favourites as $favourite) {
        if ($favourite["pizza"] === $id) {
            header('location: login.php');
            exit;
        }
    }
    // store pizza id to users-favourites
    $sql = "INSERT INTO favourites(username, pizza) VALUES('$user', '$id')";
    if (mysqli_query($conn, $sql)) {
        header('location: ../index.php');
    } else {
        echo "query error: " . mysqli_error($conn);
    }
} else {
    header('location: login.php');
    exit;
}
