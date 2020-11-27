<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../index.php");
    exit;
}

include('../config/db_connect.php');

$username = $password = "";
$username_err = $password_err = "";
if (isset($_POST['login'])) {
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: ../index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered is incorrect";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}

?>
<html>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
<?php include('../templates/header.php') ?>
<title>Member Login</title>
<style>
    .section {
        width: 400px;
        position: relative;
        margin: auto;
        padding: 20px;
        background-color: white;
        margin-top: 60px;
        border-radius: 20px;
    }

    /* icon prefix focus color */
    .input-field .prefix.active {
        color: #cbb09c;
    }

    /* label focus color */
    .input-field input[type=text]:focus+label {
        color: #cbb09c !important;
    }

    /* label focus color */
    .input-field input[type=password]:focus+label {
        color: #cbb09c !important;
    }

    /* label underline focus color */
    .input-field input[type=password]:focus {
        border-bottom: 1px solid #cbb09c !important;
        box-shadow: 0 1px 0 0 #cbb09c !important;
    }

    /* label underline focus color */
    .input-field input[type=text]:focus {
        border-bottom: 1px solid #cbb09c !important;
        box-shadow: 0 1px 0 0 #cbb09c !important;
    }

    .help-block {
        margin-left: 56px;
    }
</style>
<div class="section">
    <div class="row">
        <form method="POST" class="col s12">
            <div class="row">
                <span class="help-block red-text"><?php echo $username_err; ?></span>
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input name="username" id="icon_prefix" type="text" class="validate">
                    <label for="icon_prefix">Username</label>
                </div>
            </div>
            <div class="row">
                <span class="help-block red-text"><?php echo $password_err; ?></span>
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input name="password" id="password" type="password" class="validate">
                    <label for="password">Pasword</label>
                </div>
            </div>
            <div class="center">
                <button type="submit" name="login" class="btn brand">Login</button>
            </div>
        </form>
        <div class="center">
            <p>Not a member? <a href="register.php">Register Now!</a></p>
        </div>
    </div>
</div>

</html>