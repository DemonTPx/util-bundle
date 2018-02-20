<?php

namespace Demontpx\UtilBundle\Test;

use Symfony\Bundle\FrameworkBundle\Client;

/**
 * @copyright 2018 Bert Hekman
 */
trait UserClientTrait
{
    protected static function createClientForUser(
        string $username,
        array $options = [],
        array $server = ['HTTPS' => true]
    ): Client
    {
        return static::createClient(
            $options,
            array_merge($server, [
                'PHP_AUTH_USER' => $username,
                'PHP_AUTH_PW' => $username,
            ])
        );
    }

}
