<?php

namespace DemonTPx\UtilBundle\Test;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * UserWebTestCase
 *
 * @package   DemonTPx\UtilBundle\Test
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
abstract class UserWebTestCase extends WebTestCase
{
    /**
     * Create a client for a user
     *
     * @param string $username
     * @param array  $options
     * @param array  $server
     *
     * @return Client
     */
    protected static function createClientForUser($username, array $options = array(), array $server = array())
    {
        return static::createClient($options, array_merge($server, array(
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW'   => $username,
        )));
    }
}
