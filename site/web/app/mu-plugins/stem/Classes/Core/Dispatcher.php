<?php

namespace Stem\Core;

use Stem\Controllers\ErrorController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Dispatcher Context.
 *
 * This class dispatches requests to the appropriate controller or template
 */
class Dispatcher
{
    private $context;

    /**
     * Constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param $templateName string|array
     * @param $pageType string
     * @return bool
     * @throws \Exception
     */
    private function dispatchTemplate($templateName, $pageType)
    {
        if (is_array($templateName)) {
            foreach ($templateName as $name) {
                if ($this->dispatchTemplate($name, $pageType)) {
                    return true;
                }
            }
        } else {
            Log::debug("Looking for template '$templateName' for page type '$pageType'.", ['templateName'=> $templateName, 'pageType' => $pageType]);

            $templateName = strtolower($templateName);

            // normalize the name, eg front_page becomes front-page
            $name = preg_replace('|[^a-z0-9_]+|', '-', $templateName);

            // camel case the the controller class name, eg front_page becomes FrontPage
            $nameparts = explode('-', $name);
            array_walk($nameparts, function (&$value, $index) {
                $value = ucfirst($value);
            });
            $classname = implode('', $nameparts);

            if (is_numeric($classname)) {
                $classname = 'Error'.$classname;
            }

            // Interpolate the class name
            $class = $this->context->namespace.'\\Controllers\\'.$classname.'Controller';

            Log::debug('Looking for class.', ['class' => $class]);

            // Determine the action and controller method
            $action = ($this->context->request->query->has('_action')) ? ucfirst($this->context->request->query->get('_action')) : 'Index';
            $method = strtolower($this->context->request->getMethod()).$action;

            $controller = null;

            // If the controller exists, create it ...
            if (class_exists($class)) {
                $controller = new $class($this->context);
            } else {
                Log::debug('Trying to mapping controller for class.', ['name' => $name]);
                $controller = $this->context->mapController($name);

                // Otherwise, we check to see if the template exists.
                if (! $controller) {
                    if ($this->context->ui->viewExists('templates/'.$name)) {
                        if ($pageType == 'none') {
                            Log::debug('Found template.', ['templateName' => $templateName]);

                            $this->context->cacheControl->sendHTTPHeaders();

                            // Template exists but page type doesn't map to a built-in
                            // controller, so we just render the template as is.
                            echo $this->context->ui->render('templates/'.$name, [$this->context]);

                            return true;
                        }

                        $controller = $this->context->createController($pageType, $name);
                    }
                }
            }

            // if we found a controller, then invoke the method and return it's output
            if (! empty($controller)) {
                Log::debug('Found controller.', ['templateName' => $templateName, 'controller' => get_class($controller)]);

                if (method_exists($controller, $method)) {
                    $response = call_user_func([$controller, $method], $this->context->request);
                } else {
                    // Try GET if method was something other ...
                    $method = 'get'.$action;
                    if (method_exists($controller, $method)) {
                        $response = call_user_func([$controller, $method], $this->context->request);
                    } else {
                        throw new \Exception("Missing method '$method' on class '$class'.");
                    }
                }

                if (is_object($response) && ($response instanceof Response)) {
                    $this->context->cacheControl->addResponseHeaders($response);
                    $response->send();
                } elseif (is_string($response)) {
                    $this->context->cacheControl->sendHTTPHeaders();
                    echo $response;
                }

                return true;
            } else {
                Log::debug('Controller not found.', ['templateName' => $templateName]);
            }

            return false;
        }

        return false;
    }

    private function dispatchPostTypeArchiveTemplate()
    {
        $post_type = get_query_var('post_type');
        if (is_array($post_type)) {
            $post_type = reset($post_type);
        }

        $obj = get_post_type_object($post_type);
        if (! $obj->has_archive) {
            return false;
        }

        $post_types = array_filter((array) get_query_var('post_type'));

        $templates = [];
        if (count($post_types) == 1) {
            $post_type = reset($post_types);
            $templates[] = "archive-{$post_type}";
        }

        $templates[] = 'archive';

        return $this->dispatchTemplate($templates, 'posts');
    }

    private function dispatchAttachmentTemplate()
    {
        global $posts;

        $templates = [];
        if (! empty($posts) && isset($posts[0]->post_mime_type)) {
            $type = explode('/', $posts[0]->post_mime_type);

            if (! empty($type)) {
                $templates[] = "attachment-$type[0]";
                if (! empty($type[1])) {
                    $templates[] = "attachment-$type[1]";
                    $templates[] = "attachment-$type[0]-$type[1]";
                }
            }
        }

        $templates[] = 'attachment';

        return $this->dispatchTemplate($templates, 'post');
    }

