# RottenTomatoesAPI
Rotten tomatoes API PHP wrapper

## Install

`git clone https://github.com/robotomize/fujes.git`

## RottenAPI methods instructions

* Search movies
* Upcoming movies
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

$t2 = new RottenApi(['apiKey' => 'your api key']);
print_r($tt->getUpcomingMovies());
```

### In theater movies

```php
<?php
$t3 = new RottenApi();
print_r($t3->getInTheatreMovies());
```


