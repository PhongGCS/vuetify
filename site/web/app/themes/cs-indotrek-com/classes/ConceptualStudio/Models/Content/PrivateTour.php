<?php

namespace ConceptualStudio\Models\Content;

use Stem\Models\Page;

use Stem\Models\Post;
use Stem\Core\Context;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Models\ContentBlock;
use ConceptualStudio\Models\Core\PostList;
use ConceptualStudio\Traits\Content\HasThemeSettings;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Models\Core\TourListingOptions;



/**
 * Class ContactUS
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class PrivateTour extends ContentBlock {
    public $title = null;
    public $caption = null;
    public $description = null;
    public $instructionText = null;

    use ConceptualTool;
        public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
        $template = 'partials/pages/private-tour/private-tour';

        parent::__construct($context, $data, $post, $page, $template);

        $this->title = arrayPath($data, 'title', null);
        $this->caption = arrayPath($data, 'caption', null);
        $this->description = arrayPath($data, 'description', null);
        $this->instructionText = arrayPath($data, 'instructionText', null);
    }
    
    function getPrivateTourForm() {

      $tourListing = new TourListingOptions($this->context);
      return [
        [
          'label' => 'Name',
          'value' => 'name',
          'type' => 'text',
          'class' => 'col-12 col-6@sm',
          'validation' => [
            [ 'required' => true, 'message' => 'Please input your name', 'trigger' => 'blur' ],
            [ 'min' => 3, 'max' => 20, 'message' => 'Length should be 3 to 20', 'trigger' => 'blur' ]
          ]
        ],
        [
          'label' => 'Email Address',
          'value' => 'email',
          'type' => 'email',
          'class' => 'col-12 col-6@sm',
          'validation' => [
            [ 'required' => true, 'message' => 'Please input email address', 'trigger' => 'blur' ],
            [ 'type' => 'email', 'message' => 'Please input correct email address', 'trigger' => 'blur' ]
          ]
        ],
        [
          'label' => 'Phone Number',
          'value' => 'phone',
          'type' => 'number',
          'class' => 'col-12 col-6@sm',
          'validation' => [
            [ 'required' => true, 'message' => '', 'trigger' => 'blur' ],
            [ 'min' => 3, 'max' => 15, 'message' => 'Length should be 3 to 15', 'trigger' => 'blur' ]
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
          'label' => 'What tour are you interested in',
          'value' => 'tour',
          'type' => 'select',
          'class' => 'col-12 col-6@sm',
          'options' => $tourListing->getOptionForTourListing()
        ],
        [
          'label' => 'Number of travellers',
          'value' => 'number',
          'type' => 'number',
          'class' => 'col-12 col-6@sm'
        ],
        [
          'label' => 'Level of accommodation',
          'value' => 'accommodation',
          'type' => 'select',
          'class' => 'col-12 col-6@sm',
          'options' => [
            [
              'label' => '1-3',
              'value' => '1-3'
            ],
            [
              'label' => '3-5',
              'value' => '3-5'
            ],
            [
              'label' => '5-10',
              'value' => '5-10'
            ]
          ]
        ],
        [
          'label' => 'Travel Dates',
          'value' => 'date',
          'type' => 'date',
          'class' => 'col-12 col-6@sm'
        ],
        [
          'label' => 'Duration',
          'value' => 'duration',
          'type' => 'select',
          'class' => 'col-12 col-6@sm',
          'options' => [
            [
              'label' => '-',
              'value' => '-'
            ],
            [
              'label' => '1-5 Days',
              'value' => '5-days'
            ],
            [
              'label' => '6-10 Days',
              'value' => '10-days'
            ]
          ]
        ],
        [
          'label' => '',
          'value' => 'brochure',
          'type' => 'checkbox',
          'class' => 'col-12',
          'options' => [
            [
              'label' => 'Request online brochure',
              'name' => 'brochure'
            ]
          ]
        ],
        [
          'label' => 'What prompted you to get in touch today?',
          'value' => 'source',
          'type' => 'checkbox',
          'class' => 'col-12',
          'options' => [
            [
              'label' => 'Google',
              'name' => 'google'
            ],
            [
              'label' => 'Newsletter',
              'name' => 'newsletter'
            ],
            [
              'label' => 'Email',
              'name' => 'email'
            ],
            [
              'label' => 'Recommended',
              'name' => 'recommended'
            ],
            [
              'label' => 'Previous Contact',
              'name' => 'previous-contact'
            ]
          ]
        ]
      ];
    }
}