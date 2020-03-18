<?php

namespace ConceptualStudio\Controllers;

use Stem\Controllers\PageController;
use Stem\Controllers\PostController;
use Stem\Controllers\PostsController;
use Stem\Core\Context;
use Stem\Core\Response;
use Symfony\Component\HttpFoundation\Request;

use ConceptualStudio\Models\ContentBlockContainer;
use ConceptualStudio\Traits\Content\HasContentProduct;
use ConceptualStudio\Traits\Content\HasThemeSettings;
use ConceptualStudio\Traits\Content\HasPageScripts;
use ConceptualStudio\Traits\Content\HasHero;
use ConceptualStudio\Models\CPT\ProductDetail;
use ConceptualStudio\Models\Content\TestimonialList;

class SingleProductController extends PostController {
    use HasPageScripts;
    use HasThemeSettings;
    public $relatedProduct = null;
    public $course = null;
    public function __construct(Context $context, $template=null) {
        if ($template == null)
            $template = 'templates/single-product';
            
        parent::__construct($context, $template);
        $post = get_post(get_the_ID());
        // vomit($post);
        $this->tour = new ProductDetail( $context, $post );
        
        // add Theme Settings
        $this->buildThemeSettings($context);
    }

    public function getIndex(Request $request) {
            // vomit($this->tour);
            $data = [
                'errors' => [],
                'params' => $request->request,
                'themeSettings' => $this->themeSettings,
                'page' => $this,
                'tour'  => $this->tour,
            ];

            $res = new Response('templates/single-product', $data);

            return $res;
    }
}