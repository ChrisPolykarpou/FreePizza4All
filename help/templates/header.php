<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Help center</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    </style>
</head>

<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <?php if ($_SERVER["PHP_SELF"] == "/freePizza4All/help/index.php") { ?>
                <a href="index.php" class="brand-logo brand-text">FreePizzas4All - Docs</a>
            <?php } else { ?>
                <a href="../index.php" class="brand-logo brand-text">FreePizzas4All - Docs</a>
            <?php } ?>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="../freepizza4all" class="btn brand waves-effect z-depth-0">START NOW</a></li>
            </ul>
        </div>
    </nav>
</body>