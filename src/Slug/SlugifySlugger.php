<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Slug;

use Cocur\Slugify\Slugify;
use Cocur\Slugify\SlugifyInterface;

/**
 * @copyright 2015 Bert Hekman
 */
class SlugifySlugger extends AbstractSlugger
{
    private SlugifyInterface $slugify;

    public function __construct(?SlugifyInterface $slugify = null)
    {
        $this->slugify = $slugify ?: new Slugify();
    }

    public function doSlug(string $text, string $separator = '-'): string
    {
        return $this->slugify->slugify($text, $separator);
    }
}
