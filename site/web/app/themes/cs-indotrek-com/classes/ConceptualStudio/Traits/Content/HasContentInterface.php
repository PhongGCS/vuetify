<?php

namespace ConceptualStudio\Traits\Content;

use Stem\Core\Context;
use Stem\Models\Page;

/**
 * Interface HasContentInterface
 * @package ConceptualStudio\Traits\Content
 */
interface HasContentInterface {
	/**
	 * Builds the content for the page.
	 *
	 * @param Context $context
	 * @param Page $page
	 */

	public function buildContent(Context $context, Page $page);
}
