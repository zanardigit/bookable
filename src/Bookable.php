<?php

/**
 * @version		  Bookable.php 2015-06-02 18:41:00 UTC zanardigit
 * @package		  zanardigit/bookable
 * @author      zanardigit <f.abeni@gibilogic.com>
 * @authorUrl   http://www.yegods.it
 * @license		  GNU/GPL v3 or later
 */
class Bookable implements BookableInterface
{
    /**
     *
     * @var bool
     */
    private $booked = false;

    /**
     *
     * @param mixed $item
     */
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Book the object
     *
     * @return  bool    true on success
     */
    public function book()
    {
        $this->booked = true;

        return $this->store();
    }

    /**
     * Unbook the object
     *
     * @return  bool    true on success
     */
    public function unbook()
    {
        $this->booked = false;

        return $this->store();
    }

    /**
     * Check if the object is booked
     *
     * @return  bool    true if it's booked
     */
    public function isBooked()
    {
        return $this->booked;
    }

    /**
     * Not implemented yet
     *
     * @return boolean
     */
    private function store()
    {
        return true;
    }
}
