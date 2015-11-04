<?php

require 'autoload.php';

use \rotten\RottenApi\RottenApi;
use \rotten\RottenApi\RottenFactory;

//$tt = new RottenApi();
//print $tt->search('Iron Man', '1');
//
//$t2 = new RottenApi();
//print_r($t2->getUpcomingMovies());
//
print_r(RottenFactory::makeRotten()->getInTheatreMovies());

print_r(RottenFactory::makeRotten()->getMovieInfo(771416235));

