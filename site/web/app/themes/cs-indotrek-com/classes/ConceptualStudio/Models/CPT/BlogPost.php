<?php
namespace ConceptualStudio\Models\CPT;

use ConceptualStudio\Traits\Content\Excerpt;
use Stem\Core\Context;
use Stem\Models\Post;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Models\Core\PostList;



/**
 * Class BlogPost
 * @package ConceptualStudio\Models\CPT
 */
class BlogPost extends Post {
    public $title = null;
    public $description = null;
    public $date = null;
    public $url = null;
    public $thumbnail = null;
    use ConceptualTool;

    public function __construct(Context $context, \WP_Post $post){
        parent::__construct($context, $post);

        $data = get_fields($this->id);
        $this->title = $post->post_title;
        $this->description = arrayPath($data, 'shortDescription', null);
        $this->url = get_permalink($this->id);
        $this->date = get_the_date("F j Y", $this->id);
        $thumbnail = arrayPath($data, 'thumbnail', null);
        if($thumbnail) {
            $this->thumbnail = $this->getImage($context, $thumbnail, 'tour-thumbnail ');
        }else {
            $this->thumbnail = wc_placeholder_img_src();
        }
    }

    function getBlogItem() {
        return [
            'title' => $this->title,
            'link' => get_permalink($this->id),
            'description' => $this->description,
            'date' => get_the_date("F j Y", $this->id),
            'image' => $this->thumbnail,
            'destination' => $this->getTermSlugOrName('destination'),
        ];
    }

    function getHeroImage() {
        $heroImage = get_field("heroImage", $this->id);
        if($heroImage) {
            return $this->getImage($this->context, $heroImage, 'hero');
        }else {
            return wc_placeholder_img_src();
        }
    }
    function getTags() {
        $tags = get_the_tags($this->id);
        return $tags;
    }

    function getRelatedBlog($destinationParent = "") {
        $destination = $this->getTermSlugOrName('destination');
        $data['post_type'] = 'post';
        $data['display_limit'] = 2;
        $data['args']['post__not_in'] = [$this->id];

        if(!empty($category)) {
            $data['args']['destination'] = $destination;
        }
    
        $postList = new PostList($this->context, $data);
        $this->postList = array();
        if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
            foreach($postList->posts as $item){
                $this->postList[] = $item->getBlogItem();
            }
        }
        return $this->postList;
    }

}