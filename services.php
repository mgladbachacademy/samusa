<?php 
  $menu='services';
  require ('template/inc/base.php')
?>
<?php require ($_SERVER['SMS'].'template/inc/meta.php')?>
<?php require ($_SERVER['SMS'].'template/inc/header.php')?>
<div class="rancak-foundation">
  
  
  
  
  
<section class="section-default section-cover section-cover-small content-center">
  <picture class="section-bg img-frame">
    <source media="(min-width:1280px)" data-srcset="template/img/cover-services-desktop-big.jpg">
    <source media="(min-width:640px)" data-srcset="template/img/cover-services-desktop.jpg">
    <source media="(min-width:415px)" data-srcset="template/img/cover-services-mobile.jpg">
    <img alt="Cover Home" class="lazyload" data-original="template/img/cover-services-mobile-small.jpg"/>
  </picture>
  <div class="section-overlay"></div>
  <div class="section-gradient"></div>
  <div class="section-container">
    <div class="cover-box">
      <h2 class="text-title cover-title">Our Services</h2>
      <h3 class="text-title cover-subtitle">Delivering Excellence on building quality into every stage of our work, providing clear communication, reliable guidance, and meticulous attention to detail from the first inquiry to project completion.</h3>
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
          <ul>
            <li>Comprehensive legal consultation and strong representation in litigation and non litigation matters.</li>
            <li>Expertise in corporate, commercial, civil, and criminal law to protect your personal and business interests.</li>
            <li>Drafting, reviewing, and negotiating contracts to ensure compliance and reduce risk.</li>
            <li>Legal due diligence for mergers, acquisitions, and corporate transactions.</li>
            <li>Intellectual property protection, including trademarks, copyrights, and patents.</li>
            <li>Employment and labor law advisory to safeguard employer–employee relationships.</li>
            <li>Regulatory compliance support to help you navigate government requirements and industry standards.</li>
            <li>Dispute resolution and mediation services aimed at achieving efficient, cost effective outcomes.</li>
            <li>Dedicated legal strategy development tailored to your business goals and long term needs.</li>
          </ul>
        ',
      );
      $services_array[]=array(
        'services_image'=>'2',
        'services_title'=>'Visa & Foreign Stay',
        'services_desc'=>'
          <p>Comprehensive support for all your immigration and visa needs & guidance on residency and foreign stay regulations.</p>
          <ul>
            <li>Comprehensive support for all immigration and visa applications, renewals, and compliance.</li>
            <li>Guidance on residency requirements, foreign stay regulations, and long term stay planning.</li>
            <li>Assistance in obtaining work permits, KITAS, KITAP, business visas, investor visas, and dependent visas.</li>
            <li>Advisory on foreign investment regulations for expatriates establishing businesses in Indonesia.</li>
            <li>Coordination with government agencies for smooth processing and timely approvals.</li>
            <li>Personalized immigration planning for individuals, families, and corporate expatriates.</li>
            <li>Solutions to ensure lawful stay, seamless relocation, and long term settlement.</li>
          </ul>
        ',
      );
      $services_array[]=array(
        'services_image'=>'3',
        'services_title'=>'Tax & Financial Planning',
        'services_desc'=>'
          <p>Effective tax planning to maximize your financial efficiency & compliance with local and international tax regulations.</p>
          <ul>
            <li>Effective tax planning to maximize financial efficiency and reduce liabilities.</li>
            <li>Compliance with local and international tax regulations for individuals and businesses.</li>
            <li>Preparation, review, and filing of tax reports and documentation.</li>
            <li>Advisory on corporate tax strategies, transfer pricing, and cross border taxation.</li>
            <li>Financial planning and structuring to support long term stability and growth.</li>
            <li>Support for tax audits, objections, and dispute resolution with authorities.</li>
            <li>Guidance on investment planning, asset protection, and wealth management strategies.</li>
          </ul>
        ',
      );
      $services_array[]=array(
        'services_image'=>'4',
        'services_title'=>'Licensing Services',
        'services_desc'=>'
          <p>Assistance in obtaining necessary licenses for your business operations &We are trive to navigate regulatory requirements.</p>
          <ul>
            <li>Assistance in obtaining all necessary licenses and permits required for your business operations.</li>
            <li>Support for sector specific licensing, including commercial, industrial, retail, hospitality, and foreign investment permits.</li>
            <li>Guidance on regulatory requirements to ensure full compliance with local and national laws.</li>
            <li>Coordination with government institutions to streamline processes and reduce administrative delays.</li>
            <li>Advisory on maintaining and renewing ongoing licenses to keep your business operating smoothly.</li>
            <li>We strive to navigate regulatory complexities so you can focus on growing your business with confidence.</li>
          </ul>
        ',
      );
      $services_array[]=array(
        'services_image'=>'5',
        'services_title'=>'Corporate Establishment',
        'services_desc'=>'
          <p>Assistance in setting up your business efficiently & guidance through legal and administrative procedures.</p>
          <ul>
            <li>End to end corporate advisory for startups, SMEs, and large enterprises.</li>
            <li>Company establishment and business structuring (PT, PMA, foundations, etc.).</li>
            <li>Corporate governance guidance aligned with Indonesian regulations and best practices.</li>
            <li>Drafting and management of essential corporate documents (AOA, shareholder agreements, board resolutions, MoUs).</li>
            <li>Strategic support for mergers, acquisitions, joint ventures, and restructuring.</li>
            <li>Assistance with licensing, permits, and regulatory filings.</li>
            <li>Corporate secretarial services to ensure smooth, compliant operations.</li>
            <li>Risk assessment and mitigation tailored to your industry and organizational goals.</li>
            <li>Ongoing advisory for investor relations, capitalization, and long term corporate growth.</li>
          </ul>
        ',
      );
      $services_array[]=array(
        'services_image'=>'6',
        'services_title'=>'Project Advisory',
        'services_desc'=>'
          <p>Tailored investment strategies to grow and protect your wealth & expert advice on market trends and opportunities.</p>
          <ul>
            <li>Strategic guidance for project planning, development, and implementation.</li>
            <li>Feasibility studies to evaluate technical, financial, and operational viability.</li>
            <li>Market assessment and industry analysis to support informed decision making.</li>
            <li>Risk analysis and mitigation planning for both new and ongoing projects.</li>
            <li>Support in structuring project financing, partnerships, and investment opportunities.</li>
            <li>Coordination with stakeholders, consultants, and government entities throughout project lifecycles.</li>
            <li>Monitoring and evaluation to ensure projects remain aligned with goals, deadlines, and budget.</li>
            <li>Advisory services for infrastructure, construction, energy, and multi sector investment projects.</li>
          </ul>
        ',
      );
      foreach($services_array as $services_list){
    ?>
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

  </div>
</section>





</div>
<?php require ($_SERVER['SMS'].'template/inc/footer.php')?>
<?php require ($_SERVER['SMS'].'template/inc/base-bottom.php')?>