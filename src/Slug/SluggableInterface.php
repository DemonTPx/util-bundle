<?php

namespace Demontpx\UtilBundle\Slug;

/**
 * Interface SluggableInterface
 *
 * @author    Bert Hekman <demontpx@gmail.com>
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
