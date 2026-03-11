<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['item'])) {

    $item = $_POST['item'];

    if (!in_array($item, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $item;
    }
}

$count = count($_SESSION['cart']);
?>

<h2>Cart: <?php echo $count; ?> items</h2>

<h3>Products</h3>

<form method="POST">
    Laptop
    <button type="submit" name="item" value="Laptop">
        Add to Cart
    </button>
</form>

<form method="POST">
    Phone
    <button type="submit" name="item" value="Phone">
        Add to Cart
    </button>
</form>

<form method="POST">
    Tablet
    <button type="submit" name="item" value="Tablet">
        Add to Cart
    </button>
</form>