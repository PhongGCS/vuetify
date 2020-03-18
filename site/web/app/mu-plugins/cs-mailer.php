<?php
/**
 * Plugin Name: CS Mailer
 * Plugin URI: 
 * Description: Overrides the default mailer and uses a custom one instead
 * Version: 1.0.0
 * Author: Conceptual Studio
 * Author URI: https://conceptual.studio/
 * License: Proprietary
 */

 // #### Override the default mail function to ensure all the emails are sent out the same way ####
function wp_mail( $to, $subject, $message, $headers = '', $attachments = '' ) {
	$bcc = array();
	$cc = array();

	if (is_array($headers)) {
		// extract CC and BCC from headers
		foreach ($headers as $line) {
			if (strpos($line, 'BCC:') !== false) {
				$bcc[] = trim(str_replace("BCC:", "", $line));
			} elseif (strpos($line, 'CC') !== false) {
				$cc[] = trim(str_replace("CC:", "", $line));
			}
		}
	}

    // send the email
    $result = ConceptualStudio\Utils\Mailer::send($to, $cc, $bcc, $subject, $message, $attachments, true);
    return $result;

}