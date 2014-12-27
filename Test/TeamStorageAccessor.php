<?php
namespace Axstrad\Component\WorkForce\Test;

use Axstrad\Component\WorkForce\Team\BaseTeam;


/**
 * Axstrad\Component\WorkForce\Test\TeamStorageAccessor
 */
class TeamStorageAccessor extends BaseTeam
{
    public static function getInternalStorage(BaseTeam $team)
    {
        return $team->workers;
    }

    public function canWork($task) {}
    public function work($task) {}
    public function createImmutable() {}
}
