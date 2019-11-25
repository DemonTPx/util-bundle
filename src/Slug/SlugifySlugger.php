<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Slug;

use Cocur\Slugify\Slugify;

/**
 * @copyright 2015 Bert Hekman
 */
class SlugifySlugger extends AbstractSlugger
{
    /** @var Slugify */
    private $slugify;

    public function __construct(?Slugify $slugify = null)
    {
        $this->slugify = $slugify ?: new Slugify();
    }

    public function doSlug(string $text, string $separator = '-'): string
    {
        return $this->slugify->slugify($text, $separator);
    }
}
