<?php

namespace Stem\External\Twig\Extensions;

use Stem\Core\Context;

/**
 * Class EnqueueNode.
 */
class EnqueueNode extends \Twig_Node
{
    protected $context;
    protected $type;
    protected $resource;

    public function __construct(Context $context, $type, $resource, $lineno, $tag)
    {
        parent::__construct([], [], $lineno, $tag);

        $this->type = $type;
        $this->resource = $resource;
        $this->context = $context;
    }

    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);
    }
}
