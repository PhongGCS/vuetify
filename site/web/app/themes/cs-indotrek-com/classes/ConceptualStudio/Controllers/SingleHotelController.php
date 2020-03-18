<?php

namespace ConceptualStudio\Controllers;

use Stem\Core\Context;
use Stem\Core\Response;
use Stem\Controllers\PageController;
use Stem\Controllers\PostController;
use Stem\Controllers\PostsController;
use ConceptualStudio\Models\Core\PostList;

use ConceptualStudio\Models\CPT\HotelDetail;
use Symfony\Component\HttpFoundation\Request;
use ConceptualStudio\Traits\Content\HasContent;
use ConceptualStudio\Models\ContentBlockContainer;
use ConceptualStudio\Traits\Content\HasPageScripts;
use ConceptualStudio\Traits\Content\HasThemeSettings;


class SingleHotelController extends PostController {
    // use HasHero;
    use HasContent;
    use HasPageScripts;
    use HasThemeSettings;
    public $post = null;
    public $relatedPost = null;

    public function __construct(Context $context, $template=null) {
        parent::__construct($context, $template);
        $post = get_post(get_the_ID());
        $this->hotel = new HotelDetail( $context, $post );

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
            'hotel' => $this->hotel,
        ];
        $res = new Response('templates/single-hotel', $data);

        return $res;
    }
}