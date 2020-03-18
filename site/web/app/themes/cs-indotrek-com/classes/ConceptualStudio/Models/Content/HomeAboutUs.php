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
 * Class HomeAboutUs
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class HomeAboutUs extends ContentBlock {
  public $title = null;
  public $caption = null;
  public $description = null;
  public $image = null;
  public $imageMobile = null;

  use ConceptualTool;
	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
    $template = 'partials/pages/home/home-about-us';

    parent::__construct($context, $data, $post, $page, $template);
      $this->title = arrayPath($data, 'title', null);
      $this->caption = arrayPath($data, 'caption', null);
      $this->description = arrayPath($data, 'description', null);

      $this->image = $this->getImage($context, arrayPath($data, 'image', null), 'full-width');
      $this->imageMobile = $this->getImage($context, arrayPath($data, 'imageMobile', null), 'full-width');

	}
}