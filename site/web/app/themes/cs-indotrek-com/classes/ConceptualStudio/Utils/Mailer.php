<?php

namespace ConceptualStudio\Utils;


/**
 * Class Mailer
 *
 * An utility that provides Mailing support to replace the wp_mail().
 *
 * @package ConceptualStudio\Utils
 */
class Mailer {
    private static $initialized = false;
    private static $themeSettings = null;

    public static function init() {
        if (!self::$initialized) {
            // retrieve the ThemeSettings first
            $context = \Stem\Core\Context::current();
            self::$themeSettings = new \ConceptualStudio\Models\Core\ThemeSettings($context, null);

            self::$initialized = true; 
        }
    }

    public static function send($to, $cc, $bcc, $subject, $body, $attachments, $isHtml = true) {
        self::init();

        try {
            if (isset(self::$themeSettings->mailing->mailer)) {
                $envelope = new \ByJG\Mail\Envelope();
                $envelope->isHtml($isHtml);

                // Add To Recipients
                if (is_array($to)) {
                    foreach($to as $email)
                        $envelope->addTo($email);
                } elseif ($to) 
                    $envelope->addTo($to);
                
                // Add CC Recipients
                if (is_array($cc)) {
                    foreach($cc as $email)
                        $envelope->addCC($email);
                } elseif ($bcc)
                    $envelope->addCC($cc);
        
                // Add BCC Recipients
                if (is_array($bcc)) {
                    foreach($bcc as $email)
                        $envelope->addBCC($email);
                } elseif ($cc)
                    $envelope->addCC($cc);

                // Add Attachments
                if (is_array($attachments)) {
                    foreach($attachments as $attachment) {
                        $mime = mime_content_type($attachment);
                        $name = basename($attachment);
                        $envelope->addAttachment($name, $attachment, $mime);
                    }
                } 
                
                $envelope->setSubject($subject);
                $envelope->setBody($body);
                $envelope->setFrom(self::$themeSettings->mailing->senderEmail, self::$themeSettings->mailing->senderName);

                try {
                    self::$themeSettings->mailing->mailer->send($envelope);
                }
                catch (\Aws\Exception\AwsException $e) {
                    vomit("There was a problem sending the email. Message: ".$e->getAwsErrorMessage());
                }
                catch (InvalidArgumentException $e)
                {
                    vomit("There was a problem sending the email. Message: ".$e->getMessage());
                }
                catch (\PHPMailer\PHPMailer\Exception $e)
                {
                    //vomit("There was a problem sending the email. Message: ".$e->getMessage());
                    return False;
                }
                
                return True;
            } else 
                return False; 

        }
        catch (Exception $e)  {
            return False;
        }
   }



}