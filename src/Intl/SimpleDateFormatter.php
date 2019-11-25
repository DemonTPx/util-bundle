<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Intl;

/**
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

    public function __construct(?string $locale = null)
    {
        $this->locale = $locale ?: locale_get_default();
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     */
    public function format($dateTime, string $pattern): string
    {
        $dateTime = $this->toDateTime($dateTime);
        $formatter = $this->createFormatter($dateTime, self::NONE, self::NONE, $pattern);

        return $formatter->format($dateTime);
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     */
    public function date($dateTime, int $type = self::MEDIUM): string
    {
        $dateTime = $this->toDateTime($dateTime);
        $formatter = $this->createFormatter($dateTime, $type);

        return $formatter->format($dateTime);
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     */
    public function time($dateTime, int $type = self::MEDIUM): string
    {
        $dateTime = $this->toDateTime($dateTime);
        $formatter = $this->createFormatter($dateTime, self::NONE, $type);

        return $formatter->format($dateTime);
    }

    private function createFormatter(
        \DateTimeInterface $dateTime,
        int $dateType = self::NONE,
        int $timeType = self::NONE,
        string $pattern = ''
    ): \IntlDateFormatter
    {
        return new \IntlDateFormatter(
            $this->locale,
            $dateType,
            $timeType,
            $dateTime->getTimezone(),
            \IntlDateFormatter::GREGORIAN,
            $pattern
        );
    }

    /**
     * @param \DateTimeInterface|int|string $dateTime
     */
    private function toDateTime($dateTime): \DateTimeInterface
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
