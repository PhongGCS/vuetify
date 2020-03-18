<?php

namespace ConceptualStudio\Models\Content;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Models\Core\PostList;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Traits\Content\HasThemeSettings;



/**
 * Class ContactUS
 *
 * @package ConceptualStudio\Models\Content
 */
class ContactUS extends ContentBlock {
    public $title = null;
    public $caption = null;
    public $description = null;
    public $instructionText = null;

    use ConceptualTool;
        public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
        $template = 'partials/pages/contact/contact-us';

        parent::__construct($context, $data, $post, $page, $template);

        $this->title = arrayPath($data, 'title', null);
        $this->caption = arrayPath($data, 'caption', null);
        $this->description = arrayPath($data, 'description', null);
        $this->instructionText = arrayPath($data, 'instructionText', null);
    }
    
    function getContactForm() {
      return [
        [
          "label" => 'Name',
          "value" => 'name',
          "type" => 'text',
          "class" => 'col-12 col-6@sm',
          "validation" => [
            [ "required" => true, "message" => 'Please input your name', "trigger" => 'blur' ],
            [ "min" => 3, "max" => 15, "message" => 'Length should be 3 to 5', "trigger" => 'blur' ]
          ]
        ],
        [
          "label" => 'Email Address',
          "value" => 'email',
          "type" => 'email',
          "class" => 'col-12 col-6@sm',
          "validation" => [
            [ "required" => true, "message" => 'Please input email address', "trigger" => 'blur' ],
            [ "type" => 'email', "message" => 'Please input correct email address', "trigger" => 'blur' ]
          ]
        ],
        [
          "label" => 'Phone Number',
          "value" => 'phone',
          "type" => 'number',
          "class" => 'col-12 col-6@sm',
          "validation" => [
            [ "required" => true, "message" => '', "trigger" => 'blur' ],
            [ "min" => 3, "max" => 15, "message" => 'Length should be 3 to 15', "trigger" => 'blur' ]
          ]
        ],
        [
          "label" => 'Nationality',
          "value" => 'nationality',
          "type" => 'text',
          "class" => 'col-12 col-6@sm',
          "validation" => [
            [ "required" => true, "message" => 'Please input your nationality', "trigger" => 'blur' ],
          ]
        ],
        [
          "label" => 'Message',
          "value" => 'message',
          "type" => 'textarea',
          "class" => 'col-12',
          "validation" => [
            [ "required" => true, "message" => '', "trigger" => 'blur' ],
            [ "min" => 20, "message" => '', "trigger" => 'blur' ]
          ]
        ]
      ];
    }
}