<?php

namespace Demontpx\UtilBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

/**
 * @copyright 2014 Bert Hekman
 */
abstract class WebTestCase extends BaseWebTestCase
{
    use UserClientTrait;
    use RethrowControllerExceptionTrait;
    use ResetStateAfterTestTrait;
}
