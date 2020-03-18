<?php

namespace ConceptualStudio\Models\Content;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Traits\Content\HasThemeSettings;
use ConceptualStudio\Models\Core\Destination;


/**
 * Class HomeDestination
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class HomeDestinations extends ContentBlock {
  public $title = null;
  public $caption = null;
  public $description = null;
  public $cta = null;
  public $destinationList = null;

  use ConceptualTool;
	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
    $template = 'partials/pages/home/home-destinations';

		parent::__construct($context, $data, $post, $page, $template);
      $this->title = arrayPath($data, 'title', null);
      $this->caption = arrayPath($data, 'caption', null);
      $this->description = arrayPath($data, 'description', null);
      if (isset($data['cta']))
        $this->cta = new Link($context, $data['cta']);
      $this->getFullDestinationList();
  }
  
  private function  getFullDestinationList() {
    $terms = get_terms( 'destination', array(
      'hide_empty' => false,
      'parent' => 0
    ));
    $this->destinationList = array();
    if(!empty ($terms) && is_array($terms) && count($terms) ){
        foreach($terms as $item){
          $this->destinationList[] = new Destination($this->context, $item);
        }
    }
  }
}