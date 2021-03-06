<?php declare(strict_types=1);

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
