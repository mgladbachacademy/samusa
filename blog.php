<?php 
  $menu='blog';
  $site_title='default';
  require ('template/inc/base.php')
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
  
  
  
  
<section class="section-default section-cover section-cover-small content-center">
  <picture class="section-bg img-frame">
    <source media="(min-width:1280px)" data-srcset="template/img/cover-about-desktop-big.jpg">
    <source media="(min-width:640px)" data-srcset="template/img/cover-about-desktop.jpg">
    <source media="(min-width:414px)" data-srcset="template/img/cover-about-mobile.jpg">
    <img alt="Cover Home" class="lazyload" data-original="template/img/cover-about-mobile-small.jpg"/>
  </picture>
  <div class="section-overlay"></div>
  <div class="section-gradient"></div>
  <div class="section-container">
    <div class="cover-box">
      <h2 class="text-title cover-title">Recent Articles</h2>
    </div>
  </div>
</section>
  
  
  
  
  
<section class="section-default section-tipeB content-center">
  <div class="section-container">

    <?php 
      $services_array = array();
      $services_array[]=array(
        'services_image'=>'1',
        'services_title'=>'Law Firm Services',
        'services_desc'=>'
          <p>Comprehensive legal consultation and representation & expertise in various legal fields to protect your interests :</p>
        ',
      );
      foreach($services_array as $services_list){
    ?>
    <?php for ($i=1; $i<=6; $i++){ ?>
      <div class="tipeB-box">
        <div class="tipeB-img">
          <picture class="tipeB-img-frame img-frame thumb-loading">
            <img alt="<?php echo($services_list['services_title'])?>" class="lazyload" data-original="template/img/services-<?php echo($services_list['services_image'])?>.jpg"/>
          </picture>
        </div>
        <div class="tipeB-content">
          <h2 class="text-title tipeB-title"><?php echo($services_list['services_title'])?></h2>
          <?php echo($services_list['services_desc'])?>
        </div>
      </div>
    <?php } ?>
    <?php } ?>

  </div>
</section>





<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>