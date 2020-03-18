<?php

namespace ConceptualStudio\Models\Content;

use Stem\Models\Page;

use Stem\Models\Post;
use Stem\Core\Context;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Models\ContentBlock;
use ConceptualStudio\Models\Core\PostList;
use ConceptualStudio\Models\Content\ContactUs;
use ConceptualStudio\Traits\Content\HasThemeSettings;
use ConceptualStudio\Traits\Components\ConceptualTool;


/**
 * Class HotelListing
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class HotelListing extends ContentBlock {
    public $title = null;
    public $caption = null;
    public $description = null;
    public $cta = null;
    public $blogList = null;

    use ConceptualTool;
        public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
        $template = 'partials/pages/hotels/hotel-listing';

        parent::__construct($context, $data, $post, $page, $template);
        $this->getHotelListing($context);
        $this->filterList[] = getFilterItem("destination");
    }

    /**
     * @param Context $context
     * 
     */
    public function getHotelListing(Context $context) {
        $data['post_type'] = 'hotel';
        $data['display_limit'] = 110;

        $postList = new PostList($context, $data);
        $this->postList = array();
        if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
            foreach($postList->posts as $item){
                $this->postList[] = $item->getObjectForList();
            }
        }
    }
}