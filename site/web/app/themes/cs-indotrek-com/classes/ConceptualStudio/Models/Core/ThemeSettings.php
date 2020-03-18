<?php

namespace ConceptualStudio\Models\Core;

use ConceptualStudio\Models\ContentBlock;
use ConceptualStudio\Traits\Content\HasLink;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Traits\Components\ConceptualTool;


/**
 * Class ThemeSettings
 * @package ConceptualStudio\Models\Core
 */
class ThemeSettings
{
    public $maintenance_mode = null;
    public $page404 = null;
    public $forms = null;
    public $mailing = null;
    public $general = null;
    public $header = null;
    public $footer = null;
    public $contactBox = null;
    use ConceptualTool;

    public function __construct(Context $context, $data = null) {
        $this->forms = (object) get_field('forms', 'options');
        $this->general = (object) get_field('general', 'options');
        $this->mailing = new ThemeSettingsMailing($context, get_field('mailing', 'options'));
        $this->header = new Header($context, get_field('header', 'option'));
        $this->contactBox = new ContactBox($context, get_field('contactBox', 'option'));
        $this->footer = new Footer($context, get_field('footer', 'option'));
        $this->maintenance_mode = (object) get_field('maintenance_mode', 'options');
        $this->page404 = (object) get_field('404_page', 'options');

    }

}

class Header {
    public $white = null;
    public $black = null;
    use ConceptualTool;

    public function __construct(Context $context, $data = null){
        $this->white = $this->getImage($context, arrayPath($data, 'white', null), 'full');
        $this->black = $this->getImage($context, arrayPath($data, 'black', null), 'full');
    }
    
}

class Footer {
    public $firstLine = null;
    public $secondLine = null;
    public $thirdLine = null;

    use ConceptualTool;
    
    
    public function __construct(Context $context, $data = null){
        $this->firstLine = arrayPath($data, 'firstLine', null);
        $this->secondLine = arrayPath($data, 'secondLine', null);
        $this->thirdLine = arrayPath($data, 'thirdLine', null);
    }
}
class ContactBox {
    public $image = null;
    public $address = null;
    public $phone = null;
    public $fax = null;
    public $email = null;
    use ConceptualTool;

    public function __construct(Context $context, $data = null){
        $this->address = arrayPath($data, 'address', null);
        $this->phone = arrayPath($data, 'phone', null);
        $this->fax = arrayPath($data, 'fax', null);
        $this->email = arrayPath($data, 'email', null);
        $this->image = $this->getImage($context, arrayPath($data, 'image', null), 'full');

    }
}

class ThemeSettingsMailing
{
    public $mailer = null;
    public $senderEmail = null;
    public $senderName = null;
    public $mailerName = 'default';
    public $amazonSesAccessKeyID = null;
    public $amazonSesSecretKey = null;
    public $amazonSesRegion = null;

    public $mailgunApiKey = null;
    public $mailgunDomain = null;

    public function __construct(Context $context, $data = null)
    {
        if (isset($data['mailer']))
            $this->mailerName = $data['mailer'];
        if (isset($data['sender_email']))
            $this->senderEmail = $data['sender_email'];
        if (isset($data['sender_name']))
            $this->senderName = $data['sender_name'];

        switch ($this->mailerName) {
            case 'amazon-ses':
                if (isset($data['amazon_ses_access_key_id']))
                    $this->amazonSESAccessKeyID = $data['amazon_ses_access_key_id'];
                if (isset($data['amazon_ses_secret_key']))
                    $this->amazonSesSecretKey = $data['amazon_ses_secret_key'];
                if (isset($data['amazon_ses_region']))
                    $this->amazonSesRegion = $data['amazon_ses_region'];

                $this->createAmazonSESMailer();
                break;
            case 'mailgun':
                if (isset($data['mailgun_api_key']))
                    $this->mailgunApiKey = $data['mailgun_api_key'];
                if (isset($data['mailgun_domain']))
                    $this->mailgunDomain = $data['mailgun_domain'];

                $this->createMailgunMailer();
                break;
            case 'default':
                $this->createPHPMailer();
            default:
                // the mailer stays null
                break;
        }



    }

    private function createAmazonSESMailer()
    {
        try {
            // create a Amazon SES Mailer
            $this->mailer = new \ByJG\Mail\Wrapper\AmazonSesWrapper(
                new \ByJG\Util\Uri(
                    'ses://' . $this->amazonSESAccessKeyID . ':' . $this->amazonSesSecretKey . '@' . $this->amazonSesRegion
                )
            );
        }
        catch (\Aws\Exception\AwsException $e) {
            vomit("There was a problem creating the mailer. Message: ".$e->getAwsErrorMessage());
        }

    }    
    
    private function createPHPMailer()
    {
        try {
            // create a Amazon SES Mailer
            $this->mailer = new \ByJG\Mail\Wrapper\PHPMailerWrapper(
                new \ByJG\Util\Uri('')
            );
        }
        catch (Exception $e)  {
            vomit("There was a problem creating the PHP mailer. Message: ".$e->getMessage());
        }

    }


    private function createMailgunMailer()
    {
        try {
            // create a Mailgun Mailer
            $this->mailer = new \ByJG\Mail\Wrapper\MailgunApiWrapper(
                new \ByJG\Util\Uri(
                    'mailgun://' . $this->mailgunApiKey . '@' . $this->mailgunDomain
                )
            );
        }
        catch (\ByJG\Mail\Exception\MailApiException $e) {
            vomit("There was a problem creating the mailer. Message: ".$e->getMessage());
        }
    }
}