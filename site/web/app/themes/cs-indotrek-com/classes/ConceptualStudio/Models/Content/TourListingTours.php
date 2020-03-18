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
 * Class TourListingTours
 * @package ConceptualStudio\Models\Content
 */
class TourListingTours extends ContentBlock {
  public $title = null;
  public $description = null;

  use ConceptualTool;
	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
    $template = 'partials/pages/tour-listing/tour-listing-tours';
		parent::__construct($context, $data, $post, $page, $template);
      $this->title = arrayPath($data, 'title', null);
      $this->description = arrayPath($data, 'description', null);
      $this->getTourList();
      $this->getFilterLevel2();
      $this->getCurrentFilter();
  }
  
  private function  getTourList() {
    $data['post_type'] = 'product';
    $data['display_limit'] = 100;

    $postList = new PostList($this->context, $data);
    $this->postList = array();
    if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
        foreach($postList->posts as $item){
            $this->postList[] = $item->getDataForList();
        }
    }
  }

  private function  getFilterLevel2() { 
    $this->filterList[] = getFilterItem('destination');

    $this->filterList[] = getFilterItem('duration');
    $this->filterList[] = getFilterItem('activity');
    $this->filterList[] = getFilterItem('category-type');
  }

  private function getCurrentFilter() {
    $this->currentFilter =   [
      "activity" => 'all',
      "destination" => "all",
      "duration" => "all",
      "category-type" => "all",
    ];
  }
}