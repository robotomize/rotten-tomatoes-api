<?php

require 'autoload.php';

use \rotten\RottenApi\RottenApi;

$tt = new RottenApi(['apiKey' => '', 'raw' => true]);
print $tt->search('Iron Man', '1');

//$t2 = new RottenApi();
//print_r($tt->getUpcomingMovies());

