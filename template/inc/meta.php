<head>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-V8GY96GR6J"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-V8GY96GR6J');
</script>

<meta charset="utf-8">
<meta name="robots" content="index, follow">	
<meta name="googlebot" content="all"/>
<meta name="googlebot-news" content="index,follow"/>
<meta name="googlebot-image" content="index,follow"/>
<meta content="<?php echo $sitename; ?>" name="author"/>
<meta content="en" name="language"/>
<meta content="us" name="geo.country"/>
<meta content="United States" name="geo.placename"/>
<meta http-equiv="content-language" content="en-US"/>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="true" />
<meta name="apple-touch-fullscreen" content="yes" />

<title><?php echo $sitename_full; ?></title>
<meta name="description" content="<?php echo $sitedesc; ?>">
<meta name="copyright" content="2023 | <?php echo $sitename; ?>">
<meta name="keywords" content="<?php echo $sitename_full; ?>"/>
<meta name="news_keywords" content="<?php echo $sitename_full; ?>"/>
<meta name="author" content="<?php echo $sitename; ?>"/>
<meta name="copyright" content="2023 <?php echo $sitename; ?>"/>

<meta property="fb:app_id" content=""/>
<meta property="og:type" content="article"/>
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1920">
<meta property="og:image:height" content="1080">
  
<meta property="og:url" content="https://samusaconsultant.id/"/>
<meta property="og:title" content="<?php echo $sitename_full; ?>"/>
<meta property="og:image" content="https://samusaconsultant.id/template/img/cover.jpg"/>
<meta property="og:description" content="<?php echo $sitedesc; ?>"/>
<meta property="og:image:alt" content="<?php echo $sitename_full; ?>. <?php echo $sitedesc; ?>"/>

<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:image:src" content="https://samusaconsultant.id/template/img/cover.jpg"/>
<meta name="twitter:description" content="<?php echo $sitedesc; ?>"/>

<link rel="preconnect" href="https://samusaconsultant.id/">
<link rel="dns-prefetch" href="https://samusaconsultant.id/">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
<link rel="preconnect" href="https://www.googletagmanager.com">
<link rel="dns-prefetch" href="https://www.googletagmanager.com">
<link rel="canonical" href="https://gfifoundation.org/" />
<link href="template/img/favicon.ico?<?php echo $anticache; ?>" rel="icon" type="image/ico" />

<?php
  $font_dir = $_SERVER['SMS'] . 'template/fonts/';
  if (is_dir($font_dir)) {
      $fonts = glob($font_dir . '*.woff2');
      if ($fonts) {
          foreach ($fonts as $font_path) {
              $font_name = basename($font_path);
              echo '<link rel="preload" href="template/fonts/' . htmlspecialchars($font_name) . '" as="font" type="font/woff2" crossorigin>' . "\n";
          }
      }
  }
?>
<link rel="preload" href="template/css/rancak.css?<?php echo $anticache; ?>" as="style">
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" as="script">
<link rel="preload" href="template/js/lazysizes.min.js" as="script">

<style><?php require ($_SERVER['SMS'].'template/css/font.css')?></style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="template/js/jquery.js"><\/script>');</script>
<script async>
$("body,html").bind("touchstart touchmove scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
  $("script").each(function(){
    var get_script = $(this).attr("rancak-hold");
    $(this).attr('src', get_script);
  })
});
</script>

<link rel="stylesheet" type="text/css" href="template/css/rancak.css?<?php echo $anticache; ?>"/>
<link rel="stylesheet" type="text/css" href="template/css/rancak-desktop.css?<?php echo $anticache; ?>" media="(min-width:1024px)">

<?php if($menu == 'login' || $menu == 'admin') { ?>
  <link rel="preload" href="template/css/admin.css?<?php echo $anticache; ?>" as="style">
  <link rel="stylesheet" type="text/css" href="template/css/admin.css?<?php echo $anticache; ?>"/>
<?php } ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Business",
  "name": "Samusa Global Consultant",
  "url": "https://samusaconsultant.id/",
  "logo": "https://samusaconsultant.id/template/img/favicon.ico",
  "image": "https://samusaconsultant.id/template/img/cover.jpg",
  "description": "Foreign investors interested in establishing a Foreign Investment Company (PT PMA) in Indonesia need to be aware and understand relevant aspects of PT PMA. Therefore, this article will explain what needs to be considered and the benefits of establishing a PT PMA. Things to Consider When Establishing a PT PMA Identify The Company's Business Sector Before.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Prosperity Tower, 8th Floor",
    "addressLocality": "South Jakarta",
    "addressRegion": "Jakarta",
    "postalCode": "12190",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+62-811-9003-405",
    "contactType": "customer service"
  }
}
</script>
</head>
<body>
<?php if($menu == 'blog-detail') { ?>
  <h1 class="hide"><?php echo $sitename; ?> - <?php echo $menu; ?></h1>
<?php } ?>