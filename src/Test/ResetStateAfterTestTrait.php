<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Test;

/**
 * @copyright 2018 Bert Hekman
 */
trait ResetStateAfterTestTrait
{
    protected function tearDown(): void
    {
        parent::tearDown();
        PhpUnitBootstrapper::getInstance()->restoreDatabase();
    }
}
