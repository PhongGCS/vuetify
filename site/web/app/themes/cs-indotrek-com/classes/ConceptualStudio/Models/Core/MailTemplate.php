<?php
namespace ConceptualStudio\Models\Core;

use Stem\Core\Context;
use Stem\Models\Post;
use ConceptualStudio\Traits\Content\HasThemeSettings;

class MailTemplate extends Post {
    use HasThemeSettings;


    public $subject = null;
    public $type = null;
    public $to = [];
    public $bcc = [];
    public $bodyText = null;
    public $bodyHTML = null;

    public function __construct(Context $context, \WP_Post $post){
        parent::__construct($context, $post);

        // get Theme Options
        $this->buildThemeSettings($context);

        // create the mailer

        $this->subject = get_field('subject', $this->id);
        $this->type = get_field('type', $this->id);
        $this->bodyText = get_field('body_text', $this->id);
        $this->bodyHTML = get_field('body_html', $this->id);

        $toList = get_field('to_emails', $this->id);
        if ($toList && is_array($toList) && (count($toList)>0))
        {
            foreach($toList as $emailItem)
                $this->to[] = $emailItem['email'];
        }

        $bccList = get_field('bcc_emails', $this->id);
        if ($bccList && is_array($bccList)) {
            foreach($bccList as $emailItem)
                $this->bcc[] = $emailItem['email'];
        }
    }

    public function send($email=null, $data=[]) {
        if (isset($this->themeSettings->mailing->mailer)) {
            // use one of the selected mailers
            $envelope = new \ByJG\Mail\Envelope();

            // Add To Recipients
            if ($email != null)
                $envelope->addTo($email);
            if (count($this->to) > 0) {
                foreach($this->to as $toEmail)
                    $envelope->addTo($toEmail);
            }

            // Add BCC Recipients
            if (count($this->bcc) > 0) {
                foreach($this->bcc as $toEmail)
                    $envelope->addBCC($toEmail);
            }

            $envelope->setFrom($this->themeSettings->mailing->senderEmail, $this->themeSettings->mailing->senderName);
            $envelope->setSubject($this->subject);
            $envelope->setBody($this->applyData($this->bodyText, $data));

            try {
                $this->themeSettings->mailing->mailer->send($envelope);
            }
            catch (\Aws\Exception\AwsException $e) {
                vomit("There was a problem sending the email. Message: ".$e->getAwsErrorMessage());
            }
            catch (InvalidArgumentException $e)
            {
                vomit("There was a problem sending the email. Message: ".$e->getMessage());
            }
        }
        else {
            // use the default WP Mail function
            $headers = array();

            if (count($this->bcc) > 0) {
                foreach($this->bcc as $toEmail) {
                    $headers[] = "BCC: ".$toEmail;
                }
            }

            $toRecipients = array();
            if ($email != null)
                $toRecipients[] = $email;
            if (count($this->to) > 0) {
                foreach($this->to as $toEmail)
                    $toRecipients[] = $toEmail;
            }

            wp_mail($toRecipients, $this->applyData($this->subject, $data), $this->applyData($this->bodyText, $data), $headers );
        }
    }

    private function applyData($template, $data=[]) {
        foreach($data as $key => $value) {
            $template = str_replace('%%'.$key.'%%',$value,$template);
        }

        $template = str_replace('%%site_url%%',home_url('/'), $template);

        $template = preg_replace("/(%%[aA-zZ0-9_-]+%%)/", "", $template);
        
        return $template;
    }

    public static function sendTemplate($context, $slugOrTemplate, $email = null, $data=[]) {
    	if ($slugOrTemplate instanceof MailTemplate) {
		    $slugOrTemplate->send($email, $data);
	    } else {
		    $templatePost = get_page_by_path($slugOrTemplate,OBJECT,'mail-template');
		    if ($templatePost) {
			    $template = $context->modelForPost($templatePost);
			    $template->send($email, $data);
		    }
	    }
    }
}