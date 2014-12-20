<?php
namespace Axstrad\Component\WorkForce\Worker;

use Axstrad\Component\WorkForce\Worker;


/**
 * Axstrad\Component\WorkForce\Worker\WorksAnythingTrait
 */
trait WorksAnythingTrait
{
    /**
     */
    public function canWork($task)
    {
        return true;
    }
}
