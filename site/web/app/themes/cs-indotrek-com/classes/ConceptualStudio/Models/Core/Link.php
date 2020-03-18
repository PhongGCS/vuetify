<?php

namespace ConceptualStudio\Models\Core;

use ConceptualStudio\Models\ContentBlock;
use ConceptualStudio\Traits\Content\HasLink;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;

/**
 * Class Link
 * @package ConceptualStudio\Models\Core
 */
class Link
{
    public $enabled = null;
    public $type = null;
    public $title = null;
    public $url = null;
    public $postID = null;
    public $postTitle = null;
    public $postContent = null;



    public function __construct(Context $context, $data = null) {
        if (isset($data['type'])) {
            $this->type = $data['type'];

            if ($this->type != 'none')
                $this->enabled = true;
        }
        if (isset($data['title']))
            $this->title = $data['title'];

        switch ($this->type) {
            case "post":
                $this->url = get_permalink($data['post_object']->ID);
                $this->postID = $data['post_object']->ID;
                $this->postTitle = $data['post_object']->post_title;
                $this->postContent = $data['post_object']->post_content;
                break;
            case "file":
                $filePost = \WP_Post::get_instance($data['file']);
                if ($filePost)
                    $this->url = $context->modelForPost($filePost)->url();
                break;
            case "external":
                $this->url = $data['external_page_link'];
                break;
            case "anchor":
                $this->url = $data['anchor'];
                break;
        }
    }

}
