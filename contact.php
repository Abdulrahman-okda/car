<?php
include 'components/connect.php';

session_start();

// Initialize $user_id to NULL
$user_id = null;

// Check if the user is logged in and the session variable is set
if (isset($_SESSION['user_id'])) {
    // Set $user_id to the session value
    $user_id = $_SESSION['user_id'];
}

include 'components/wishlist_cart.php';

if(isset($_POST['send'])){
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
   $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

   // Ensure that $user_id is not null before inserting the message
   if ($user_id !== null) {
      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'تم الارسال';
   } else {
      // Handle the case when $user_id is null (user not logged in)
      $message[] = 'تحتاج الي تسجيل الدخول الي حسابك لارسال رساله';
   }
}

$select_messages = $conn->prepare("SELECT * FROM `messages`");
$select_messages->execute();
$messages = $select_messages->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
	<meta name="description" content="المحلاوي للسيارات المعاقين أكبر سوق للسيارت المجهزة طبيا يمكنك أيضا استيراد افضل السيارت من كوريا من موقعنا">
   <meta name="keywords" content="  سيارات, إستيراد سياره, المحلاوي">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   
   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="contact">
   <form action="" method="post">
      <h3>تواصل معنا .</h3>
      <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="enter your email"  maxlength="30" class="box">
      <input type="number" name="number" min="20101111111" max="999999999999" placeholder="+20 enter your number" required onkeypress="if(this.value.length == 12) return false;" class="box">
      <textarea name="msg" class="box" required maxlength="40" placeholder="ما مواصفات السياره التي تحتاجها / اي إستفسار يمكنك ارساله إلينا" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>
</section>
<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
