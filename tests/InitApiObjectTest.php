<?php

namespace test;

use \rotten\RottenApi\RottenApi;
use \rotten\Exceptions\ApiKeyNotFound;
use \rotten\Exceptions\SyntaxError;
use \rotten\Exceptions\TomatoesApiProblem;

/**
 * Class InitApiObjectTest
 * @package test
 * @author robotomize@gmail.com
 */
class InitApiObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateWithCredentials()
    {
        $tt = new RottenApi();
        $this->assertEquals('', $tt);
    }

    public function testCreateWithApi()
    {
        try {
            $tt = new RottenApi(['apiKey' => '']);
        } catch (ApiKeyNotFound $except) {
            $this->assertEquals('Put api key to constructor', $except->getMessage());
        }
    }

    public function testInvoke()
    {
        try {
            $tt = new RottenApi();
            print $tt();
        } catch (SyntaxError $except) {
            $this->assertEquals('Use default methods, such as getUpcomingMovies, getInTheatreMovies etc',
                $except->getMessage());
        }
    }

    public function testFakeApiKey()
    {
        try {
            $tt = new RottenApi(['apiKey' => 'djsfjsdfjs']);
            print_r($tt->getInTheatreMovies());
        } catch (TomatoesApiProblem $except) {
            $this->assertEquals('Problem with Tomatoes API or APIkey not valid',
                $except->getMessage());
        }
    }
}
