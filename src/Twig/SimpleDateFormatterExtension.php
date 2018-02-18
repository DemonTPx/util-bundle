<?php

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Intl\SimpleDateFormatter;

/**
 * @copyright 2015 Bert Hekman
 */
class SimpleDateFormatterExtension extends \Twig_Extension
{
    /** @var SimpleDateFormatter */
    private $formatter;

    /** @var int[] */
    private static $typeMap = [
        'full' => SimpleDateFormatter::FULL,
        'long' => SimpleDateFormatter::LONG,
        'medium' => SimpleDateFormatter::MEDIUM,
        'short' => SimpleDateFormatter::SHORT,
        'none' => SimpleDateFormatter::NONE,
    ];

    public function __construct(SimpleDateFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function getFilters()
    {
        return [
            new \Twig_Filter('intl_format', [$this->formatter, 'format']),
            new \Twig_Filter('intl_date', [$this, 'date']),
            new \Twig_Filter('intl_time', [$this, 'time']),
        ];
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     */
    public function date($dateTime, $type = SimpleDateFormatter::MEDIUM): string
    {
        return $this->formatter->date($dateTime, $this->toType($type));
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     */
    public function time($dateTime, $type = SimpleDateFormatter::MEDIUM): string
    {
        return $this->formatter->time($dateTime, $this->toType($type));
    }

    /**
     * @param int|string $type
     */
    private function toType($type): int
    {
        if (is_int($type)) {
            return $type;
        }

        if ( ! isset(self::$typeMap[$type])) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid type %s. Valid types: [%s]',
                $type,
                implode(', ', array_keys(self::$typeMap))
            ));
        }

        return self::$typeMap[$type];
    }
}
