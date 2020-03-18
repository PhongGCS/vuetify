<?php

namespace ConceptualStudio\Traits\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use ConceptualStudio\Models\ContentBlockContainer;

/**
 * Class HasHero
 *
 * Trait for content that has a hero.
 *
 * @package ConceptualStudio\Traits\Content
 */
trait HasHero {

    public $hero = null;

    /**
     * Builds the hero for the page.
     *
     * @param Context $context
     * @param Page $page
     */
    public function buildHero(Context $context, Page $page) {
        $heroSliderData = get_field("page_hero_slider", $page->id());
        $heroData = get_field("page_hero", $page->id());

        if ($heroSliderData)
            $this->hero = new \ConceptualStudio\Models\Core\PageHeroSlider($context, $heroSliderData, null, $page);

        else
            $this->hero = new \ConceptualStudio\Models\Core\PageHero($context, $heroData, null, $page);


    }
}