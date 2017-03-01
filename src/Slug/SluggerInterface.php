<?php

namespace Demontpx\UtilBundle\Slug;

/**
 * Interface SluggerInterface
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
interface SluggerInterface
{
    /**
     * @param string|SluggableInterface $sluggable
     * @param string                    $separator
     *
     * @return string
     */
    public function slug($sluggable, string $separator = '-'): string;
}
