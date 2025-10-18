<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$user_id = $_SESSION['user_id'];
$item_ids_string = $_GET['itemsid'];

// Change the status of the purchased items to 'Confirmed'
$query = "UPDATE users_items SET status='Confirmed' WHERE user_id=" . $user_id . " AND item_id IN (" . $item_ids_string . ") and status='Added to cart'";
mysqli_query($con, $query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Success | Life Style Store</title>
    <link rel="shortcut icon" href="img/srtcticon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <style>
        .my-orders-btn {
            display: inline-block;
            margin-top: 15px;
            background-color: #337ab7;
            color: #fff;
            padding: 10px 18px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
        }
        .my-orders-btn:hover {
            background-color: #286090;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-fluid" id="content">
        <div class="col-md-12">
            <div class="jumbotron text-center">
                <h3>Your order is confirmed. Thank you for shopping with us.</h3>
                <hr>
                <p>
                    Click <a href="products.php">here</a> to purchase any other item.
                </p>
                <a href="my_orders.php" class="my-orders-btn">My Orders</a>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>

