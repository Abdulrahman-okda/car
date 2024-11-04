<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="description" content="المحلاوي للسيارات المعاقين أكبر سوق للسيارت المجهزة طبيا يمكنك أيضا استيراد افضل السيارت من كوريا من موقعنا">
   <meta name="keywords" content="سيارات, اكبر سوق سيارات معاقين, المحلاوي">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>من نحن</title>
	<link rel="shortcut icon"
    href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWtyoKr8-EgU3I8xH4GlEJiPOqPszxHJLWcw&s"
    type="image/x-icon">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/23.png" alt="">
      </div>

      <div class="content">
         <h3><span>المحلاوي</span> للسيارت ذو الإحتياجات الخاصه</h3>
         <p>يمكنك الان مشاهده جميع أنواع السيارات ذو الهمم من موقعنا <a href="">المحلاوي</a></p>

         <p>.يمكن أيضا التعاقد معنا علي أي نوع سياره من كوريا حسب المواصفات التي تريدها من خلال موقعنا <a href="category?category=تعاقد" target="_blank"> متاح سيارات للتعاقد</a> او أرسال نوع السياره والموديل ومواصفتها عبر هذا الرابط </p>
         <a href="contact" class="btn">Contact Us</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">أسعار السيارات</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/989.webp" alt="">
         <h3> <a href="category?category=Sportage" target="_blank">Kia Sportage</a></h3>
         <p>Been using their services for quite a bit and have never had an issue with the quality of their products. Online e-products working great as well. Only issue I have is they usually deliver when I'm a little caught up, though I've set a preferred delivery time. Everything else has been good.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="swiper-slide slide">
         <img src="images/images (2).jpeg" alt="">
         <h3> <a href="category?category=Tucson" target="_blank">Hyundia Tucson</a></h3>
         <p>It is the first online services in Nepal which we can trust completely.I always unbox making a video and instantly complain if there's anything wrong. Sometimes even don't need to return the item and they process the refund. KinBech do heavy fine to sellers who send wrong products thats why its platform getting better day by day.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="swiper-slide slide">
         <img src="images/ad.jpeg" alt="">
         <h3> <a href="category?category=Ad" target="_blank">Hyundia Ad</a></h3>
         <p>KinBech is great if you choose good sellers . A variety of required item available . Customers can return and refund full amount within 7 days easily . KinBech is boosting eCommerce business in Kathmandu.It provides great opportunity to sale items online with ease.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>
   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>