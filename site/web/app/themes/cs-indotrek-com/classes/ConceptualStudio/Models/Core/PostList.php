<?php

namespace ConceptualStudio\Models\Core;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Models\CPT\Product;


/**
 * Class PostList
 * @package ConceptualStudio\Models\Content
 */
class PostList extends ContentBlock {
    public $posts = null;
    private $displayLimit = null;    
    public $currentPage = 1;
    public $totalPages = 1;


    public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
        parent::__construct($context, $data, $post, $page, $template);

        // assign the custom template, if provided
        if (isset($data['template']) && $data['template'])
            $this->template = "partials/content/".$data['template'];
        // populate the post list
        $this->posts = array();
        if (isset($data['display_limit']) )
            $this->displayLimit = $data['display_limit'];
        $args = [
            'post_type' => $data['post_type'],
            'post_status' => 'publish',
            'posts_per_page' => $this->displayLimit ? $this->displayLimit : 20000,
        ];

        if (isset($data['args'])) {
            $args = array_merge($args, $data['args']);
        }

        if( !empty($args['paged']) ){
            $this->currentPage = intval($args['paged']);
        }
        $query = new \WP_Query($args);
        // vomit($query);

        $this->totalCount = $query->found_posts;
        if ( $data['post_type'] != 'product') {
            foreach ($query->posts as $mpost)
                $this->posts[] = $this->context->modelForPost($mpost);
        }else{
            $this->totalPages =  (intval($query->max_num_pages)) ? intval($query->max_num_pages) : 1;            
            foreach ($query->posts as $mpost)
                $this->posts[] = new Product($context, $mpost);
        }
    }
}