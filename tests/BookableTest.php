<?php

/**
 * @version		  tests/BookableTest.php 2015-06-02 18:41:00 UTC zanardigit
 * @package		  zanardigit/bookable
 * @author      zanardigit <f.abeni@gibilogic.com>
 * @authorUrl   http://www.yegods.it
 * @license		  GNU/GPL v3 or later
 */

class BookableTest extends PHPUnit_Framework_TestCase
{

    public function testBookableObjectIsCreated()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $this->assertNotEmpty($bookable, "Unable to create the bookable object");
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
        $bookable = new Bookable($item);
        $this->assertTrue($bookable->book(), "The bookable object is not bookable");
    }

    public function testBookableObjectIsBookedAfterBookAction()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $bookable->book();
        $this->assertTrue($bookable->isBooked(), "The bookable object is not booked after book action");
    }

    public function testBookableObjectCanBeUnbooked()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $this->assertTrue($bookable->unbook(), "The bookable object is not unbookable");
    }

    public function testBookableObjectIsNotBookedAfterUnbookAction()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $bookable->book();
        $bookable->unbook();
        $this->assertFalse($bookable->isBooked(), "The bookable object is still booked after unbook action");
    }

    public function testBookableObjectCanBeStored()
    {
        $item = new \stdClass();
        $bookable = new Bookable($item);
        $this->assertTrue($bookable->store(), "The bookable object cannot be stored");
    }

}
