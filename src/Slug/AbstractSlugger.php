<?php

namespace Demontpx\UtilBundle\Slug;

/**
 * Class AbstractSlugger
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
abstract class AbstractSlugger implements SluggerInterface
{
    public function slug($sluggable, $separator = '-')
    {
        return $this->doSlug($this->toText($sluggable), $separator);
    }

    /**
     * @param string|SluggableInterface $sluggable
     *
     * @return string
     */
    protected function toText($sluggable)
    {
        if ( ! $sluggable instanceof SluggableInterface) {
            return (string) $sluggable;
        }

        $text = $sluggable->getSlugParts();

        if (is_array($text)) {
            $text = implode(' ', $text);
        }

        return $text;
    }

    /**
     * @param string $text
     * @param string $separator
     *
     * @return string
     */
    abstract protected function doSlug($text, $separator);
}
