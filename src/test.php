<?php

require 'autoload.php';

use \rotten\RottenApi\RottenApi;
use \rotten\RottenApi\RottenFactory;

$tt = new RottenApi(['apiKey' => '', 'raw' => true]);
print $tt->search('Iron Man', '1');

$t2 = new RottenApi();
print_r($tt->getUpcomingMovies());

print_r(RottenFactory::makeRotten()->getInTheatreMovies());

