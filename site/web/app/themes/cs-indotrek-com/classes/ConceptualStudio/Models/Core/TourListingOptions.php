<?php

namespace ConceptualStudio\Models\Core;

use ConceptualStudio\Models\ContentBlock;
use ConceptualStudio\Traits\Components\ConceptualTool;
use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Models\Core\PostList;

/**
 * Class TourListingOptions
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class TourListingOptions extends PostList {
    public $softwareList = [];
    use ConceptualTool;

    public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
        $data['post_type'] = 'product';
        $data['display_limit'] = 1000;
        parent::__construct($context, $data, $post, $page, $template);
    }

    function getOptionForTourListing() { 
        $softwareList = [];
        if(!empty ($this->posts) && is_array($this->posts) && count($this->posts) ){
            foreach($this->posts as $item){
                $softwareList[] = (object) [
                  'value' => $item->title,
                  'label' => $item->title,
                ];
            }
        }
        return $softwareList;
    }
}