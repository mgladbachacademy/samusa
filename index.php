<?php 
  $menu='home';
  require ('template/inc/base.php')
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
  
  
  
  
<section class="section-default section-cover section-cover-home content-center">
  <picture class="section-bg img-frame">
    <source media="(min-width:1280px)" data-srcset="template/img/cover-home-desktop-big.jpg">
    <source media="(min-width:640px)" data-srcset="template/img/cover-home-desktop.jpg">
    <source media="(min-width:415px)" data-srcset="template/img/cover-home-mobile.jpg">
    <img alt="Cover Home" class="lazyload" data-original="template/img/cover-home-mobile-small.jpg"/>
  </picture>
  <div class="section-overlay"></div>
  <div class="section-gradient"></div>
  <div class="section-container">
    <div class="cover-box">
      <div class="text-title cover-intro">SAMUSA Consultant</div>
      <h2 class="text-title cover-title">Best guidance that drives your success</h2>
      <h3 class="text-title cover-subtitle">Trusted Partner in Professional Consultation</h3>
      <div class="cover-action">
        <a title="Request Free Consultation" class="btn btn-outline cover-button" href="contact/">Request Free Consultation</a>
      </div>
    </div>
  </div>
</section>
  
  
  
  
  
<section class="section-default section-maintag content-center">
  <div class="section-container">
    <div class="maintag-container">
      <?php 
        $maintag_array = array();
        $maintag_array[]=array(
          'maintag_content'=>'Appointment',
        );
        $maintag_array[]=array(
          'maintag_content'=>'Consultation',
        );
        $maintag_array[]=array(
          'maintag_content'=>'Available Online',
        );
        foreach($maintag_array as $maintag_list){
      ?>
        <div class="text-title maintag-box content-center"><?php echo($maintag_list['maintag_content'])?></div>
      <?php } ?>
    </div>
  </div>
</section>
  
  
  
  
  
<section class="section-default section-tipeA content-center">
  <div class="section-container">
    <div class="tipeA-img">
      <picture class="tipeA-img-frame img-frame thumb-loading">
        <img alt="Meet SAMUSA Consultant" class="lazyload" data-original="template/img/meet-samusa-consultant.jpg"/>
      </picture>
    </div>
    <div class="tipeA-content">
      <div class="tipeA-header">
        <h2 class="text-title tipeA-title">Meet SAMUSA Consultant</h2>
      </div>
      <div class="tipeA-info">
        <p>Established in Indonesia, SAMUSA Consultant provides advisory services for organizations in various sectors. This includes law firm services, legal consultancy, corporate establishment, corporate management, investment, tax, human resource, financial planning, licensing services, immigration, visa and foreign stay services, and land purchase.</p>
        <p>SAMUSA Consultant’s advisory services are segmented based on the operation’s size and maturity. Entities that require insight and consultant expertise or wish to enter a new industry or introduce a new product or service can benefit from SAMUSA Consultant.</p>
        <div class="tipeA-action">
          <a title="Learn More" class="btn" href="services/">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</section>
  
  
  
  
<section class="section-default section-partner content-center">
  <div class="section-container">

    <div class="partner-content">
      <div class="section-title">
        <h2 class="text-title section-title-primary">Our Customers</h2>
      </div>
      <div class="partner-list">
        <?php 
          $partner_array = array();
          $partner_array[]=array(
            'partner_image'=>'gfi.svg',
            'partner_label'=>'Grassroots Football Indonesia Foundation',
            'partner_link'=>'https://gfifoundation.org/',
          );
          $partner_array[]=array(
            'partner_image'=>'sagiwa.png',
            'partner_label'=>'Ruang Sadar Sagiwa',
            'partner_link'=>'',
          );
          $partner_array[]=array(
            'partner_image'=>'partner-german.png',
            'partner_label'=>'German Football Indonesia',
            'partner_link'=>'https://mgladbachacademy.id/',
          );
          foreach($partner_array as $partner_list){
        ?>
          <a title="<?php echo($partner_list['partner_label'])?>" class="partner-box" href="<?php echo($partner_list['partner_link'])?>" target="_blank">
            <picture class="partner-img-frame img-frame thumb-loading">
              <img alt="<?php echo($partner_list['partner_label'])?>" class="lazyload" data-original="template/img/partner-<?php echo($partner_list['partner_image'])?>"/>
            </picture>
          </a>
        <?php } ?>
      </div>
    </div>

  </div>
</section>





</div>
<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>