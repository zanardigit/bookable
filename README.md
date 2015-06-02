# bookable
A PHP library to make other objects bookable.

## Status
This is currently an idea. Not even Alpha code.

## Description
My aim is to provide an independent library to make any other object bookable (i.e. rooms, theaters, cars, ...).
The idea is to use a Decorator object around the original object and so provide additional features, without having to reimplement all booking-related concepts in your application.

## Persistence
The library itself may need to persist some data. To keep it flexible for use in different framework / CMS, I will delegate the actual persistence to a "driver" class that can use application-specific helper classes / methods. 

## Cooperation
I strongly believe in open source as cooperation, in a not-reinventing-the-wheel sense. 
I searched through GitHub for similar packages but for PHP I only found an API client for www.bookability.io, an online "bookable-as-a-service" solution, which is probably cool but not what I was looking for.
You are free (and in fact encouraged) to point out similar solutions so that we may share the coding effort to the benefit of everyone.
