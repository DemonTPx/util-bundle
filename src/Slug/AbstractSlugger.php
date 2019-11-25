<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Slug;

/**
 * @copyright 2015 Bert Hekman
 */
abstract class AbstractSlugger implements SluggerInterface
{
    public function slug($sluggable, string $separator = '-'): string
    {
        return $this->doSlug($this->toText($sluggable), $separator);
    }

    /**
     * @param string|SluggableInterface $sluggable
     */
    protected function toText($sluggable): string
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

    abstract protected function doSlug(string $text, string $separator): string;
}
