<?php 
  $menu='login';
  require ('template/inc/base.php')
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
  
  
  
  
<section class="section-default section-login content-center">
  <div class="section-container">

    <ul class="section-login-box">
      <li class="slb-row">
        <div class="slb-label">Username</div>
        <div class="form-box slb-box">
          <input class="form-field" type="text" name="" required placeholder="Username">
        </div>
      </li>
      <li class="slb-row">
        <div class="slb-label">Password</div>
        <div class="form-box form-password slb-box">
          <input class="form-field" type="password" name="password" required placeholder="0123456789">
          <span title="Show/Hide Password" class="form-icon hide-password content-center">
            <?php require ($_SERVER['SMS'].'template/img/icon/pass-hide.svg')?>
            <?php require ($_SERVER['SMS'].'template/img/icon/pass-show.svg')?>
          </span>
        </div>
      </li>
      <li class="slb-row">
        <button class="btn slb-button">Login</button>
      </li>
    </ul>

  </div>
</section>





</div>
<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>