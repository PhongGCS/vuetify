<?php

namespace ConceptualStudio\Controllers;

use Stem\Controllers\PageController;
use Stem\Controllers\PostController;
use Stem\Controllers\PostsController;
use Stem\Core\Context;
use Stem\Core\Response;
use Symfony\Component\HttpFoundation\Request;

use ConceptualStudio\Models\ContentBlockContainer;
use ConceptualStudio\Traits\Content\HasContent;
use ConceptualStudio\Traits\Content\HasThemeSettings;
use ConceptualStudio\Traits\Content\HasPageScripts;
use ConceptualStudio\Traits\Content\HasHero;

class Error404Controller extends PageController {
    use HasHero;
    use HasContent;
    use HasPageScripts;
    use HasThemeSettings;

    public function __construct(Context $context, $template=null) {
        parent::__construct($context, $template);

        // add Theme Settings
        $this->buildThemeSettings($context);

        $this->content = $this->themeSettings->page404;

        if ($this->page) {
            $this->buildContent($context, $this->page);
            $this->buildHero($context, $this->page);
            $this->queueScripts($this->page->id);
        }

    }

    public function getIndex(Request $request)
    {
        $data = [
            'errors' => [],
            'params' => $request->request,
            'content' => $this->content,
            'themeSettings' => $this->themeSettings,
            'page' => $this,
            'post' => @$this->post,
        ];

        if (($this instanceof HasHeroInterface))
            $data['hero'] = $this->hero;

        $res = new Response('templates/404-page', $data);

        return $res;
    }


}