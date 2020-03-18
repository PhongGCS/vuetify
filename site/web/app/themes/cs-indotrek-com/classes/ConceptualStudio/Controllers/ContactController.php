<?php
namespace ConceptualStudio\Controllers;

use Stem\Controllers\PageController;
use Stem\Core\Context;
use Stem\Core\Response;
use ConceptualStudio\Traits\Content\HasContent;
use ConceptualStudio\Traits\Content\HasContentInterface;
use ConceptualStudio\Traits\Content\HasHero;
use ConceptualStudio\Traits\Content\HasOptions;
use ConceptualStudio\Traits\Content\HasPageScripts;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use ConceptualStudio\Traits\Content\HasThemeSettings;

use ConceptualStudio\Models\Core\MailTemplate;
use ByJG\Mail\Envelope;


/**
 * Class ContactController
 *
 * Controller for all contact form actions.
 *
 * @package ConceptualStudio\Controllers
 */
// ini_set('display_errors','Off');
// ini_set('error_reporting', E_ALL );

class ContactController extends PageController {
    use HasThemeSettings;
    public $name = "";
    public $email = "";
    public $phone = "";
    public $message = null;
    public $place = "";
    public $number = "";
    public $accommodation = "";
    public $date = "";
    public $duration = "";
    public $brochure = "";
    public $source = "";
    public $nationality = "";
    public $whiteList = [];
    public $emailData = [];

    public function __construct(Context $context, $template=null) {
        parent::__construct($context, $template);
    }
    public function postContactForm(Request $request) {
        status_header(200);   
        $this->data  = json_decode($request->getContent(), true);  
        // vomit($this->data);
        $this->whiteList = [
            "name", "phone", "message", "token", "nationality"
        ];

        $this->getPostData();
        // vomit($this->emailData);
        $this->sendEmail($this->emailData, false);
        wp_send_json(["status" => "1", "message" => "Thank for your submission"]);
    }
    public function postTourForm(Request $request) {
        status_header(200);   

        $this->data  = json_decode($request->getContent(), true);  
        // vomit($this->data);
        $this->whiteList = [
            "token","name", "phone", "tour", "number", "accommodation", "date", "duration", "brochure", "source", "nationality"
        ];

        $this->getPostData();
        // vomit($this->emailData);
        $this->sendEmail($this->emailData);
        wp_send_json(["status" => "1", "message" => "Thank for your submission"]);
    }
    public function sendEmail($mailData = [], $isTour = true) {
        MailTemplate::sendTemplate($this->context, 'confirm', $this->email, $mailData);
        if($isTour) {
            MailTemplate::sendTemplate($this->context, 'tour-notice', null, $mailData);
        }else {
            MailTemplate::sendTemplate($this->context, 'contact-notice', null, $mailData);
        }
    }

    public function getPostData() {
        $recaptchaToken = filter_var($this->data['token'], FILTER_SANITIZE_STRING);
        if (! isset( $recaptchaToken ) || ! wp_verify_nonce( $recaptchaToken, 'indotrek-token' ) ){
            wp_send_json(["status" => "025", "message" => "Bad Request. The token is not correct!"]);
        }

        $this->email = filter_var($this->data['email'], FILTER_VALIDATE_EMAIL);
        $this->emailData["email"] = $this->email;
        if(!empty ($this->whiteList) && is_array($this->whiteList) && count($this->whiteList) ){
            foreach($this->whiteList as $item){
                if(!empty($this->data[$item])) {
                    if(is_array($this->data[$item])) {
                        $this->$item = implode("," , $this->data[$item]);
                    }else {
                        $this->$item = filter_var($this->data[$item], FILTER_SANITIZE_STRING);
                    }
                    $this->emailData[$item] = $this->$item;
                }
            }
        }
    }
}
