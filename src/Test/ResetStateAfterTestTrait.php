<?php

namespace Demontpx\UtilBundle\Test;

/**
 * @copyright 2018 Bert Hekman
 */
trait ResetStateAfterTestTrait
{
    protected function tearDown()
    {
        parent::tearDown();
        PhpUnitBootstrapper::getInstance()->restoreDatabase();
    }
}
