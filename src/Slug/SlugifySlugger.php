<?php

namespace Demontpx\UtilBundle\Slug;

use Cocur\Slugify\Slugify;

/**
 * Class SlugifySlugger
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class SlugifySlugger extends AbstractSlugger
{
    /** @var Slugify */
    private $slugify;

    /**
     * @param Slugify $slugify
     */
    public function __construct(Slugify $slugify = null)
    {
        $this->slugify = $slugify ?: new Slugify();
    }

    public function doSlug($text, $separator = '-')
    {
        return $this->slugify->slugify($text, $separator);
    }
}
