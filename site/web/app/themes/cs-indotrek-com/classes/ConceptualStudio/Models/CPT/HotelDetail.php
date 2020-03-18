<?php
namespace ConceptualStudio\Models\CPT;

use Stem\Models\Post;
use Stem\Core\Context;
use ConceptualStudio\Models\CPT\Hotel;
use ConceptualStudio\Traits\Content\Excerpt;
use ConceptualStudio\Models\Core\PhotosGallery;



class HotelDetail extends Hotel {
    public $noteLiting = null;
    public $overview = null;
    /**
     * __construct
     *
     * @param  Context $context
     * @param  \WP_Post $post
     *
     * @return void
     */
    public function __construct(Context $context, \WP_Post $post){
        parent::__construct($context, $post);

        $this->overview = arrayPath($this->data, 'overview', null);
        $this->noteLiting = arrayPath($this->data, 'noteLiting', null);
        $this->photosGallery = new  PhotosGallery($context, arrayPath($this->data, 'photosGallery', null));
    }

    function getHeroImage() {
        $heroImage = arrayPath($this->data, 'heroImage', null);
        if(empty($heroImage)) {
          return wc_placeholder_img_src();
        }
        return $this->getImage($this->context, $heroImage, 'tour-thumbnail ');
    }

}