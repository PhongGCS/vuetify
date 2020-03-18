<?php

namespace ConceptualStudio\Models\Content;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Traits\Content\HasThemeSettings;



/**
 * Class HomeContact
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class HomeContact extends ContentBlock {
  public $title = null;
  public $description = null;
  public $cta = null;
  public $image = null;  // 2:1

  use ConceptualTool;
	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
    $template = 'partials/pages/home/home-contact';
    
		parent::__construct($context, $data, $post, $page, $template);
      $this->title = arrayPath($data, 'title', null);
      $this->description = arrayPath($data, 'description', null);
      if (isset($data['cta']))
        $this->cta = new Link($context, $data['cta']);
      $this->image = $this->getImage($context, arrayPath($data, 'image', null), 'full-width');

	}
}