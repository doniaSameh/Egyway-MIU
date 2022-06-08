<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Welcome to EgyWAY website for flight booking" />
    <meta name="author" content="" />
    <title>EgyWAY</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Bootstrap core JS + JQuery -->
    <script src="/egyway/assets/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/egyway/assets/css/bootstrap.min.css">
    <script src="/egyway/assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    session_start();
    $cart_count = '';
    $user = null;
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    if (isset($user) and isset($_SESSION["cart"][$user['id']])) {
        $cart_count = '(' . count($_SESSION["cart"][$user['id']]) . ')';
    }

    //if user already logged in show navigation bar else do not show it in login screen
    if (isset($user)) {
        $customerFeatures = '';
        $qualityControl = '';
        $customerService = '';
        if ($user['role'] === 'customer') {
            $customerFeatures = '<a class="float-right pr-4" href="/egyway/orders.php">My Orders</a>
                                 <a class="float-right pr-4" href="/egyway/cart.php">View Cart ' . $cart_count . '</a>';
        } else if ($user['role'] === 'qualityControl') {
            $qualityControl = '<a class="float-right pr-4" href="/egyway/quality-control/reports.php">Reports</a>
                               <a class="float-right pr-4" href="/egyway/quality-control/comments.php">Traveler Comments</a>';
        } else if ($user['role'] === 'customerService') {
            $customerService = '<a class="float-right pr-4" href="/egyway/customer-service/orders.php">Orders</a>';
        }
        echo '
        <div class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/egyway">EgyWAY</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            </div>
            ' . $customerFeatures . '
            ' . $qualityControl . '
            ' . $customerService . '
            <a class="float-right" href="/egyway/services/logout-service.php">Logout</a>
        </div>
        ';
    }

    ?>