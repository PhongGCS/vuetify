<?php

namespace ConceptualStudio\Controllers;

use Stem\Core\Context;
use Stem\Core\Response;
use Stem\Controllers\PageController;
use Stem\Controllers\PostController;
use Stem\Controllers\PostsController;
use Symfony\Component\HttpFoundation\Request;
use ConceptualStudio\Traits\Content\HasContent;
use ConceptualStudio\Models\ContentBlockContainer;
use ConceptualStudio\Traits\Content\HasPageScripts;
use ConceptualStudio\Traits\Content\HasThemeSettings;


class PageCartController extends PostController {
    // use HasHero;
    use HasContent;
    use HasPageScripts;
    use HasThemeSettings;

    public function __construct(Context $context, $template=null) {
        parent::__construct($context, $template);

        // add Theme Settings
        $this->buildThemeSettings($context);
    }

    public function getIndex(Request $request)
    {
        $data = [
            'errors' => [],
            'params' => $request->request,
            'content' => $this->content,
            'themeSettings' => $this->themeSettings,
            'page' => $this,
            'html' => apply_filters('the_content', get_post_field('post_content', get_the_ID())),
        ];
        $res = new Response('templates/default-template', $data);

        return $res;
    }
}