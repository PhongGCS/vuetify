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
class ContentPageController extends PageController implements HasContentInterface {
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

		if (!$this->page && $this->targetPagePath) {
			$pagePost = get_page_by_path($this->targetPagePath);

			if ($pagePost)
				$this->page = $context->modelForPost($pagePost);
		}

		// add Theme Settings
        $this->buildThemeSettings($context);

		if ($this->page) {
			$this->buildContent($context, $this->page);
			$this->buildHero($context, $this->page);
			$this->queueScripts($this->page->id());
		}
	}

	public function getIndex(Request $request) {
		if ($request->query->has('partial')) {
			$result='';
			foreach($this->content->content as $content) {
				if ($content->supportsPartial($request->query->get('partial')))
					$result .= $content->render();
			}

			return new \Symfony\Component\HttpFoundation\Response($result);
		} else {
			$data = [
				'errors' => [],
				'params' => $request->request,
				'content' => $this->content,
                'themeSettings' => $this->themeSettings,
				'page' => $this
			];

			if (($this instanceof HasHeroInterface))
				$data['hero'] = $this->hero;

			$res = new Response($this->template, $data);

			return $res;
		}
	}


}