<?php

namespace Demontpx\UtilBundle\Slug;

/**
 * @copyright 2015 Bert Hekman
 */
interface SluggerInterface
{
    /**
     * @param string|SluggableInterface $sluggable
     */
    public function slug($sluggable, string $separator = '-'): string;
}
