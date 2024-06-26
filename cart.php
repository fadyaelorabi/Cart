<?php
// Start the session
session_start();

// Include your PHP connection file and functions here
include 'connection.php';
include 'phpFunctions.php';

// Get the user ID from the session
$userId = $_SESSION['userId'] ?? null;

// Fetch cart items for the user
$cartItems = [];
if ($userId) {
    $cartItems = getCartItems($conn, $userId);
}

// Calculate the total price of cart items
$totalPrice = calculateTotalPrice($cartItems);

// Check if the "Remove & Add to Products" button is clicked
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    removeFromCartAndAddToProducts($conn, $productId, $userId);
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/nindex.css">
</head>

<body>
    <section id="header">
        <a href="#"><img src="style/images/index/logo.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php" class="active">Shop</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="signin.html"><i class="fas fa-sign-in-alt"></i></a></li>
            </ul>
        </div>
    </section>
    <section id="page-header">
        <h1>CART</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing</p>
    </section>

    <section id="cart" class="section-p1">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $cartItem): ?>
                    <tr class="cart-item">
                        <td><?php echo $cartItem['productName']; ?></td>
                        <td><?php echo $cartItem['quantity']; ?></td>
                        <td>$<?php echo $cartItem['price']; ?></td>
                        <td>
                            <form method="post">
                        <button type="submit">Remove & Add to Products</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="cupon">
            <h3>Apply Coupon</h3>
        </div>
        <input type="text" placeholder="Enter your Coupon">
        <button>Apply</button>

        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart</td>
                    <td>$<?php echo $totalPrice; ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo $totalPrice; ?></strong></td>
                </tr>
            </table>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="style/nindex.js"></script>
</body>

</html>
