<?php

namespace test;

use \rotten\RottenApi\RottenFactory;

/**
 * Class RottenFactoryTest
 * @package test
 * @author robotomize@gmail.com
 */
class RottenFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testMovieInfoFactory()
    {
        try {
            $this->assertEquals(771416235, RottenFactory::makeRotten()->getMovieInfo(771416235)[0]->getId());
            $this->assertEquals(771421904, RottenFactory::makeRotten()->getMovieInfo(771421904)[0]->getId());
            $this->assertEquals(771416235, RottenFactory::makeRotten()->getMovieInfo(771416235)[0]->getId());
            $this->assertEquals(771371532, RottenFactory::makeRotten()->getMovieInfo(771371532)[0]->getId());
        } catch (\Exception $ex) {
            print sprintf('%s%s%s', $ex->getFile(), $ex->getLine(), $ex->getMessage());
        }
    }
}
