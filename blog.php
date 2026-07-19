<?php 
  $menu='blog';
  require ('template/inc/base.php')
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
  
  
  
  
<section class="section-default section-cover section-cover-small content-center">
  <picture class="section-bg img-frame">
    <source media="(min-width:1280px)" data-srcset="template/img/cover-about-desktop-big.jpg">
    <source media="(min-width:640px)" data-srcset="template/img/cover-about-desktop.jpg">
    <source media="(min-width:415px)" data-srcset="template/img/cover-about-mobile.jpg">
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
      $blog_array = array();
      $blog_array[]=array(
        'blog_image'=>'1',
        'blog_title'=>'Law Firm Services',
        'blog_desc'=>'Comprehensive legal consultation and representation & expertise in various legal fields to protect your interests',
        'blog_link'=>'blog-detail.php',
      );
      foreach($blog_array as $blog_list){
    ?>
    <?php for ($i=1; $i<=6; $i++){ ?>
      <a title="<?php echo($blog_list['blog_title'])?>" class="tipeB-box article-box" href="<?php echo($blog_list['blog_link'])?>">
        <div class="tipeB-img">
          <picture class="tipeB-img-frame img-frame thumb-loading">
            <img alt="<?php echo($blog_list['blog_title'])?>" class="lazyload" data-original="template/img/services-<?php echo($blog_list['blog_image'])?>.jpg"/>
          </picture>
        </div>
        <div class="tipeB-content">
          <h2 class="text-title tipeB-title"><?php echo($blog_list['blog_title'])?></h2>
          <div class="tipeB-desc"><?php echo($blog_list['blog_desc'])?></div>
          <div class="tipeB-more">
            <span>Read More</span>
            <?php require ($_SERVER['SMS'].'template/img/icon/more.svg')?>
          </div>
        </div>
      </a>
    <?php } ?>
    <?php } ?>

  </div>
</section>





</div>
<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>