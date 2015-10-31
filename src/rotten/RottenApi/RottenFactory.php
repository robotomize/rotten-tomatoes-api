<?php

namespace rotten\RottenApi;

/**
 * Class RottenFactory
 * @package rotten\RottenApi
 * @author robotomize@gmail.com
 * @usage
 * print_r(RottenFactory::makeRotten()->getInTheatreMovies());
 */
class RottenFactory
{
    /**
     * @param $params
     * @return RottenApi
     */
    public static function makeRotten($params = [])
    {
        return new RottenApi($params);
    }
}