<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster <dev@dankempster.co.uk>
 */

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
