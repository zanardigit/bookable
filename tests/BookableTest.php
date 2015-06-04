<?php

/**
 * @version     tests/BookableTest.php 2015-06-03 20:39:00 UTC zanardigit
 * @package     zanardigit/bookable
 * @author      zanardigit <f.abeni@gibilogic.com>
 * @authorUrl   http://www.yegods.it
 * @license     GNU/GPL v3 or later
 */
use Ramsey\Uuid\Uuid;

class BookableTest extends PHPUnit_Framework_TestCase
{

    public function testBookableObjectIsCreated()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $this->assertNotEmpty($bookable, "Unable to create the bookable object");
    }

    public function testBookableObjectHasValidUuidAfterCreated()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $this->assertTrue(Uuid::isValid($bookable->getUuid()), "The bookable object has no valid UUID");
    }

    public function testBookableObjectHasItem()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $this->assertNotEmpty($bookable->getItem(), "The bookable object has no item");
    }

    public function testBookableObjectItemIsCorrectClass()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $this->assertSame($item, $bookable->getItem(), "The bookable object item is not the one we gave");
    }

    public function testBookableObjectCanBeBooked()
    {
        $item = new \stdClass();
        $begin = new \DateTimeImmutable("today");
        $end = new \DateTimeImmutable("tomorrow");
        $bookable = new Bookable($item);
        $this->assertTrue($bookable->book($begin, $end), "The bookable object is not bookable");
    }

    public function testBookableObjectCanBeBookedInDifferentPeriods()
    {
        $item = new \stdClass();
        $begin = new \DateTimeImmutable("today");
        $end = new \DateTimeImmutable("tomorrow");
        $new_begin = new \DateTimeImmutable("today +2 days");
        $new_end = new \DateTimeImmutable("tomorrow +2 days");
        $bookable = new Bookable($item);
        $bookable->book($begin, $end);
        $this->assertTrue($bookable->book($new_begin, $new_end), "The bookable object is not bookable in different period");
    }

    public function testBookableObjectIsBookedAfterBookAction()
    {
        $item = new \stdClass();
        $begin = new \DateTimeImmutable("today");
        $end = new \DateTimeImmutable("tomorrow");
        $bookable = new Bookable($item);
        $bookable->book($begin, $end);
        $this->assertTrue($bookable->isBooked($begin, $end), "The bookable object is not booked after book action");
    }

    public function testBookableObjectHasBookingsAfterBookAction()
    {
        $item = new \stdClass();
        $begin = new \DateTimeImmutable("today");
        $end = new \DateTimeImmutable("tomorrow");
        $bookable = new Bookable($item);
        $bookable->book($begin, $end);
        $this->assertNotEmpty($bookable->getBookings(), "The bookable object is not booked after book action");
    }

    public function testBookableObjectCanBeUnbookedByDate()
    {
        $item = new \stdClass();
        $begin = new \DateTimeImmutable("today");
        $end = new \DateTimeImmutable("tomorrow");
        $bookable = new Bookable($item);
        $bookable->book($begin, $end);
        $this->assertTrue($bookable->unbook(null, $begin, $end), "The bookable object is not unbookable by date");
    }

    public function testBookableObjectCanBeUnbookedByUuid()
    {
        $item = new \stdClass();
        $begin = new \DateTimeImmutable("today");
        $end = new \DateTimeImmutable("tomorrow");
        $bookable = new Bookable($item);
        $bookable->book($begin, $end);
        $booking_uuid = array_values($bookable->getBookings())[0]->getUuid();
        $this->assertTrue($bookable->unbook($booking_uuid, null, null), "The bookable object is not unbookable by UUID");
    }

    public function testBookableObjectIsNotBookedAfterUnbookAction()
    {
        $item = new \stdClass();
        $begin = new \DateTimeImmutable("today");
        $end = new \DateTimeImmutable("tomorrow");
        $bookable = new Bookable($item);
        $bookable->book($begin, $end);
        $bookable->unbook(null, $begin, $end);
        $this->assertFalse($bookable->isBooked($begin, $end), "The bookable object is still booked after unbook action");
    }

    public function testBookableObjectCannotBeBookedIfAlreadyBooked()
    {
        $item = new \stdClass();
        $begin = new \DateTimeImmutable("today");
        $end = new \DateTimeImmutable("today +7 days");
        $new_begin = new \DateTimeImmutable("tomorrow");
        $new_end = new \DateTimeImmutable("tomorrow +7 days");
        $bookable = new Bookable($item);
        $bookable->book($begin, $end);
        $this->assertFalse($bookable->book($new_begin, $new_end), "The bookable object is still bookable after being booked");
    }

    public function testBookableObjectCanBeStored()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $this->assertTrue($bookable->store(), "The bookable object cannot be stored");
    }

}
