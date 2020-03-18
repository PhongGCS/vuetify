<?php
namespace ConceptualStudio\Traits\Content;

trait HasPageScripts {
    public function queueScripts($pageId) {        
        $scripts = get_field('scripts', $pageId);
        if (is_array($scripts)) {
            foreach($scripts as $scriptData) {
                $id = uniqid('script_');
                $script = arrayPath($scriptData, 'script', null);
                add_action('wp_footer', function() use ($script) {
                    echo "{$script}";
                });
            }
        }

        $styles = get_field('styles', $pageId);
        if (is_array($styles)) {
            foreach($styles as $styleData) {
                $id = uniqid('style');
                $style = arrayPath($styleData, 'style', null);
                add_action('wp_footer', function() use ($style) {
                    echo "{$style}";
                });
            }
        }
        $scripts = get_field('scripts', "option");
        if (is_array($scripts)) {
            foreach($scripts as $scriptData) {
                $id = uniqid('script_');
                $script = arrayPath($scriptData, 'script', null);
                add_action('wp_head', function() use ($script) {
                    echo "{$script}";
                });
            }
        }

        $styles = get_field('styles', "option");
        if (is_array($styles)) {
            foreach($styles as $styleData) {
                $id = uniqid('style');
                $style = arrayPath($styleData, 'style', null);
                add_action('wp_head', function() use ($style) {
                    echo "{$style}";
                });
            }
        }
        

    }
}