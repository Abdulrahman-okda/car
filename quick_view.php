<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>المحلاوي</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .lightbox {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.8);
         justify-content: center;
         align-items: center;
         z-index: 1000;
      }

      .lightbox img {
         max-width: 90%;
         max-height: 90%;
      }

      .close {
         position: absolute;
         top: 20px;
         right: 20px;
         color: white;
         font-size: 30px;
         cursor: pointer;
      }
   </style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="heading">نظره سريعة</h1>

   <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img id="mainImage" src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" onclick="changeImage(this.src)">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" onclick="changeImage(this.src)">
               <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="" onclick="changeImage(this.src)">
               <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="" onclick="changeImage(this.src)">
               <img src="uploaded_img/<?= $fetch_product['image_04']; ?>" alt="" onclick="changeImage(this.src)">
               <img src="uploaded_img/<?= $fetch_product['image_05']; ?>" alt="" onclick="changeImage(this.src)">
               <img src="uploaded_img/<?= $fetch_product['image_06']; ?>" alt="" onclick="changeImage(this.src)">
               <img src="uploaded_img/<?= $fetch_product['image_07']; ?>" alt="" onclick="changeImage(this.src)">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>السعر</span><?= $fetch_product['price']; ?><span></span></div>
               <input type="number" name="qty" class="qty" min="1" max="1" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="details"><pre><?= $fetch_product['details']; ?></pre></div>
            <div class="flex-btn">
               <input type="submit" value="add to cart" class="btn" name="add_to_cart">
               <input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist">
            </div>
            <a href="shop" class="btn-box" >back</a>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

</section>

<!-- Lightbox for displaying full-size images -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
   <span class="close" onclick="closeLightbox()">X</span>
   <img id="lightboxImage" src="" alt="">
</div>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

<script>
function changeImage(src) {
   document.getElementById('lightboxImage').src = src;
   document.getElementById('lightbox').style.display = 'flex';
}

function closeLightbox() {
   document.getElementById('lightbox').style.display = 'none';
}
</script>

</body>
</html>
