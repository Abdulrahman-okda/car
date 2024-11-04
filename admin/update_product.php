<?php

include '../components/connect.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
   header('location: admin_login');
   exit(); // توقف التنفيذ بعد إعادة التوجيه
}

$admin_id = $_SESSION['admin_id'];

if (isset($_POST['update'])) {
   // التحقق من وجود البيانات المطلوبة
   if (!isset($_POST['pid'], $_POST['name'], $_POST['price'], $_POST['details'])) {
      $message[] = 'Missing required data!';
   } else {
      // تنظيف البيانات المدخلة
      $pid = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT);
      $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
      $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
      $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);

      // تحديث المنتج
      $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, details = ? WHERE id = ?");
      if ($update_product->execute([$name, $price, $details, $pid])) {
         $message[] = 'Product updated successfully!';
      } else {
         $message[] = 'Failed to update product!';
      }

      // رسالة الخطأ لحجم الصورة
      function imageSizeError($imageSize)
      {
         $message[] = "Image size ($imageSize) is too large!";
      }

      // تحديث الصور
      function updateImage($conn, $pid, $imageField, $oldImage)
      {
         $image = $_FILES[$imageField]['name'];
         if (!empty($image)) {
            $image_size = $_FILES[$imageField]['size'];
            if ($image_size > 2000000) {
               imageSizeError($image_size);
            } else {
               $image = filter_var($image, FILTER_SANITIZE_STRING);
               $image_tmp_name = $_FILES[$imageField]['tmp_name'];
               $image_folder = '../uploaded_img/' . $image;
               $update_image = $conn->prepare("UPDATE `products` SET $imageField = ? WHERE id = ?");
               if ($update_image->execute([$image, $pid])) {
                  move_uploaded_file($image_tmp_name, $image_folder);
                  unlink('../uploaded_img/' . $oldImage);
                  $message[] = "Image $imageField updated successfully!";
               } else {
                  $message[] = "Failed to update $imageField!";
               }
            }
         }
      }

      // تحديث الصور
      updateImage($conn, $pid, 'image_01', $_POST['old_image_01']);
      updateImage($conn, $pid, 'image_02', $_POST['old_image_02']);
      updateImage($conn, $pid, 'image_03', $_POST['old_image_03']);
      // إضافة تحديث الصور من 04 إلى 07
      updateImage($conn, $pid, 'image_04', $_POST['old_image_04']);
      updateImage($conn, $pid, 'image_05', $_POST['old_image_05']);
      updateImage($conn, $pid, 'image_06', $_POST['old_image_06']);
      updateImage($conn, $pid, 'image_07', $_POST['old_image_07']);
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include '../components/admin_header.php'; ?>
<section class="update-product">
   <h1 class="heading">Update Product</h1>
   <?php
   $update_id = $_GET['update'] ?? null; // تحديد قيمة افتراضية لتجنب الأخطاء
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $select_products->execute([$update_id]);
   if ($select_products->rowCount() > 0) {
      while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
   ?>
         <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
            <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
            <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">
            <!-- إضافة حقول مخفية للصور من 04 إلى 07 -->
            <input type="hidden" name="old_image_04" value="<?= $fetch_products['image_04']; ?>">
            <input type="hidden" name="old_image_05" value="<?= $fetch_products['image_05']; ?>">
            <input type="hidden" name="old_image_06" value="<?= $fetch_products['image_06']; ?>">
            <input type="hidden" name="old_image_07" value="<?= $fetch_products['image_07']; ?>">
            <div class="image-container">
               <div class="main-image">
                  <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
               </div>
               <div class="sub-image">
                  <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                  <img src="../uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
                  <img src="../uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">
                  <img src="../uploaded_img/<?= $fetch_products['image_04']; ?>" alt="">
                  <img src="../uploaded_img/<?= $fetch_products['image_05']; ?>" alt="">
                  <img src="../uploaded_img/<?= $fetch_products['image_06']; ?>" alt="">
                  <img src="../uploaded_img/<?= $fetch_products['image_07']; ?>" alt="">
               </div>
            </div>
            <span>Update Name</span>
            <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['name']; ?>">
            <span>Update Price</span>
            <input type="number" name="price" class="box" min="0" placeholder="enter product price" onkeypress="if(this.value.length == 12) return false;" value="<?= $fetch_products['price']; ?>">
            <span>Update Details</span>
            <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
            <span>Update image 01</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            <span>Update image 02</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            <span>Update image 03</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            <!-- إضافة حقول تحديث الصور من 04 إلى 07 -->
            <span>Update image 04</span>
            <input type="file" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            <span>Update image 05</span>
            <input type="file" name="image_05" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            <span>Update image 06</span>
            <input type="file" name="image_06" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            <span>Update image 07</span>
            <input type="file" name="image_07" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            <div class="flex-btn">
               <input type="submit" name="update" class="btn" value="update">
               <a href="products" class="option-btn">Go Back.</a>
            </div>
         </form>
   <?php
      }
   } else {
      echo '<p class="empty">no product found!</p>';
   }
   ?>
</section>
<script src="../js/admin_script.js"></script>
</body>
</html>
