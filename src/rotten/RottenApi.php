<?php

namespace rotten;

use rotten\Exceptions\ApiKeyNotFound;
use rotten\Exceptions\JsonValidate;
use rotten\Exceptions\TomatoesApiProblem;

class RottenApi
{
    /**
     * @var
     */
    private $apiKey;

    public function __construct($apiKey = '')
    {
        if ($apiKey == '') {
            $this->apiKey = file_get_contents(__DIR__ . '/data/credentials');
        } else {
            $this->apiKey = $apiKey;
        }
        if ($this->apiKey == '') {
            throw new ApiKeyNotFound('Put api key to constructor');
        }
    }

    /**
     * @var string
     */
    private $jsonVar = '';

    /**
     * @var
     */
    private $jsonObject;

    /**
     * @param string $sourceUrl
     * @return mixed
     * @throws JsonValidate
     * @throws TomatoesApiProblem
     */
    private function getJsonData($sourceUrl)
    {
        $this->jsonVar = sprintf('%s%s', $sourceUrl, $this->apiKey);
        $this->jsonVar = file_get_contents($this->jsonVar);

        if ($this->jsonVar == '') {
            throw new TomatoesApiProblem($this->jsonVar);
        }

        $jsonContainer = json_decode($this->jsonVar);
        if (json_last_error() > 0) {
            throw new JsonValidate(json_last_error_msg());
        }

        return $jsonContainer;
    }

    private function iterateJsonObject($jsonContainer)
    {
        /**
         * Object notation
         */
        foreach ($jsonContainer->{'movies'} as $vv) {
            print sprintf('%s %s %s %s %s',
                    $vv->{'id'},
                    $vv->{'title'},
                    $vv->{'year'},
                    $vv->{'release_dates'}->{'theater'},
                    $vv->{'synopsis'}) . PHP_EOL;
        }
    }

    /**
     * @var string
     */
    private static $openingUrl = 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/openig.json?apikey=';

    public function getOpeningMovies()
    {
        $this->jsonObject = $this->getJsonData(self::$openingUrl);
        $this->iterateJsonObject($this->jsonObject);
    }

    /**
     * @var string
     */
    private static $upcomingUrl = 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/upcoming.json?apikey=';

    public function getUpcomingMovies()
    {
        $this->jsonObject = $this->getJsonData(self::$upcomingUrl);
        $this->iterateJsonObject($this->jsonObject);
    }

    /**
     * @var string
     */
    private static $inTheaterUrl =
        'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json?apikey=';

    public function getInTheatreMovies()
    {
        $this->jsonObject = $this->getJsonData(self::$inTheaterUrl);
        $this->iterateJsonObject($this->jsonObject);
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return mixed
     */
    public function getJsonObject()
    {
        return $this->jsonObject;
    }

    /**
     * @return string
     */
    public static function getOpeningUrl()
    {
        return self::$openingUrl;
    }

    /**
     * @param string $openingUrl
     */
    public static function setOpeningUrl($openingUrl)
    {
        self::$openingUrl = $openingUrl;
    }

    /**
     * @return string
     */
    public static function getUpcomingUrl()
    {
        return self::$upcomingUrl;
    }

    /**
     * @param string $upcomingUrl
     */
    public static function setUpcomingUrl($upcomingUrl)
    {
        self::$upcomingUrl = $upcomingUrl;
    }

    /**
     * @return string
     */
    public static function getInTheaterUrl()
    {
        return self::$inTheaterUrl;
    }

    /**
     * @param string $inTheaterUrl
     */
    public static function setInTheaterUrl($inTheaterUrl)
    {
        self::$inTheaterUrl = $inTheaterUrl;
    }
}

