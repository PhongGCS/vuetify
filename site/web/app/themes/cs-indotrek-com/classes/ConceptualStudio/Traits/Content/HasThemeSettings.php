<?php

namespace ConceptualStudio\Traits\Content;

use Stem\Core\Context;
use Stem\Models\Page;
use ConceptualStudio\Models\ContentBlockContainer;

/**
 * Class HasThemeSettings
 *
 * Trait for content that has an option page.
 *
 * @package ConceptualStudio\Traits\Content
 */
trait HasThemeSettings {

    public $themeSettings = null;

    /**
     * Builds the options for the page.
     *
     * @param Context $context
     * @param Page $page
     */
    public function buildThemeSettings(Context $context) {
        $this->themeSettings = new \ConceptualStudio\Models\Core\ThemeSettings($context, null);
    }
}