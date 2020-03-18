<?php
namespace ConceptualStudio\Models\CPT;

use Stem\Models\Post;
use Stem\Core\Context;
use ConceptualStudio\Traits\Content\Excerpt;
use ConceptualStudio\Traits\Components\ConceptualTool;

/**
 * Class Hotel
 * @package ConceptualStudio\Models\CPT
 */
class Hotel extends Post {
    public $title = null;
    public $thumbnail = null;
    public $url = null;

    use ConceptualTool;
    public function __construct(Context $context, \WP_Post $post){
        parent::__construct($context, $post);
        $this->data = get_fields($this->id);
        $this->title = $post->post_title;
    }

    public function getThumbnail() {
        $thumbnail = arrayPath($this->data, 'thumbnail', null);
        if(empty($thumbnail)) {
          return wc_placeholder_img_src();
        }
        return $this->getImage($this->context, $thumbnail, 'tour-thumbnail ');
    }

    function getObjectForList() {
        return [
            "image" => $this->getThumbnail(),
            "title" => $this->title,
            "destination" => $this->getTermSlugOrName('destination'),
            "link" => get_permalink($this->id)
        ];
    }

}