<?php

/**
 * @version     Booking.php 2015-06-03 20:39:00 UTC zanardigit
 * @package     zanardigit/bookable
 * @author      zanardigit <f.abeni@gibilogic.com>
 * @authorUrl   http://www.yegods.it
 * @license     GNU/GPL v3 or later
 */
namespace Bookable;
class Booking
{

    /**
     *
     * @var \DateTime
     */
    private $begin;

    /**
     *
     * @var \DateTime
     */
    private $end;

    /**
     *
     * @param \DateTime $begin
     * @param \DateTime $end
     */
    public function __construct(\DateTime $begin, \DateTime $end)
    {
        if (empty($begin) || empty($end)) {
            return false;
        }

        $this->begin = $begin;
        $this->end = $end;
    }

    /**
     * Get begin of the booking period
     *
     * @return \DateTime
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Get end of the booking period
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Check if the booking is active in the given from / to period. It is
     * considered active if it overlaps even partially. If any of the two
     * parameters is empty, it is replaced with "now", so you can easily check
     * if the booking is active in this moment.
     *
     * @param \DateTime $from
     * @param \DateTime $to
     */
    public function isActive(\DateTime $from, \DateTime $to)
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
