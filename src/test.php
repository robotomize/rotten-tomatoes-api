<?php

require 'autoload.php';

use \rotten\RottenApi\RottenApi;
use \rotten\RottenApi\RottenFactory;

/**
 * Search Iron Man and view results
 */
$tt = new RottenApi();
print $tt->search('Iron Man', '1');

/**
 * Upcoming movies
 */
$t2 = new RottenApi();
print_r($t2->getUpcomingMovies());

/**
 * Get in theater movies
 */
print_r(RottenFactory::makeRotten()->getInTheatreMovies());

/**
 * Get movie info with movie id. Use factory
 */
print_r(RottenFactory::makeRotten()->getMovieInfo(771416235));

/**
 * Get opening movies with factory
 */
print_r(RottenFactory::makeRotten()->getOpeningMovies());



