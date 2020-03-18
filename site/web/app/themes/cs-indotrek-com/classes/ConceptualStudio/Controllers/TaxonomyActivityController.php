<?php
namespace ConceptualStudio\Controllers;

use Stem\Controllers\PageController;
use Stem\Core\Context;
use Stem\Core\Response;
use ConceptualStudio\Traits\Content\HasContent;
use ConceptualStudio\Traits\Content\HasContentInterface;
use ConceptualStudio\Traits\Content\HasHero;
use ConceptualStudio\Traits\Content\HasThemeSettings;
use ConceptualStudio\Traits\Content\HasPageScripts;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContentPageController
 *
 * Controller for pages that use content blocks.
 *
 * @package ConceptualStudio\Controllers
 */
class TaxonomyActivityController extends PageController implements HasContentInterface {
	use HasContent;
	use HasHero;
	use HasThemeSettings;
	use HasPageScripts;

	protected $targetPagePath = null;
    public $campuses = array();

	public function __construct(Context $context, $template=null) {
		if ($template == null)
			$template = 'templates/content-page';

		parent::__construct($context, $template);
    $post = get_post(TOURS_ID);
    $this->page = $context->modelForPost($post);
		// add Theme Settings
        $this->buildThemeSettings($context);

		if ($this->page) {
			$this->buildContent($context, $this->page);
			$this->buildHero($context, $this->page);
			$this->queueScripts($this->page->id());
		}
	}

	public function getIndex(Request $request) {
			$data = [
				'errors' => [],
				'params' => $request->request,
				'content' => $this->content,
        'themeSettings' => $this->themeSettings,
        'page' => $this,
      ];
      
      $currentCategory = get_queried_object();
      if(!empty($currentCategory->taxonomy)) {
        $data['currentFilter'] = [
          "activity" => $currentCategory->slug,
          "destination" => "all",
          "duration" => "all",
          "category-type" => "all",
        ];
      }

			if (($this instanceof HasHeroInterface))
				$data['hero'] = $this->hero;

			$res = new Response($this->template, $data);

			return $res;
	}


}