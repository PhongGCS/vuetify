<?php

namespace ConceptualStudio\Models\Core;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Traits\Content\HasThemeSettings;

class PhotosGallery {
  public $title = null;
  public $caption = null; 
  public $ctaText = null;
  public $gallery = null;
  use ConceptualTool;

	public function __construct(Context $context, $data = null) {
    $this->title = arrayPath($data, 'title', null);
    $this->caption = arrayPath($data, 'caption', null);
    $this->ctaText = arrayPath($data, 'ctaText', null);

    $this->gallery = array();
    if(!empty ($data['gallery']) && is_array($data['gallery']) && count($data['gallery']) ){
        foreach($data['gallery'] as $item){
          $this->gallery[] = $this->getImageAndCaption($context, $item, 'full-width');
        }
    }
  }
}