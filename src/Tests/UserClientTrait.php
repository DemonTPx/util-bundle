<?php

namespace DemonTPx\UtilBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * UserClientTrait
 *
 * @package   DemonTPx\UtilBundle\Tests
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class UserWebTestCase extends WebTestCase
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
