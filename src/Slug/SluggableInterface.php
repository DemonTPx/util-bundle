<?php

namespace Demontpx\UtilBundle\Slug;

/**
 * @copyright 2015 Bert Hekman
 */
interface SluggableInterface
{
    public function getSlugId(): int;

    /**
     * Returns the slug parts as string or array of strings
     *
     * @return string|string[]
     */
    public function getSlugParts();
}
