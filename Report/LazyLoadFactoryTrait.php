<?php
namespace Axstrad\Component\WorkForce\Report;


/**
 * Axstrad\Component\WorkForce\Report\LazyLoadFactoryTrait
 */
trait LazyLoadFactoryTrait
{
    /**
     * @var Factory
     */
    protected $factory = null;


    /**
     * Get factory
     *
     * Creates a Factory if one isn't defined.
     *
     * @return Factory
     * @see setFactory
     */
    public function getFactory()
    {
        return $this->factory ?: $this->factory = new Factory;
    }

    /**
     * Set factory
     *
     * @param Factory $factory
     * @return self
     * @see getFactory
     */
    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;

        return $this;
    }
}
