<?php

namespace ConceptualStudio\Models\Core;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Traits\Content\HasThemeSettings;



/**
 * Class PageHero
 *
 * Page hero's are the big image and headline elements on the top of the page.
 *
 * @package ConceptualStudio\Models\Content
 */
class PageHero extends ContentBlock {
    use HasThemeSettings;

    public $enabled = null;
    public $style = null;
    public $title = null;
    public $cta = null;
    public $svgMap = null;
    use ConceptualTool;

	public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
		if (!$template)
			$template = 'partials/core/page-hero';

		if (!isset($data) || !is_array($data) || count($data) == 0) {
            $this->enabled = false;
            return;
        }

		parent::__construct($context, $data, $post, $page, $template);

        if (isset($data['enabled']))
            $this->enabled = $data['enabled'];
        $this->style = arrayPath($data, 'style', null);
        if (isset($data['cta']))
            $this->cta = new Link($context, $data['cta']);
        $this->title = arrayPath($data, 'title', null);
        $this->background = $this->getImage($context, arrayPath($data, 'background', null), 'hero');
        $this->backgroundMobile = $this->getImage($context, arrayPath($data, 'background', null), 'hero-mobile');
        $this->svgMap = $this->getImage($context, arrayPath($data, 'svgMap', null), 'full');

	}

}