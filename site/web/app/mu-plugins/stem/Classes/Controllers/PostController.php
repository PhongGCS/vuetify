<?php
/**
 * Created by PhpStorm.
 * User: jong
 * Date: 8/18/15
 * Time: 5:16 AM.
 */

namespace Stem\Controllers;

use Stem\Core\Context;
use Stem\Core\Response;
use Stem\Core\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public $post = null;

    public function __construct(Context $context, $template = null) {
        parent::__construct($context, $template);

        global $wp_query;

        if ($wp_query->post) {
            $this->post = $context->modelForPost($wp_query->post);
        }
    }

    public function getIndex(Request $request)
    {
        if ($this->template) {
            return new Response($this->template, ['post'=>$this->post]);
        }
    }
}
