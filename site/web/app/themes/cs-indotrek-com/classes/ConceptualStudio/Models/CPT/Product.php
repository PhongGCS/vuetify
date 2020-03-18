<?php
namespace ConceptualStudio\Models\CPT;

use ConceptualStudio\Traits\Content\Excerpt;
use Stem\Core\Context;
use Stem\Models\Post;
use ConceptualStudio\Traits\Components\ConceptualTool;


/**
 * Class BlogPost
 * @package ConceptualStudio\Models\CPT
 */
class Product extends Post {
    public $title = null;
    public $image = null; 
    public $date = null;
    public $link = null;
    public $destinationType = null;
    public $destination = null;
    public $durationType = null;
    public $duration = null;
    public $categoryType = null;
    public $type = null;
    public $activityType = null;
    public $activity = null;
    public $priceHtml = null;
    public $description = null;

  use ConceptualTool;


    public function __construct(Context $context, \WP_Post $post){
        parent::__construct($context, $post);
        $this->product = wc_get_product($this->id);
        $this->description = get_field("description", $post);
        $this->isPublic = get_field("isPublic", $this->id);
        $this->data = get_fields($this->id);
        $this->title = $post->post_title;
        $this->link = get_permalink($this->id);
        $this->date = get_the_date("F j Y", $this->id);
    }

    public function getDataForList() {
      return [
        "title" => $this->title,
        "image" => $this->getThumbnail(),
        "link" => $this->link,
        "destination" => $this->getDestinationSlug(),
        "destinationTitle" => $this->getDestination(),
        "duration" => $this->getDurationSlug(),  // this is category Duration Day
        "durationTitle" => $this->getDuration(),
        "category-type" => $this->getCategorySlug(),
        "categoryTitle" => $this->getCategory(),
        "activity" => $this->getActivitySlug(),   // this is category Activity
        "activityTitle" => $this->getActivity(),
        "priceHtml" => $this->getPriceHtml(),
      ];
    }
    public function getThumbnail() {
      $thumbnail = get_post_thumbnail_id($this->id);
      if(empty($thumbnail)) {
        return wc_placeholder_img_src();
      }
      return $this->getImage($this->context, $thumbnail, 'tour-thumbnail ');
    }

    public function getDestinationSlug() {
      return $this->getTermSlugOrName("destination");
    }
    public function getDestination() {
      return $this->getTermSlugOrName("destination", false);
    }

    public function getDurationSlug() {
      return $this->getTermSlugOrName("duration");
    }

    public function getDuration() {
      return $this->getTermSlugOrName("duration", false);
    }

    public function getCategorySlug() {
      // return $this->getTermSlugOrName("category-type");
     return get_field("isPublic", $this->id) ? "public": "private";
    }

    public function getCategory() {
      return $this->getTermSlugOrName("category-type", false);
    }

    public function getActivitySlug() {
      return $this->getTermSlugOrName("activity");
    }

    public function getActivity() {
      return $this->getTermSlugOrName("activity", false);
    }

    public function getPriceHtml() {
      
      return $this->product->get_price_html();
    }

}