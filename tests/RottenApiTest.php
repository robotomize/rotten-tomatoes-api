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
    }

    public function tearDown()
    {
        $this->rottenObject = null;
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
        //print_r($this->rottenObject->getMovieInfo(162659162));
    }
}
