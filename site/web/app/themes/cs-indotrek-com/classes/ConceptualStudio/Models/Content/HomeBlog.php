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
 * Class BlogList
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class HomeBlog extends ContentBlock {
    public $title = null;
    public $caption = null;
    public $description = null;
    public $cta = null;
    public $blogList = null;

    use ConceptualTool;
        public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
        $template = 'partials/pages/home/home-blog';

            parent::__construct($context, $data, $post, $page, $template);
        $this->title = arrayPath($data, 'title', null);
        $this->caption = arrayPath($data, 'caption', null);
        $this->description = arrayPath($data, 'description', null);
        $this->getHomeBloging($context);
    }

    /**
     * @param Context $context
     * 
     */
    public function getHomeBloging(Context $context) {
        $data['post_type'] = 'post';
        $data['display_limit'] = 10;

        $postList = new PostList($context, $data);
        $this->postList = array();
        if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
            foreach($postList->posts as $item){
                $this->blogList[] = $item->getBlogItem();
            }
        }
    }
}