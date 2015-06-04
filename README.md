# bookable
A PHP library to make other objects bookable.

## Description
My aim is to provide an independent library to make any other object bookable (i.e. rooms, theaters, cars, ...).
I am using a kind of Decorator around the original object to provide additional features, without reimplementing all booking-related concepts in your application.

## Status
2015-06-04: this is alpha code, never used anywhere except in the test suite, so if you're looking for something to use today, move on. But you can definitely play with it, or even use it if you're feeling brave and you want to implement the persistence part yourself.

## Setup
This package is available on Packagist, so you can add it to your composer file with:

    composer require zanardigit/bookable

Then you can add in your class

    use Bookable
    
and you're ready to go.

## Usage

### Create a bookable object
First of all, we assume you have an object already created in your code. Then you can pass it to the Bookable constructor, like this:

    $bookable = new Bookable($myObject);

### Book an object
This will create a new booking for your object:

    $result = $bookable->book(\DateTimeImmutable $begin, \DateTimeImmutable $end)
   
You can create as many as you want, as long as they do not overlap.
   
### Get bookings
This will return an array of bookings:

    $bookings = $bookable->getBookings();
   
### Remove a booking
This will remove a specific booking, identified by its uuid

    $result = $bookable->unbook(string $uuid)

This will remove a specific booking, identified by begin and end date

    $result = $bookable->unbook(\DateTimeImmutable $begin, \DateTimeImmutable $end)
   
## Persistence
The library itself may need to persist some data. To keep it flexible for use in different framework / CMS, I will delegate the actual persistence to a "driver" class that can use application-specific helper classes / methods. 

## Cooperation
I strongly believe in open source as cooperation, in a not-reinventing-the-wheel sense. 
I searched through GitHub for similar packages but for PHP I only found an API client for www.bookability.io, an online "bookable-as-a-service" solution, which is probably cool but not what I was looking for.
You are free (and in fact encouraged) to point out similar solutions so that we may share the coding effort to the benefit of everyone.
