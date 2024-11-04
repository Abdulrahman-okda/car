<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="../admin/dashboard">Home</a>
         <a href="../admin/products">Products</a>
         <a href="../admin/placed_orders">Orders</a>
         <a href="../admin/admin_accounts">Admins</a>
         <a href="../admin/users_accounts">Users</a>
         <a href="../admin/messages">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile" class="btn">Update Profile</a>
         <div class="flex-btn">
            <a href="../admin/register_admin" class="option-btn">Register</a>
            <a href="../admin/admin_login" class="option-btn">Login</a>
         </div>
         <a href="../components/admin_logout" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
      </div>

   </section>

</header>