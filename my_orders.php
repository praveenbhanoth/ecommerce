<?php
require("includes/common.php");

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all confirmed orders for this user
$query = "SELECT items.id, items.name, items.price, users_items.status
          FROM users_items 
          JOIN items ON users_items.item_id = items.id 
          WHERE users_items.user_id = '$user_id' AND users_items.status = 'Confirmed'";

$result = mysqli_query($con, $query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders | Life Style Store</title>
    <link rel="shortcut icon" href="img/srtcticon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        h2 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .table {
            margin-top: 20px;
            background: #fff;
        }
        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #337ab7;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-back:hover {
            background-color: #286090;
            color: white;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h2>🛒 My Orders</h2>

        <!-- Back Button -->
        <a href="products.php" class="btn-back">← Back to Products</a>

        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>#".$row['id']."</td>
                        <td>".$row['name']."</td>
                        <td>Rs ".$row['price']."</td>
                        <td>".$row['status']."</td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info text-center' style='margin-top:20px;'>
                    You have no confirmed orders yet.
                  </div>";
        }
        ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

