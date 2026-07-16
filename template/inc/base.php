<!DOCTYPE html>
<html lang="en">
<base href="/" />
<?php 
  $_SERVER['SMS'] = $_SERVER['DOCUMENT_ROOT'] . '/';  
  $sitename = 'Samusa Global Consultant';
  $sitename_full = 'PT. Samusa Global Consultant';
  $sitedesc = 'SAMUSA Consultant Best guidance that drives your success Trusted Partner in Professional Consultation Request Free Consultation Appointment Consultation Available Online Meet SAMUSA Consultant Established in Indonesia, SAMUSA Consultant provides advisory services for organizations in various sectors. This includes law firm services, legal consultancy, corporate establishment, corporate management, investment, tax, human resource, financial planning, and licensing services.';
  $anticache = date ('s'.'i'.'H'.'d'.'m'.'Y');

  $mainmenu_array = array();
  $mainmenu_array[]=array(
    'mainmenu_icon'=>'home',
    'mainmenu_link'=>'',
  );
  $mainmenu_array[]=array(
    'mainmenu_icon'=>'about',
    'mainmenu_link'=>'about',
  );
  $mainmenu_array[]=array(
    'mainmenu_icon'=>'services',
    'mainmenu_link'=>'services',
  );
  $mainmenu_array[]=array(
    'mainmenu_icon'=>'blog',
    'mainmenu_link'=>'blog',
  );
  $mainmenu_array[]=array(
    'mainmenu_icon'=>'contact',
    'mainmenu_link'=>'contact',
  );
?>
