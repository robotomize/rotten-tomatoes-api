# RottenTomatoesAPI
Rotten tomatoes API PHP wrapper

## Install

`git clone https://github.com/robotomize/fujes.git`

## RottenAPI methods instructions

* Search movies
* Upcoming movies
* Opening movies
* In Theater movies
* Movie info

## Usage

### Search
```php
<?php
$tt = new RottenApi(['apiKey' => '', 'raw' => false]);
print $tt->search('Iron Man', '1');
// return array of objects
```

### Get upcoming movies
```php
<?php

$t2 = new RottenApi(['apiKey' => 'your api key', 'raw' => false]);
print_r($tt->getUpcomingMovies());
```

### In theater movies

```php
<?php
$t3 = new RottenApi();
print_r($t3->getInTheatreMovies());
```

### Opening movies
```php
<?php
$t3 = new RottenApi();
print_r($t3->getOpeningMovies());
```

### Info about movie by id
```php
<?php

$t3 = new RottenApi();
print_r($t3->getMovieInfo((int)$id));

```

## Parameters

* Use raw flag to get the results in the original format.
* You can put the key in the / data / credentials for easy debugging or to pass it in the parameters.

```php
<?php
 $t2 = new RottenApi(['apiKey' => 'your api key', 'raw' => true]);
 $t2->getOpeningMovies();
 // return JSON

 $t2 = new RottenApi(['apiKey' => 'your api key', 'raw' => false]);
 $t2->getOpeningMovies();
 // return array of RottenMovieContainer objects
 ?>
```

## Factory
```php
<?php
print_r(RottenFactory::makeRotten()->getInTheatreMovies());
print RottenFactory::makeRotten(['raw' => true])->getInTheatreMovies();
 ?>
```
