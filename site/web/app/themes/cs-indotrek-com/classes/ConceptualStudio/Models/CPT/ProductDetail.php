<?php
namespace ConceptualStudio\Models\CPT;

use ConceptualStudio\Traits\Content\Excerpt;
use Stem\Core\Context;
use Stem\Models\Post;
use ConceptualStudio\Traits\Components\ConceptualTool;
use ConceptualStudio\Models\Core\Link;
use ConceptualStudio\Models\Core\PostList;
use ConceptualStudio\Models\Core\PhotosGallery;



/**
 * Class ProductDetail
 * @package ConceptualStudio\Models\CPT
 */
class ProductDetail extends Product {
    public $tourHero = "";
    public $backgroundMobile = "";
    public $tourOverview = null;
    public $tourDetail = null;
    public $tourItinerary = null;
    public $photosGallery = null;
    use ConceptualTool;
    
    public function __construct(Context $context, \WP_Post $post){
        parent::__construct($context, $post);
        $data = get_fields($this->id);
        $this->productObject = wc_get_product($this->id);
        $this->tourHero = new TourHero($context, arrayPath($data, 'heroBackground', null));
        $this->tourOverview = new TourOverview($context, arrayPath($data, 'overview', null));
        $this->tourDetail = new TourDetail($context, arrayPath($data, 'detail', null));
        $this->tourItinerary = new TourItinerary($context, arrayPath($data, 'itinerary', null));
        $this->photosGallery = new  PhotosGallery($context, arrayPath($data, 'photosGallery', null));
    }

    function getRelatedTour() {
        $data['post_type'] = 'product';
        $data['display_limit'] = 3;
        $data['args']['product_tag'] = $this->getTags();
        $data['args']['post__not_in'] = [$this->id];
        // vomit($data);

        $postList = new PostList($this->context, $data);
        $postListObject = array();
        if(!empty ($postList->posts) && is_array($postList->posts) && count($postList->posts) ){
            foreach($postList->posts as $item){
                $postListObject[] = $item->getDataForList();
            }
        }
        return $postListObject;
    }

    function getTags() {
        $tagsList = get_the_terms($this->id, 'product_tag');
        $tags = array();
        if(!empty ($tagsList) && is_array($tagsList) && count($tagsList) ){
            foreach($tagsList as $item){
                $tags[]= $item->name;
            }
        }
        return implode(",",$tags);
    }
}
class TourHero {
    public $background = null;
    public $backgroundMobile = null;
    use ConceptualTool;
    function __construct($context, $data) {
        $this->background = $this->getImage($context, $data, 'hero');
        $this->backgroundMobile = $this->getImage($context, $data, 'hero-mobile');
    }
}

class TourOverview {
    public $isMapBox = null;
    public $markers = null;
    public $coordinates = null;
    public $image = null;

    use ConceptualTool;
    function __construct($context, $data) {
        // vomit($data);
        $this->isMapBox = arrayPath($data, 'isMapBox', false);
        $this->markers2 = arrayPath($data, 'markers', null);

        $markers = arrayPath($data, 'makerLocation', null);
        $path = arrayPath($data, 'path', null);
        $this->image = $this->getImage($context, arrayPath($data, 'image', null), 'full');
        $this->htmlText = arrayPath($data, 'htmlText', null);
        $this->overviewListing = arrayPath($data, 'overviewListing', null);

        $this->markers = array();
        if(!empty ($markers) && is_array($markers) && count($markers) ){
            foreach($markers as $item){
                $this->markers[] = array(
                    'day' => arrayPath($item, 'day', null),
                    'title' => arrayPath($item, 'title', null),
                    'description' => arrayPath($item, 'description', null),
                    'coordinates' => [ floatval(arrayPath($item, 'latitude', null)), floatval(arrayPath($item, 'longitude', null)) ]
                );
            }
        }

        $this->path = "[";
        if(!empty ($path) && is_array($path) && count($path) ){
            foreach($path as $key => $item){
                if($key == (count($path) - 1))
                    $this->path .= $item['coordinates'];
                else 
                    $this->path .= $item['coordinates']. ",";
                
            }
        }
        $this->path .= "]";
    }
}

class  TourDetail{
    public $tableDetail = null;
    use ConceptualTool;
    function __construct($context, $data) {
        $this->tableDetail = array();
        if(!empty ($data['tableDetail']) && is_array($data['tableDetail']) && count($data['tableDetail']) ){
            foreach($data['tableDetail'] as $item){
                $this->tableDetail[] = (object) array(
                    'heading' => arrayPath($item, 'heading', null),
                    'text' => arrayPath($item, 'text', null),
                );
            }
        }
    }
}

class TourItinerary {
    public $cta = null;
    public $itineraryItems = null;
    use ConceptualTool;
    function __construct($context, $data) {
        if (isset($data['cta']))
            $this->cta = new Link($context, $data['cta']);

        $this->itineraryItems = array();
        if(!empty ($data['itineraryItems']) && is_array($data['itineraryItems']) && count($data['itineraryItems']) ){
            foreach($data['itineraryItems'] as $item){
                $this->itineraryItems[] = (object) array(
                    'day' => arrayPath($item, 'day', null),
                    'title' => arrayPath($item, 'title', null),
                    'text' => arrayPath($item, 'text', null),
                );
            }
        }
    }
}

