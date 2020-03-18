<?php

namespace ConceptualStudio\Models\Core;

use ConceptualStudio\Models\ContentBlock;

use Stem\Core\Context;
use Stem\Models\Page;
use Stem\Models\Post;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Models\Core\PhotosGallery;


class DestinationDetail extends Destination {
  use ConceptualTool;

	public function __construct(Context $context, \WP_Term $term) {
    $this->context = $context;
    $this->id = $term->term_id;
    parent::__construct($context, $term);
    $this->term = $term;
    $data = get_fields($term);
    // vomit($data);
    $this->heroCountry = new HeroCountry($context, arrayPath($data, 'heroCountry', null));
    $this->countryOverview = new CountryOverview($context, arrayPath($data, 'countryOverview', null));
    $this->countryGallery = new  PhotosGallery($context, arrayPath($data, 'countryGallery', null));

    $this->heroCity = new HeroCountry($context, arrayPath($data, 'heroCity', null));
    $this->cityOverview = new CityOverview($context, arrayPath($data, 'cityOverview', null));
    $this->cityGallery = new  PhotosGallery($context, arrayPath($data, 'cityGallery', null));
  }

  function getCities() {
    if(!empty($this->parent)) return [];
    
    $cities = get_categories([
        'hide_empty' => false,
        'parent' => $this->term->term_id,
        'taxonomy' => 'destination',
      ]
    );
    $citiesObject = array();
    if(!empty ($cities) && is_array($cities) && count($cities) ){
        foreach($cities as $item){
           $citiesObject[] = new Destination($this->context, $item);
        }
    }
    return $citiesObject;

  }

  function getTours() {
    $data['post_type'] = 'product';
    $data['display_limit'] = 10;
    $data['args']['destination'] = $this->term->slug;

    $postList = new PostList($this->context, $data);
    $toursObject = array();
    if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
        foreach($postList->posts as $item){
            $toursObject[] = $item->getDataForList();
        }
    }
    return $toursObject;
  }

  function getRelatedBlog($destinationParent = "") {
    $destination = $this->getTermSlugOrName('destination', $this->id);
    $data['post_type'] = 'post';
    $data['display_limit'] = 6;
    $data['args']['post__not_in'] = [$this->id];

    if(!empty($category)) {
        $data['args']['destination'] = $destination;
    }

    $postList = new PostList($this->context, $data);
    $this->postList = array();
    if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
        foreach($postList->posts as $item){
            $this->postList[] = $item->getBlogItem();
        }
    }
    return $this->postList;
  }

  function getRelatedCity() {
    if(!empty($this->parent)) return [];
    
    $cities = get_categories([
        'hide_empty' => false,
        'parent' => $this->term->parent,
        'taxonomy' => 'destination',
        'exclude' => $this->term->term_id
      ]
    );
    $citiesObject = array();
    if(!empty ($cities) && is_array($cities) && count($cities) ){
        foreach($cities as $item){
           $citiesObject[] = new Destination($this->context, $item);
        }
    }
    return $citiesObject;
  }
}

class HeroCountry {
  use ConceptualTool;
  public $title = null;
  public $background = null;
  public $backgroundMobile = null;
  public $svgMap = null;

  public function __construct(Context $context, $data = null) {
    $this->title = arrayPath($data, 'title', null);
    $this->background = $this->getImage($context, arrayPath($data, 'background', null), 'hero');
    $this->backgroundMobile = $this->getImage($context, arrayPath($data, 'background', null), 'hero-mobile');
    $this->svgMap = $this->getImage($context, arrayPath($data, 'svgMap', null), 'full');

  }  
}

class CountryOverview {
  use ConceptualTool;
  public $title = null;
  public $description = null;
  public $contryInfo = null;

  public function __construct(Context $context, $data = null) {

    $this->title = arrayPath($data, 'title', null);
    $this->description = arrayPath($data, 'description', null);


    $this->contryInfo = array();
    if(!empty ($data['repeaterInfo']) && is_array($data['repeaterInfo']) && count($data['repeaterInfo']) ){
      foreach($data['repeaterInfo'] as $item){
        $this->repeaterInfo[] = (object) array(
          'title' => arrayPath($item, 'title', null),
          'caption' => arrayPath($item, 'caption', null),
          'icon' => $this->getImage($context, arrayPath($item, 'icon', "full")),
        );
      }
    }
  }  
}

class CityOverview {
  use ConceptualTool;
  public $title = null;
  public $caption = null;
  public $description = null;
  public $contryInfo = null;

  public function __construct(Context $context, $data = null) {
    $this->title = arrayPath($data, 'title', null);
    $this->caption = arrayPath($data, 'caption', null);
    $this->description = arrayPath($data, 'description', null);

    $this->gallery = array();
    if(!empty ($data['gallery']) && is_array($data['gallery']) && count($data['gallery']) ){
      foreach($data['gallery'] as $item){
        $this->gallery[] = $this->getImageAndCaption($context, $item, 'full-width');
      }
    }
  }  
}



