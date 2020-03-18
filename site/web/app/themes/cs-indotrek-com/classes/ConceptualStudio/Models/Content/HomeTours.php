<?php

namespace ConceptualStudio\Models\Content;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Traits\Content\HasThemeSettings;
use ConceptualStudio\Models\Core\PostList;



/**
 * Class HomeTours
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class HomeTours extends ContentBlock {
  public $title = null;
  public $caption = null;
  public $description = null;
  public $cta = null;

  use ConceptualTool;
	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
    $template = 'partials/pages/home/home-tours';

		parent::__construct($context, $data, $post, $page, $template);
      $this->title = arrayPath($data, 'title', null);
      $this->caption = arrayPath($data, 'caption', null);
      $this->description = arrayPath($data, 'description', null);
      if (isset($data['cta']))
        $this->cta = new Link($context, $data['cta']);
      $this->getTourList();
  }
  
  private function  getTourList() {
    $data['post_type'] = 'product';
    $data['display_limit'] = 4;
    $args['args']['meta_key'] = 'isFeatured';
    $args['args']['meta_value'] = true;
    $args['args']['meta_compare'] = '=';

    $postList = new PostList($this->context, $data);
    $this->postList = array();
    if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
        foreach($postList->posts as $item){
            $this->postList[] = $item->getDataForList();
        }
    }
  }
}