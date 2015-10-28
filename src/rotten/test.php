<?php

require 'autoload.php';

include 'RottenApi.php';

use \rotten\RottenApi;

$tt = new RottenApi();
print $tt->getOpeningMovies();