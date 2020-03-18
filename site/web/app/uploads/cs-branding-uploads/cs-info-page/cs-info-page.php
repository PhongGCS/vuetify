<?php
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'];
	$urlBase = "";
	$urlBase = $protocol.$domainName.'/app/uploads';
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=$pageTitle?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <link rel="stylesheet" href="<?= $urlBase ?>/cs-branding-uploads/cs-info-page/main.css">
  </head>
  <body>
    <main>
      <section class="secton section-maintenance" style="background-image: url(<?= $urlBase ?>/cs-branding-uploads/cs-info-page/filter.png);">
        <div class="maintenance-background"><img src="<?= $urlBase ?>/cs-branding-uploads/cs-info-page/background.png"></div>
        <div class="d-flex flex-column justify-content-center align-items-center h-100 px-5">
          <div class="row main-content-wrapper justify-content-center align-items-center">
          	<?php if (isset($customizedLogoURL) && $customizedLogoURL): ?>
          		<img class="main-logo" src="<?=$customizedLogoURL?>">
          	<?php else: ?>
	          	<a href="https://conceptual.studio"><img class="main-logo" src="<?= $urlBase ?>/cs-branding-uploads/cs-info-page/ic-logo.svg"></a>
          	<?php endif; ?>
	        
            <div class="main-content">
              <h1 class="maintenance-title"><?=$pageTitle?></h1>
              <p class="maintenance-subtitle"><?=$pageDescription?></p>
            </div>
          </div>
          <div class="row maintenance-footer justify-content-center">
            <p class="text-gray small"><?=date('Y')?> &copy; All rights reserved. Designed by Conceptual Studio.</p>
          </div>
        </div>
      </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="<?= $urlBase ?>/cs-branding-uploads/cs-info-page/main.js"></script>
  </body>
</html>