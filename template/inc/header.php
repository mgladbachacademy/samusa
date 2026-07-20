<header class="content-center">
  <div class="section-container">
    <div class="header-left">
      <a title="Logo <?php echo $sitename; ?>" class="header-box header-logo content-center" href="../">
        <?php require ($_SERVER['SMS'].'template/img/logo.svg')?>
      </a>
    </div>
    <div class="header-right">
      <?php 
        foreach($mainmenu_array as $mainmenu_list){
      ?>
        <?php if($menu != 'login' && $menu != 'admin') { ?>
          <a title="<?php echo($mainmenu_list['mainmenu_icon'])?>" href="<?php echo($mainmenu_list['mainmenu_link'])?>" 
          class="header-box <?php if($menu == $mainmenu_list['mainmenu_icon']) { ?>header-curr<?php } ?> content-center">
            <div class="header-label"><?php echo($mainmenu_list['mainmenu_icon'])?></div>
          </a>
        <?php } ?>
      <?php } ?>
      <?php if($menu == 'admin') { ?>
        <a title="Logout" href="logout/" class="header-box content-center">
          <div class="header-label">Logout</div>
        </a>
      <?php } ?>
    </div>
  </div>
</header>