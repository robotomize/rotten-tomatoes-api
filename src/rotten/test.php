<?php

require 'autoload.php';

include 'RottenApi.php';
include 'RottenMovieContainer.php';

use \rotten\RottenApi;

//$tt = new RottenApi();
//print_r($tt->getMovieInfo(770672122));

$arr = explode('&', 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=[your_api_key]&q=Jack&page_limit=1');
print_r($arr);