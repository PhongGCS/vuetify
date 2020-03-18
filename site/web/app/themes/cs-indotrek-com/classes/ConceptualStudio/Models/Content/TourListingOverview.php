<?php

namespace ConceptualStudio\Models\Content;

use Stem\Models\Page;

use Stem\Models\Post;
use Stem\Core\Context;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Models\ContentBlock;
use ConceptualStudio\Models\Core\PostList;
use ConceptualStudio\Models\Content\ContactUs;
use ConceptualStudio\Traits\Content\HasThemeSettings;
use ConceptualStudio\Traits\Components\ConceptualTool;

/**
 * Class TourListingOverview
 * @package ConceptualStudio\Models\Content
 * 
 * @var HomeBlog ConceptualStudio\Models\Content\HomeBlog
*/
class TourListingOverview extends ContentBlock {
  public $title = null;
  public $description = null;
  use ConceptualTool;
	/**
	 * __construct
	 *
	 * @param  Context $context
	 * @param  mixed $data
	 * @param  Post $post
	 * @param  mixed $page
	 * @param  mixed $template
	 * @var contact ContactUs
	 * @return void
	 */
	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
    $template = 'partials/pages/tour-listing/tour-listing-overview';
    parent::__construct($context, $data, $post, $page, $template);
      $this->title = arrayPath($data, 'title', null);
      $this->description = arrayPath($data, 'description', null);
  }
}