    private function dispatchSingleTemplate()
    {
        $object = get_queried_object();

        $templates = [];

        if (! empty($object->post_type)) {
            $templates[] = "single-{$object->post_type}";
        }

        $templates[] = 'single';
        $templates[] = "{$object->post_type}";

        return $this->dispatchTemplate($templates, 'post');
    }

    private function dispatchPageTemplate()
    {
        $id = get_queried_object_id();
        $template = get_page_template_slug();
        $pagename = get_query_var('pagename');

        if (! $pagename && $id) {
            // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
            $post = get_queried_object();
            if ($post) {
                $pagename = $post->post_name;
            }
        }

        $templates = [];
        if ($template) {
            $templates[] = str_replace('.php', '', $template);
        }
        if ($pagename) {
            $templates[] = "page-$pagename";
        }
        if ($id) {
            $templates[] = "page-$id";
        }
        $templates[] = 'page';

        return $this->dispatchTemplate($templates, 'page');
    }

    private function dispatchTaxonomyTemplate()
    {
        $term = get_queried_object();

        $templates = [];

        if (! empty($term->slug)) {
            $taxonomy = $term->taxonomy;
            $templates[] = "taxonomy-$taxonomy-{$term->slug}";
            $templates[] = "taxonomy-$taxonomy";
        }

        $templates[] = 'taxonomy';

        return $this->dispatchTemplate($templates, 'posts');
    }

    private function dispatchTermTemplate($termType)
    {
        $object = get_queried_object();

        $templates = [];

        if (! empty($object->slug)) {
            $templates[] = "$termType-{$object->slug}";
            $templates[] = "$termType-{$object->term_id}";
        }
        $templates[] = $termType;
        $templates[] = 'term';

        return $this->dispatchTemplate($templates, 'term');
    }

    private function dispatchAuthorTemplate()
    {
        $author = get_queried_object();

        $templates = [];

        if ($author instanceof WP_User) {
            $templates[] = "author-{$author->user_nicename}";
            $templates[] = "author-{$author->ID}";
        }
        $templates[] = 'author';

        return $this->dispatchTemplate($templates, 'posts');
    }

    private function dispatchArchiveTemplate()
    {
        $post_types = array_filter((array) get_query_var('post_type'));

        $templates = [];

        if (count($post_types) == 1) {
            $post_type = reset($post_types);
            $templates[] = "archive-{$post_type}";
        }

        $templates[] = 'archive';

        return $this->dispatchTemplate($templates, 'posts');
    }

    /**
     * Dispatches the current exception.
     * @throws \Exception
     */
    public function dispatch()
    {
        global $wp_query;

        if (! isset($wp_query)) {
            _doing_it_wrong(__FUNCTION__, __('Conditional query tags do not work before the query is run. Before then, they always return false.'), '3.1');

            return;
        }

        if ($wp_query->is_404()) {
            ErrorController::setCurrentError(404);
        }

        if ($wp_query->is_404() && $this->dispatchTemplate(['404', 'error'], 'none')):
        elseif ($wp_query->is_search() && $this->dispatchTemplate('search', 'search')):
        elseif ($wp_query->is_front_page() && $this->dispatchTemplate('front-page', 'posts')):
        elseif ($wp_query->is_home() && $this->dispatchTemplate(['home', 'index'], 'posts')):
        elseif ($wp_query->is_posts_page && $this->dispatchTemplate('posts', 'posts')):
        elseif ($wp_query->is_post_type_archive() && $this->dispatchPostTypeArchiveTemplate()):
        elseif ($wp_query->is_tax() && $this->dispatchTaxonomyTemplate()):
        elseif ($wp_query->is_attachment() && $this->dispatchAttachmentTemplate()):
        elseif ($wp_query->is_single() && $this->dispatchSingleTemplate()):
        elseif ($wp_query->is_page() && $this->dispatchPageTemplate()):
        elseif ($wp_query->is_category() && $this->dispatchTermTemplate('category')):
        elseif ($wp_query->is_tag() && $this->dispatchTermTemplate('tag')):
        elseif ($wp_query->is_author() && $this->dispatchAuthorTemplate()):
        elseif ($wp_query->is_date() && $this->dispatchTemplate('date', 'posts')):
        elseif ($wp_query->is_archive() && $this->dispatchArchiveTemplate()):
        elseif ($wp_query->is_paged() && $this->dispatchTemplate('paged', 'posts')):
        else :
            $this->dispatchTemplate('index', 'posts');
        endif;
    }

    public function dispatchError($statusCode, $exception)
    {
        ErrorController::setCurrentError($statusCode, $exception);
        $this->dispatchTemplate([$statusCode, 'error'], 'none');
    }
}
