<?php

namespace ConceptualStudio\Models\Core;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Models\Core\PhotosGallery;


class Destination {
  public $title = null;
  public $description = null;
  public $image = null;
  public $link = null;

  use ConceptualTool;

	public function __construct(Context $context, \WP_Term $term) {
    
    $this->title = $term->name;
    $this->description = term_description($term);
    $thumbnail = get_field("thumbnail", $term);
    // vomit($thumbnail);
    if(empty($thumbnail)) {
      $this->image = wc_placeholder_img_src();
    }else {
      $this->image = $this->getImage($context, $thumbnail, 'tour-thumbnail');
    }
    $this->link = [
      "url" => get_term_link($term, 'destination'),
      "name" => __('Discover', 'indotrek')
    ];
  }
}