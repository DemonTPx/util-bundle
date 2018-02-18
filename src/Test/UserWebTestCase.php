<?php

namespace Demontpx\UtilBundle\Test;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @copyright 2014 Bert Hekman
 */
abstract class UserWebTestCase extends WebTestCase
{
    protected static function createClientForUser(
        string $username,
        array $options = [],
        array $server = []
    ): Client
    {
        return static::createClient($options, array_merge($server, [
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW' => $username,
        ]));
    }
}
