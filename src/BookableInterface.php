<?php

/**
 * @version		  BookableInterface.php 2015-06-03 20:39:00 UTC zanardigit
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
     * @return  bool    true on success
     */
    public function book($begin, $end);

    /**
     * Remove the booking for the given period
     *
     * @return  bool    true on success
     */
    public function unbook($begin, $end);

    /**
     * Check if the object is booked in the given period
     *
     * @return  bool    true if it's booked
     */
    public function isBooked($begin, $end);
}
