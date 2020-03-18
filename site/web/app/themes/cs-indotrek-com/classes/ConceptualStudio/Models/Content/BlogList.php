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
 * Class BlogList
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class BlogList extends ContentBlock {
    public $title = null;
    public $caption = null;
    public $description = null;

    use ConceptualTool;
        public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
        $template = 'partials/pages/blog/blog-list';

            parent::__construct($context, $data, $post, $page, $template);
        $this->title = arrayPath($data, 'title', null);
        $this->caption = arrayPath($data, 'caption', null);
        $this->description = arrayPath($data, 'description', null);
        $this->getBlogListing();
        $this->filterList[] = getFilterItem("destination");
    }
    public function getBlogListing() {
        $data['post_type'] = 'post';
        $data['display_limit'] = 100;

        $postList = new PostList($this->context, $data);
        $this->postList = array();
        if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
            foreach($postList->posts as $item){
                $this->postList[] = $item->getBlogItem();
            }
        }
    }
}