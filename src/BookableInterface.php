<?php

/**
 * @version		  BookableInterface.php 2015-06-02 18:41:00 UTC zanardigit
 * @package		  zanardigit/bookable
 * @author      zanardigit <f.abeni@gibilogic.com>
 * @authorUrl   http://www.yegods.it
 * @license		  GNU/GPL v3 or later
 */
interface BookableInterface
{

    /**
     * Book the object
     *
     * @return  bool    true on success
     */
    public function book();

    /**
     * Unbook the object
     *
     * @return  bool    true on success
     */
    public function unbook();

    /**
     * Check if the object is booked
     *
     * @return  bool    true if it's booked
     */
    public function isBooked();
}
