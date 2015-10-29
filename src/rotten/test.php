<?php

require 'autoload.php';

include 'RottenApi.php';
include 'RottenMovieContainer.php';

use \rotten\RottenApi;

$tt = new RottenApi();
print_r($tt->search('Iron Man', '1'));

