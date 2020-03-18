<?php

namespace ConceptualStudio\Models\Content;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Models\Core\PostList;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Traits\Content\HasThemeSettings;



/**
 * Class ContactThankYou
 *
 *
 * @package ConceptualStudio\Models\Content
 */
class ContactThankYou extends ContentBlock {
    public $title = null;
    public $caption = null;
    public $description = null;
    public $cta = null;
    public $blogList = null;

    use ConceptualTool;
        public function __construct(Context $context, $data = null, Post $post = null, Page $page = null, $template = null) {
        $template = 'partials/pages/contact/contact-us';

        parent::__construct($context, $data, $post, $page, $template);
        vomit($data);
        $this->title = arrayPath($data, 'title', null);
        $this->caption = arrayPath($data, 'caption', null);
        $this->description = arrayPath($data, 'description', null);
        $this->getHomeBloging($context);
    }
}