<?php

/**
 * @version		  BookableInterface.php 2015-06-04 21:51:00 UTC zanardigit
 * @package		  zanardigit/bookable
 * @author      zanardigit <f.abeni@gibilogic.com>
 * @authorUrl   http://www.yegods.it
 * @license		  GNU/GPL v3 or later
 */
interface BookableInterface
{

    /**
     * Create a new bookable object
     *
     * @param mixed $item
     */
    public function __construct($item);

    /**
     * Create a new booking for the given period
     *
     * @param   \DateTimeImmutable  $begin  The begin date of the booking
     * @param   \DateTimeImmutable  $end    The end date of the booking
     * @return  bool                True on success
     */
    public function book(\DateTimeImmutable $begin, \DateTimeImmutable $end);

    /**
     * Remove the booking for the given period
     *
     * @param   \DateTimeImmutable  $begin  The begin date of the booking
     * @param   \DateTimeImmutable  $end    The end date of the booking
     * @return  bool                        True on success
     */
    public function unbook($uuid, \DateTimeImmutable $begin, \DateTimeImmutable $end);

    /**
     * Check if the object is booked in the given period
     *
     * @param   \DateTimeImmutable  $begin  The begin date of the booking
     * @param   \DateTimeImmutable  $end    The end date of the booking
     * @return  bool                        True if it's booked
     */
    public function isBooked(\DateTimeImmutable $begin, \DateTimeImmutable $end);
}
