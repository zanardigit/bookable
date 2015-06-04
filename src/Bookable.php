<?php

/**
 * @version     Bookable.php 2015-06-03 20:39:00 UTC zanardigit
 * @package     zanardigit/bookable
 * @author      zanardigit <f.abeni@gibilogic.com>
 * @authorUrl   http://www.yegods.it
 * @license     GNU/GPL v3 or later
 */
use Bookable\Booking;
use Ramsey\Uuid\Uuid;

class Bookable implements BookableInterface
{

    /**
     * Bookings assigned to this object
     *
     * @var array
     */
    private $bookings = array();

    /**
     * Wrapped item
     *
     * @var mixed $item
     */
    private $item;

    /**
     * UUID
     *
     * @var string $id
     */
    private $uuid;

    /**
     *
     * @param mixed $item
     */
    public function __construct($item)
    {
        $this->item = $item;
        $this->uuid = Uuid::uuid4();
    }

    /**
     * Create a new booking for the object
     *
     * @return  bool    true on success
     */
    public function book($begin, $end)
    {
        if (empty($begin) || empty($end)) {
            return false;
        }

        if ($this->isBooked($begin, $end)) {
            return false;
        }
        $this->bookings[] = new Booking($begin, $end);

        return $this->store();
    }

    /**
     * Remove a booking from the object
     *
     * @return  bool    true on success
     */
    public function unbook($begin, $end)
    {
        if (!$this->isBooked($begin, $end)) {
            return false;
        }
        foreach ($this->bookings as $key => $booking) {
            if (($booking->getBegin() == $begin) && ($booking->getEnd() == $end)) {
                unset($this->bookings[$key]);
                break;
            }
        }


        return $this->store();
    }

    /**
     * Check if the object is booked for the given start / end
     *
     * @return  bool    true if it's booked
     */
    public function isBooked($begin, $end)
    {
        foreach ($this->bookings as $booking) {
            if ($booking->isActive($begin, $end)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return the bookings collection
     *
     * @return  array
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * Return the wrapped item
     *
     * @return  mixed
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Return the UUID
     *
     * @return  string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Not implemented yet
     *
     * @return boolean
     */
    public function store()
    {
        return true;
    }

}
