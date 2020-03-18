<?php

namespace ConceptualStudio\Traits\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use ConceptualStudio\Models\ContentBlockContainer;

/**
 * Class HasLink
 *
 * Trait for content that has a link clone field attached to it.
 *
 * @package ConceptualStudio\Traits\Content
 */
trait HasContent {
	/**
	 * Content container
	 * @var ContentBlockContainer
	 */
	public $content = null;

	/**
	 * Builds the content for the page.
	 *
	 * @param Context $context
	 * @param Page $page
	 */
	public function buildContent(Context $context, Page $page) {
		$contentData = get_field("page_content", $page->id());
		$this->content = new ContentBlockContainer($context, $contentData, null, $page);
	}
}