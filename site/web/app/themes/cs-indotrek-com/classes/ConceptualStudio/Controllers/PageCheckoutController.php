<?php

namespace ConceptualStudio\Controllers;
use ConceptualStudio\Controllers\PageCartController;
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



class PageCheckoutController extends PageCartController {
  use HasContent;
  use HasPageScripts;
  use HasThemeSettings;
  public function __construct(Context $context, $template=null) {
    parent::__construct($context, $template);
  }
}