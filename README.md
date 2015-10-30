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


