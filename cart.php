<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:user_login');
    exit;
}

if (isset($_POST['delete'])) {
    $cart_id = $_POST['cart_id'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$cart_id]);
}

if (isset($_GET['delete_all'])) {
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    header('location:cart');
    exit;
}

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $qty = filter_var($_POST['qty'], FILTER_VALIDATE_INT);
    if ($qty !== false && $qty > 0) {
        $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
        $update_qty->execute([$qty, $cart_id]);
        $message[] = 'Cart quantity updated';
    } else {
        $message[] = 'Invalid quantity';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="keywords" content="سيارات, اكبر سوق سيارات معاقين, المحلاوي">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
   
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products shopping-cart">

    <h3 class="heading">Shopping Cart</h3>

    <div class="box-container">

    <?php
    $grand_total = 0;
    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $select_cart->execute([$user_id]);
    if ($select_cart->rowCount() > 0) {
        while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);
    ?>
	
    <form action="" method="post" class="box">
        <input type="hidden" name="cart_id" value="<?= htmlspecialchars($fetch_cart['id']); ?>">
        <a href="quick_view?pid=<?= htmlspecialchars($fetch_cart['pid']); ?>" class="fas fa-eye"></a> <!-- تصحيح الرابط إلى معرف المنتج -->
        <img src="uploaded_img/<?= htmlspecialchars($fetch_cart['image']); ?>" alt="">
        <div class="name"><?= htmlspecialchars($fetch_cart['name']); ?></div>
        <div class="flex">
            <div class="price">Price: <?= number_format($fetch_cart['price'], 2); ?> </div>
            <input type="number" name="qty" class="qty" min="1" max="1" onkeypress="if(this.value.length == 2) return false;" value="<?= htmlspecialchars($fetch_cart['quantity']); ?>">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
        </div>
        <div class="sub-total"> المجموع : <span><?= number_format($sub_total, 2); ?> </span></div>
        <input type="submit" value=" حذف العنصر " onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
    </form>
    <?php
        $grand_total += $sub_total;
        }
    } else {
        echo '<p class="empty">your cart is empty</p>';
    }
    ?>
    </div>

    <div class="cart-total">
        <p>المجموع الكلي : <span><?= number_format($grand_total, 2); ?> </span></p>
        <a href="shop" class="option-btn">متابعة التسوق</a>
        <a href="cart?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">حذف كافه العناصر  </a>
        <a href="checkout" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">شراء السياره</a>
    </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
