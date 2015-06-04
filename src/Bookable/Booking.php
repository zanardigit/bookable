<?php

/**
 * @version     Booking.php 2015-06-04 21:22:00 UTC zanardigit
 * @package     zanardigit/bookable
 * @author      zanardigit <f.abeni@gibilogic.com>
 * @authorUrl   http://www.yegods.it
 * @license     GNU/GPL v3 or later
 */

namespace Bookable;

use Ramsey\Uuid\Uuid;

class Booking
{

    /**
     *
     * @var \DateTimeImmutable
     */
    private $begin;

    /**
     *
     * @var \DateTimeImmutable
     */
    private $end;

    /**
     *
     * @var string
     */
    private $uuid;

    /**
     *
     * @param \DateTimeImmutable $begin
     * @param \DateTimeImmutable $end
     */
    public function __construct(\DateTimeImmutable $begin, \DateTimeImmutable $end)
    {
        if (empty($begin) || empty($end)) {
            return false;
        }

        $this->begin = $begin;
        $this->end = $end;
        $this->uuid = Uuid::uuid4()->toString();
    }

    /**
     * Get begin of the booking period
     *
     * @return \DateTimeImmutable
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Get end of the booking period
     *
     * @return \DateTimeImmutable
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Get the UUID of the booking
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Check if the booking is active in the given from / to period. It is
     * considered active if it overlaps even partially. If any of the two
     * parameters is empty, it is replaced with "now", so you can easily check
     * if the booking is active in this moment.
     *
     * @param \DateTimeImmutable $from
     * @param \DateTimeImmutable $to
     */
    public function isActive(\DateTimeImmutable $from, \DateTimeImmutable $to)
    {
        $now = new \DateTimeImmutable();
        $from = $from ? : $now;
        $to = $to ? : $now;

        if ($this->end < $from) {
            return false;
        }

        if ($this->begin > $to) {
            return false;
        }

        return true;
    }

}
