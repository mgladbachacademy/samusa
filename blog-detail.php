<?php 
  $menu='blog-detail';
  require ('template/inc/base.php')
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
  
  
  
  
<section class="section-default section-detail-article content-center">
  <div class="section-container">

    <div class="sda-top">
      <h1 class="text-title sda-title">Understanding The Establishment of PT PMA in Indonesia</h1>
      <h2 class="sda-date">00 September 0000 - 00:00</h2>
      <!--
      <h3 class="sda-author">Samusa Global Consultant</h3>
      -->
    </div>

    <picture class="sda-img img-frame thumb-loading">
      <source media="(min-width:1280px)" data-srcset="template/img/cover-home-desktop-big.jpg">
      <source media="(min-width:640px)" data-srcset="template/img/cover-home-desktop.jpg">
      <source media="(min-width:414px)" data-srcset="template/img/cover-home-mobile.jpg">
      <img alt="Understanding The Establishment of PT PMA in Indonesia" class="lazyload" data-original="template/img/cover-home-mobile-small.jpg"/>
    </picture>

    <main class="sda-content">
      <?php require ($_SERVER['SMS'].'template/module/default-content.php')?>
    </main>

  </div>
</section>
  
  
  
  
  

<section class="section-default section-related-article content-center">
  <div class="section-container">

    <div class="related-article-content">
      <div class="section-title">
        <h2 class="text-title section-title-primary">Related Article</h2>
      </div>
      <div class="section-tipeB content-center">
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
          <?php for ($i=1; $i<=3; $i++){ ?>
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
      </div>
    </div>

  </div>
</section>





<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>