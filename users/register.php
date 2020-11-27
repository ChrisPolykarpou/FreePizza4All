<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../index.php");
    exit;
}

include('../config/db_connect.php');

$username = $password = $cPassword = $email = $address = "";
$username_err = $password_err = $cPassword_err = $email_err = $address_err = "";

if (isset($_POST['register'])) {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT username FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["cPassword"]))) {
            $cPassword_err = "Please confirm password.";
        } else {
            $cPassword = trim($_POST["cPassword"]);
            if (empty($cPassword_err) && ($password != $cPassword)) {
                $cPassword_err = "Password did not match.";
            }
        }

        //validate email
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter your email.";
        } else {
            $email = trim($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Please insert valid email.";
            }
        }
        //validate address
        if (empty(trim($_POST["address"]))) {
            $address_err = "Please enter your address.";
        } else {
            $address = trim($_POST["address"]);
        }

        // Check input errors before inserting in database
        if (empty($username_err) && empty($password_err) && empty($cPassword_err) && empty($email_err) && empty($address_err)) {

            // Prepare an insert statement
            $sql = "INSERT INTO users (username, password, email, address) VALUES (?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_email, $param_address);

                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_email = $email;
                $param_address = $address;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Close connection
        mysqli_close($conn);
    }
}
?>

<html>

<head>
    <title>Register</title>
    <?php include('../templates/header.php') ?>
</head>

<body>
    <style>
        .section {
            width: 600px;
            position: relative;
            margin: auto;
            padding: 20px;
            background-color: white;
            margin-top: 30px;
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

        .reg {
            padding-left: 10px;
            color: #cbb09c;
        }
    </style>
    <div class="section">
        <h2 class="light reg">Register</h2>
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
                <div class="row">
                    <span class="help-block red-text"><?php echo $cPassword_err; ?></span>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input name="cPassword" id="password 2" type="password" class="validate">
                        <label for="password 2">Confirm Password</label>
                    </div>
                </div>
                <div class="row">
                    <span class="help-block red-text"><?php echo $email_err; ?></span>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="icon_prefix 2" type="text" class="validate">
                        <label for="icon_prefix 2">Email</label>
                    </div>
                </div>
                <div class="row">
                    <span class="help-block red-text"><?php echo $address_err; ?></span>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">home</i>
                        <input name="address" id="icon_prefix 3" type="text" class="validate">
                        <label for="icon_prefix 3">Address</label>
                    </div>
                </div>
                <div class="center">
                    <button type="submit" name="register" class="btn brand">Sign up</button>
                </div>
            </form>
            <div class="center">
                <p>Already a member? <a href="login.php">Sign in!</a></p>
            </div>
        </div>
    </div>
</body>


</html>