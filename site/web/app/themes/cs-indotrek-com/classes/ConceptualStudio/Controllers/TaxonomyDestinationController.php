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
use ConceptualStudio\Models\Core\DestinationDetail;


class TaxonomyDestinationController extends PostController {
    // use HasHero;
    use HasContent;
    use HasPageScripts;
    use HasThemeSettings;
    public $post = null;
    public $relatedPost = null;

    public function __construct(Context $context, $template=null) {
        parent::__construct($context, $template);
        $this->currentCategory = get_queried_object();
        $this->buildThemeSettings($context);
        $this->objectDestination = new DestinationDetail($context , $this->currentCategory);
    }

    public function getIndex(Request $request)
    {
        $data = [
            'errors' => [],
            'params' => $request->request,
            'destination' => $this->objectDestination,
            'themeSettings' => $this->themeSettings,
            'parrent' => $this->currentCategory->parent,
        ];
        // vomit($this->objectDestination);
        if($this->currentCategory->parent) {
          $res = new Response('templates/single-city', $data);
        }else{
          $res = new Response('templates/single-country', $data);
        }
        
        return $res;
    }
}