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
     * @param   mixed   $item
     */
    public function __construct($item)
    {
        $this->item = $item;
        $this->uuid = Uuid::uuid4()->toString();
    }

    /**
     * Create a new booking for the object
     *
     * @param   \DateTimeImmutable  $begin  The begin date of the booking
     * @param   \DateTimeImmutable  $end    The end date of the booking
     * @return  bool                        True on success
     */
    public function book(\DateTimeImmutable$begin, \DateTimeImmutable $end)
    {
        if (empty($begin) || empty($end)) {
            return false;
        }

        if ($this->isBooked($begin, $end)) {
            return false;
        }
        $booking = new Booking($begin, $end);
        $this->bookings[$booking->getUuid()] = $booking;

        return $this->store();
    }

    /**
     * Remove a booking from the object
     *
     * @param   string              $uuid   The UUID of the booking
     * @param   \DateTimeImmutable  $begin  The begin date of the booking
     * @param   \DateTimeImmutable  $end    The end date of the booking
     * @return  bool                        True on success
     */
    public function unbook($uuid, \DateTimeImmutable $begin = null, \DateTimeImmutable $end = null)
    {
        if(!empty($uuid)) {
            return $this->unbookByUuid($uuid);
        }

        return $this->unbookByDate($begin, $end);
    }

    /**
     * Check if the object is booked for the given start / end
     *
     * @param   \DateTimeImmutable  $begin  The begin date of the booking
     * @param   \DateTimeImmutable  $end    The end date of the booking
     * @return  bool    true if it's booked
     */
    public function isBooked(\DateTimeImmutable $begin, \DateTimeImmutable $end)
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

    /**
     * Remove a booking identified by UUID
     *
     * @param   string  $uuid   The UUID of the booking
     * @return  boolean         True on success
     */
    private function unbookByUuid($uuid)
    {
        if (!$this->bookings[$uuid]) {
            return false;
        }
        unset($this->bookings[$uuid]);

        return $this->store();
    }

    /**
     * Remove a booking identified by begin / end date
     *
     * @param   \DateTimeImmutable  $begin  The begin date of the booking
     * @param   \DateTimeImmutable  $end    The end date of the booking
     * @return  bool                        True on success
     */
    private function unbookByDate(\DateTimeImmutable $begin, \DateTimeImmutable $end)
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

}
