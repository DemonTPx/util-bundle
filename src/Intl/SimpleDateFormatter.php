<?php

namespace Demontpx\UtilBundle\Intl;

/**
 * Class SimpleDateFormatter
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class SimpleDateFormatter
{
    const NONE = \IntlDateFormatter::NONE;
    const FULL = \IntlDateFormatter::FULL;
    const LONG = \IntlDateFormatter::LONG;
    const MEDIUM = \IntlDateFormatter::MEDIUM;
    const SHORT = \IntlDateFormatter::SHORT;

    /** @var string */
    private $locale;

    /**
     * @param string $locale
     */
    public function __construct($locale = null)
    {
        $this->locale = $locale ?: locale_get_default();
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     * @param string                        $pattern
     *
     * @return string
     */
    public function format($dateTime, $pattern)
    {
        $dateTime = $this->toDateTime($dateTime);
        $formatter = $this->createFormatter($dateTime, self::NONE, self::NONE, $pattern);

        return $formatter->format($dateTime);
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     * @param int                           $type
     *
     * @return string
     */
    public function date($dateTime, $type = self::MEDIUM)
    {
        $dateTime = $this->toDateTime($dateTime);
        $formatter = $this->createFormatter($dateTime, $type);

        return $formatter->format($dateTime);
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     * @param int                           $type
     *
     * @return string
     */
    public function time($dateTime, $type = self::MEDIUM)
    {
        $dateTime = $this->toDateTime($dateTime);
        $formatter = $this->createFormatter($dateTime, self::NONE, $type);

        return $formatter->format($dateTime);
    }

    /**
     * @param \DateTimeInterface $dateTime
     * @param int                $dateType
     * @param int                $timeType
     * @param string             $pattern
     *
     * @return \IntlDateFormatter
     */
    private function createFormatter($dateTime, $dateType = self::NONE, $timeType = self::NONE, $pattern = null)
    {
        return new \IntlDateFormatter($this->locale, $dateType, $timeType, $dateTime->getTimezone(), \IntlDateFormatter::GREGORIAN, $pattern);
    }

    /**
     * @param mixed $dateTime
     *
     * @return \DateTimeInterface
     */
    private function toDateTime($dateTime)
    {
        if ($dateTime instanceof \DateTimeInterface) {
            return $dateTime;
        }

        if (is_int($dateTime) || is_string($dateTime)) {
            return new \DateTime($dateTime);
        }

        throw new \InvalidArgumentException('$dateTime argument must be int, string or inherit \DateTimeInterface');
    }
}
