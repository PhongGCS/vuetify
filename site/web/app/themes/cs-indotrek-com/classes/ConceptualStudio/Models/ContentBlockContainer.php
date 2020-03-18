<?php
namespace ConceptualStudio\Models;

use Stem\Core\Context;
use Stem\Core\Log;
use Stem\Models\Page;
use Stem\Models\Post;

/**
 * Class ContentBlockContainer
 *
 * Container for all content blocks on a given page.  This required the use of ACF Pro's flexible content.
 *
 * @package ConceptualStudio\Models
 */
class ContentBlockContainer {
	/**
	 * List of content blocks
	 * @var array
	 */
	public $content=[];

	/**
	 * Context
	 * @var Context|null
	 */
	public $context=null;

	/**
	 * ContentBlockContainer constructor.
	 *
	 * @param Context $context
	 * @param $contentData
	 * @param Post|null $post
	 * @param Page|null $page
	 */
	public function __construct(Context $context, $contentData, Post $post=null, Page $page=null){
		$this->context = $context;

		if ($contentData && is_array($contentData)) {
			foreach($contentData as $contentObj) {
				if (!isset($contentObj["acf_fc_layout"]))
					continue;

				$contentType = $contentObj["acf_fc_layout"];
				$contentTypeClass = '\\ConceptualStudio\\Models\\Content\\'.\Stringy\create($contentType)->upperCamelize();

				if (!class_exists($contentTypeClass)) {
				    // in case it does not exist, try to assign the core class path
                    $contentTypeClass = '\\ConceptualStudio\\Models\\Core\\'.\Stringy\create($contentType)->upperCamelize();
                }

				$templateName = 'partials/content/'.str_replace('_', '-', $contentType);

				if (class_exists($contentTypeClass)) {
					$this->content[] = new $contentTypeClass($context, $contentObj, $post, $page, $templateName);
				} else {
					Log::warning("$contentTypeClass does not exist for $contentType");
				}
			}
		}
	}
}