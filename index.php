<?php

include 'components/connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
   <meta name="description" content="المحلاوي للسيارات المعاقين أكبر سوق للسيارت المجهزة طبيا يمكنك أيضا استيراد افضل السيارت من كوريا من موقعنا">
   <meta name="keywords" content="سيارات, اكبر سوق سيارات معاقين, المحلاوي">
   <meta name="author" content="Abd-Alrahman Okda">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>المحلاوي</title>
   <link rel="shortcut icon"
    href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWtyoKr8-EgU3I8xH4GlEJiPOqPszxHJLWcw&s"
    type="image/x-icon">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- swiper -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/kia.jpeg" alt="سيارات معاقين">
         </div>
         <div class="content">
            <span>اكبر سوق للسيارات المعاقين المجهزه طبيا</span>
            <h3>المحلاوي للسيارات المجهزة طبيا</h3>
            <a href="shop" class="btn">أطلب الأن </a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/0306_Hyundai_Tucson_1.jpg" alt="Tucson">
         </div>
         <div class="content">
            <span>Hyundai Tucson</span>
            <h3>Latest Tucson</h3>
            <a href="category?category=Tucson" class="btn">Shop Now.</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/sportage.jpg" alt="Sportage">
         </div>
         <div class="content">
            <span>Kia Sportage</span>
            <h3>Latest Sportage</h3>
            <a href="category?category=Sportage" class="btn">Shop Now.</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Flag_of_South_Korea.svg/1200px-Flag_of_South_Korea.svg.png" alt="Korea Flag">
         </div>
         <div class="content">
            <span>Korea car</span>
            <h3>متاح للتعاقد في كوريا</h3>
            <a href="category?category=تعاقد" class="btn">استيراد بنفسك</a>
         </div>
      </div>
   </div>
      <div class="swiper-pagination home-pagination"></div>
   </div>
</section>
</div>

<section class="category">

   <h1 class="heading">التسوق حسب الفئة</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category?category=Hyundai" class="swiper-slide slide">
      <img src="images/R.png" alt="Hyundai">
      <h3>Hyundai</h3>
   </a>

   <a href="category?category=Kia" class="swiper-slide slide">
      <img src="images/kia.jpeg" alt="Kia">
      <h3>Kia</h3>
   </a>

   <a href="category?category=Sportage" class="swiper-slide slide">
      <img src="images/989.webp" alt="Sportage">
      <h3>Sportage</h3>
   </a>

   <a href="category?category=Tucson" class="swiper-slide slide">
      <img src="images/images (2).jpeg" alt="Tucson">
      <h3>Tucson</h3>
   </a>

   <a href="category?category=Ad" class="swiper-slide slide">
      <img src="images/ad.jpeg" alt="Ad">
      <h3>Hyundai Ad</h3>
   </a>

   <a href="category?category=تعاقد" class="swiper-slide slide">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Flag_of_South_Korea.svg/1200px-Flag_of_South_Korea.svg.png" alt="استيراد بنفسك">
      <h3>استيراد بنفسك</h3>
   </a>

   </div>

   <div class="swiper-pagination category-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading"> أحدث المنتجات</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
        while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="<?= $fetch_product['name']; ?>">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>Price: </span><?= $fetch_product['price']; ?><span></span></div>
         <input type="number" name="qty" class="qty" min="1" max="1" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="إضافه الي السله" class="btn" name="add_to_cart">
   </form>
   <?php
        }
     }else{
        echo '<p class="empty">no products added yet!</p>';
     }
   ?>

   </div>

   <div class="swiper-pagination products-pagination"></div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

// Home slider
var homeSwiper = new Swiper(".home-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".home-pagination",
      clickable: true,
   },
});

// Category slider
var categorySwiper = new Swiper(".category-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".category-pagination",
      clickable: true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
      },
      650: {
         slidesPerView: 3,
      },
      768: {
         slidesPerView: 4,
      },
      1024: {
         slidesPerView: 5,
      },
   },
});

// Products slider
var productsSwiper = new Swiper(".products-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".products-pagination",
      clickable: true,
   },
   breakpoints: {
      550: {
         slidesPerView: 2,
      },
      768: {
         slidesPerView: 2,
      },
      1024: {
         slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>
