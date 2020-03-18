<?php

namespace ConceptualStudio\Traits\Components;

use Stem\Core\Context;
use Stem\Models\Page;
use ConceptualStudio\Models\ContentBlockContainer;
use ConceptualStudio\Models\Core\Link;


/**
 * Class Title
 * @package ConceptualStudio\Models\Core
 */
trait ConceptualTool
{
    public function getCTA(Context $context, $data = null) {
        if (isset($data))
            return new Link($context, $data);
        return (object) [
            'type' => 'none',
            'title' => '',
            'url' => '/',
        ];
    }
    public function getImage(Context $context, $data = null, $size = 'full') {
        if(is_array($data)) {
            $data = $data['ID'];
        }
        if (isset($data) && $data) {
            $imagePost = \WP_Post::get_instance($data);
            if ($imagePost)
                return $context->modelForPost($imagePost)->src($size);
        } 
        return wc_placeholder_img_src();
    }

    public function getImageAndCaption(Context $context, $data = null, $size = 'full') {
        $caption = null;
        $url = null;
        if(is_array($data)) {
            $caption = $data['caption'];
            $data = $data['ID'];
        }
        if (isset($data) && $data) {
            $imagePost = \WP_Post::get_instance($data);
            if ($imagePost)
                 $url = $context->modelForPost($imagePost)->src($size);
        } 
        return [
            'description' => $caption,
            'image' => $url
        ];
    }

    public function getTermSlugOrName($taxonomy = 'activity', $isSLug = "true") {
        $terms = get_the_terms($this->id, $taxonomy);
        if(!empty ($terms) && is_array($terms) && count($terms) ){
          foreach($terms as $item){
            switch($taxonomy) {
              case "activity": {
                $icon = get_field("icon", $item);
                if($icon) {
                  $image = $this->getImage($this->context, $icon, 'full');
                }else {
                  $image = '/app/themes/cs-indotrek-com/public/img/cycling.svg';
                }
                return ($isSLug)  ?  $item->slug : ['name' => $item->name, 'icon' => $image];
                break;
              }
              case "destination": {
                $term = cs_get_term_top_most_parent($item, "destination");
                return ($isSLug)  ?  $term->slug : $term->name;
              }
              default: 
                return ($isSLug)  ?  $item->slug : $item->name;
            }
          }
        }
        return "";
    }
}
