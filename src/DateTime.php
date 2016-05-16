<?php

namespace Pauci\DateTime;

use DateTimeZone;

class DateTime extends \DateTime implements DateTimeInterface
{
    /**
     * @var string
     */
    private static $format = 'Y-m-d\TH:i:s.uP';

    /**
     * @var DateTimeFactoryInterface
     */
    private static $factory;

    /**
     * @return DateTimeFactoryInterface
     */
    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new DateTimeFactory();
        }
        return self::$factory;
    }

    /**
     * @param DateTimeFactoryInterface $factory
     */
    public static function setFactory(DateTimeFactoryInterface $factory)
    {
        self::$factory = $factory;
    }

    /**
     * @return DateTime
     */
    public static function now()
    {
        return self::getFactory()->now();
    }

    /**
     * @return DateTime
     */
    public static function microsecondsNow()
    {
        return self::getFactory()->microsecondsNow();
    }

    /**
     * @param string $time
     * @param DateTimeZone|null $timezone
     * @return DateTime
     */
    public static function fromString($time, DateTimeZone $timezone = null)
    {
        return self::getFactory()->fromString($time, $timezone);
    }

    /**
     * @param string $format
     * @param string $time
     * @param DateTimeZone|null $timezone
     * @return DateTime
     */
    public static function fromFormat($format, $time, DateTimeZone $timezone = null)
    {
        return self::getFactory()->fromFormat($format, $time, $timezone);
    }

    /**
     * @param string $format
     * @param string $time
     * @param DateTimeZone|null $timezone
     * @return DateTime
     */
    public static function createFromFormat($format, $time, $timezone = null)
    {
        return self::fromFormat($format, $time, $timezone);
    }

    /**
     * @param \DateTimeInterface $dateTime
     * @return DateTime
     */
    public static function fromDateTime(\DateTimeInterface $dateTime)
    {
        return self::getFactory()->fromDateTime($dateTime);
    }

    /**
     * @param \DateTimeInterface $dateTime
     * @param bool $absolute
     * @return DateInterval
     */
    public function diff($dateTime, $absolute = false)
    {
        $interval = parent::diff($dateTime, $absolute);
        return DateInterval::fromDateInterval($interval);
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->format(self::$format);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->toString();
    }
}