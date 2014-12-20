<?php
namespace Axstrad\Component\WorkForce\Worker;

use Axstrad\Component\WorkForce\Worker;


/**
 * Axstrad\Component\WorkForce\Worker\CatchAll
 */
abstract class CatchAll implements
    Worker
{
    use WorksAnythingTrait;


    /**
     */
    public abstract function process($task);
}
