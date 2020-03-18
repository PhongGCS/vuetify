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
use ConceptualStudio\Models\Core\PostList;


class SinglePostController extends PostController {
    // use HasHero;
    use HasContent;
    use HasPageScripts;
    use HasThemeSettings;
    public $post = null;
    public $relatedPost = null;

    public function __construct(Context $context, $template=null) {
        parent::__construct($context, $template);
        global $post;
        $post = get_post(get_the_ID());
        if ($post)
            $this->post = $context->modelForPost($post);

        // add Theme Settings
        $this->buildThemeSettings($context);
        $this->queueScripts(get_the_ID());
    }

    public function getIndex(Request $request)
    {
        $data = [
            'errors' => [],
            'params' => $request->request,
            'content' => $this->content,
            'themeSettings' => $this->themeSettings,
            'page' => $this,
            'mainPost' => $this->post,
        ];

        $res = new Response('templates/single-post', $data);

        return $res;
    }
}