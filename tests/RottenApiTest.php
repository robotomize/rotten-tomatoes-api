<?php

namespace test;

use \rotten\RottenApi\RottenApi;
use \rotten\Exceptions\ApiKeyNotFound;
use \rotten\Exceptions\SyntaxError;
use \rotten\Exceptions\TomatoesApiProblem;

/**
 * Class RottenApiTest
 * @package test
 * @author robotomize@gmail.com
 */
class RottenApiTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->rottenObject = new RottenApi();
        $this->iterator = 0;
    }

    public function tearDown()
    {
        $this->rottenObject = null;
        $this->iterator = null;
    }

    public function testInTheater()
    {
        if (count($this->rottenObject->getInTheatreMovies()) > 0) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    public function testUpcomingMovies()
    {
        if (count($this->rottenObject->getUpcomingMovies()) > 0) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    public function testOpeningMovies()
    {
        if (count($this->rottenObject->getOpeningMovies()) > 0) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    public function testMovieInfo()
    {
        try {
            $movieObject = $this->rottenObject->getMovieInfo(770672122);
            $this->assertEquals(770672122, $movieObject[$this->iterator]->getId());
            $this->assertEquals('Toy Story 3', $movieObject[$this->iterator]->getTitle());
            $this->assertEquals('2010', $movieObject[$this->iterator]->getYear());

            $this->iterator++;

            $movieObject = $this->rottenObject->getMovieInfo(771421904);
            $this->assertEquals(771421904, $movieObject[$this->iterator]->getId());
            $this->assertEquals('Scouts Guide to the Zombie Apocalypse', $movieObject[$this->iterator]->getTitle());
            $this->assertEquals('2015', $movieObject[$this->iterator]->getYear());

            $this->iterator++;

            $movieObject = $this->rottenObject->getMovieInfo(771416235);
            $this->assertEquals(771416235, $movieObject[$this->iterator]->getId());
            $this->assertEquals('Woodlawn', $movieObject[$this->iterator]->getTitle());
            $this->assertEquals('2015', $movieObject[$this->iterator]->getYear());

            $this->iterator++;

            $movieObject = $this->rottenObject->getMovieInfo(771371532);
            $this->assertEquals(771371532, $movieObject[$this->iterator]->getId());
            $this->assertEquals('Pan', $movieObject[$this->iterator]->getTitle());
            $this->assertEquals('2015', $movieObject[$this->iterator]->getYear());

            $this->iterator++;

            $movieObject = $this->rottenObject->getMovieInfo(771370466);
            $this->assertEquals(771370466, $movieObject[$this->iterator]->getId());
            $this->assertEquals('The Intern', $movieObject[$this->iterator]->getTitle());
            $this->assertEquals('2015', $movieObject[$this->iterator]->getYear());

            $this->iterator++;

            $movieObject = $this->rottenObject->getMovieInfo(771390919);
            $this->assertEquals(771390919, $movieObject[$this->iterator]->getId());
            $this->assertEquals('Paranormal Activity: The Ghost Dimension', $movieObject[$this->iterator]->getTitle());
            $this->assertEquals('2015', $movieObject[$this->iterator]->getYear());
        } catch (\Exception $ex) {
            print sprintf('Unknown exception in %s %s with error %s', $ex->getFile(), $ex->getLine(), $ex->getMessage());
        }
    }
}
