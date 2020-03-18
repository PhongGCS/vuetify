<?php
	// This scripts ovverided the default maintenance message and displays the Conceptual Under Maintenance Template
	// This file is valid only for the plugin / wordpress core maintenance maintenance
	$pageTitle = "Under Maintenance";
	$pageDescription = "We are currently tuning up this website, it should not take more than few minutes. Please come back a bit later. Thank you!";

	$filePath = getcwd()."/app/uploads/cs-branding-uploads/cs-info-page/cs-info-page.php";
	
	if ( file_exists($filePath) ) {
		include $filePath;
	} else {
		echo "<h1>".$pageTitle."</h1>";
		echo "<h2>".$pageDescription."</h2>";
	}
?>