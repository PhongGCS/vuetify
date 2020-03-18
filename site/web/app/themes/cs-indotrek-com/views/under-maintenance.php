<?php
  $maintenanceMode = get_field('maintenance_mode', 'option');
	$pageTitle = $maintenanceMode['title'];
	$pageDescription = $maintenanceMode['subtitle'];

  if ($maintenanceMode['logo']) {
    $customizedLogoURL = wp_get_attachment_image_url($maintenanceMode['logo'], 'medium');

  }
  else {
    $customizedLogoURL = "";
  }

  $filePath = wp_upload_dir()['basedir']."/cs-branding-uploads/cs-info-page/cs-info-page.php";


  if ( file_exists($filePath) ) {
  	include $filePath;
	} else {
		echo "<h1>".$pageTitle."</h1>";
		echo "<h2>".$pageDescription."</h2>";
	}

?>
