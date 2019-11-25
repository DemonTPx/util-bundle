<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Test;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

/**
 * @copyright 2018 Bert Hekman
 */
trait UserClientTrait
{
    protected static function createClientForUser(
        string $username,
        array $options = [],
        array $server = ['HTTPS' => true]
    ): KernelBrowser
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
