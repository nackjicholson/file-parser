<?php

namespace Nack\FileParser\Strategy;

abstract class AbstractStrategy implements StrategyInterface
{
    /** @var array Hash of configuration options for this strategy. */
    protected $options = [];

    /**
     * Sets the class' options by merging the default and passed options, such that
     * passed options will override defaults if there is overlap.
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }
}
