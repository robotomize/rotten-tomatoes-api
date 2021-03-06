<?php

namespace rotten\RottenApi;

use rotten\Exceptions\ApiKeyNotFound;
use rotten\Exceptions\JsonValidate;
use rotten\Exceptions\SyntaxError;
use rotten\Exceptions\TomatoesApiProblem;

/**
 * Class RottenApi Wrapper for RottenTomatoes API
 * @package rotten\RottenAPI
 * @author robotomize@gmail.com
 * @version 0.0.1.0
 *
 * @usage
 * example
 * $tt = new RottenApi(['apiKey' => 'your api key', 'raw' => false]);
 * print_r($tt->getInTheatreMovies());
 *
 * 'raw' => true return raw json data
 */
class RottenApi
{

    /**
     * @var string
     */
    public static $version = '0.0.1.0';

    /**
     * @var
     */
    private $apiKey;

    /**
     * @var bool
     */
    private $rawOption = false;

    /**
     * $params['apiKey', 'raw']
     * @param array $params
     * @throws ApiKeyNotFound
     */
    public function __construct($params = [])
    {
        if (0 === count($params)) {
            $this->apiKey = file_get_contents(__DIR__ . '/../data/credentials');
        } else {
            if (isset($params['apiKey'])) {
                $this->apiKey = $params['apiKey'];
            }

            if (isset($params['raw'])) {
                $this->rawOption = $params['raw'];
            }
        }
        if ($this->apiKey == '') {
            throw new ApiKeyNotFound('Put api key to constructor');
        }
    }

    /**
     * @var bool
     */
    private $debug = true;

    /**
     * @var string
     */
    private $jsonVar = '';

    /**
     * @var
     */
    private $jsonObject;

    /**
     * @param array $additionalOptions
     * @return string
     */
    private function buildSearchQuery($additionalOptions = [])
    {
        return sprintf('&q=%s&page=%s',
            empty($additionalOptions['p']) ? '' : $additionalOptions['q'],
            empty($additionalOptions['p']) ? 1 : $additionalOptions['p']);
    }

    /**
     * @param $sourceUrl
     * @param array $additionalOptions
     * @return string
     */
    private function getJson($sourceUrl, $additionalOptions = [])
    {
        if (0 !== count($additionalOptions)) {
            $this->jsonVar = sprintf('%s%s%s', $sourceUrl, $this->apiKey, $this->buildSearchQuery($additionalOptions));
        } else {
            $this->jsonVar = sprintf('%s%s', $sourceUrl, $this->apiKey);
        }
        try {
            return file_get_contents($this->jsonVar);
        } catch (\Exception $except) {
            throw new TomatoesApiProblem('Problem with Tomatoes API or APIkey not valid');
        }
    }

    /**
     * @param string $sourceUrl
     * @return mixed
     * @throws JsonValidate
     * @throws TomatoesApiProblem
     */
    private function getJsonData($sourceUrl, $additionalOptions = [])
    {

        $this->jsonVar = $this->getJson($sourceUrl, $additionalOptions);

        if ($this->jsonVar == '') {
            throw new TomatoesApiProblem($this->jsonVar);
        }

        $jsonContainer = json_decode($this->jsonVar);
        if (json_last_error() > 0) {
            throw new JsonValidate(json_last_error_msg());
        }

        return $jsonContainer;
    }

    /**
     * @var array
     */
    private $movieContainer = [];

    /**
     * @param \Exception $exception
     */
    private function getException(\Exception $exception)
    {
        if ($this->debug) {
            print sprintf('Exception in %s file, %s line, with message %s',
                $exception->getFile(), $exception->getLine(), $exception->getMessage());
        }
    }

    /**
     * @param $jsonContainer
     * @return RottenMovieContainer
     */
    private function pullDataToMovieContainer($jsonContainer)
    {
        $movieObject = new RottenMovieContainer();
        $movieObject->setId($jsonContainer->{'id'});
        $movieObject->setTitle($jsonContainer->{'title'});
        $movieObject->setYear($jsonContainer->{'year'});
        $movieObject->setMpaaRating($jsonContainer->{'mpaa_rating'});
        $movieObject->setRuntime($jsonContainer->{'runtime'});
        $movieObject->setReleaseDates($jsonContainer->{'release_dates'});
        $movieObject->setRating($jsonContainer->{'ratings'});
        $movieObject->setSynopsis($jsonContainer->{'synopsis'});
        $movieObject->setPoster($jsonContainer->{'posters'});
        $movieObject->setAbridgedCast($jsonContainer->{'abridged_cast'});
        $movieObject->setLinks($jsonContainer->{'links'});

        return $movieObject;
    }

    /**
     * @param $jsonContainer
     */
    private function fetchFew($jsonContainer)
    {
        /**
         * Object notation
         */
        try {
            foreach ($jsonContainer->{'movies'} as $vv) {
                $this->movieContainer[] = $this->pullDataToMovieContainer($vv);
            }
        } catch (\Exception $exception) {
            $this->getException($exception);
        }
        return $this->movieContainer;
    }

    /**
     * @param $jsonContainer
     * @return array
     */
    private function fetchOne($jsonContainer)
    {
        try {
            $this->movieContainer[] = $this->pullDataToMovieContainer($jsonContainer);

        } catch (\Exception $exception) {
            $this->getException($exception);
        }
        return $this->movieContainer;
    }

    /**
     * @var string
     */
    private static $openingUrl = 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/opening.json?apikey=';

    /**
     * @return array
     * @throws JsonValidate
     * @throws TomatoesApiProblem
     */
    public function getOpeningMovies()
    {
        if ($this->rawOption) {
            return $this->getJson(self::$openingUrl);
        } else {
            $this->jsonObject = $this->getJsonData(self::$openingUrl);
            return $this->fetchFew($this->jsonObject);
        }
    }

    /**
     * @var string
     */
    private static $upcomingUrl = 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/upcoming.json?apikey=';

    /**
     * @return array
     * @throws JsonValidate
     * @throws TomatoesApiProblem
     */
    public function getUpcomingMovies()
    {
        if ($this->rawOption) {
            return $this->getJson(self::$upcomingUrl);
        } else {
            $this->jsonObject = $this->getJsonData(self::$upcomingUrl);
            return $this->fetchFew($this->jsonObject);
        }
    }

    /**
     * @var string
     */
    private static $inTheaterUrl =
        'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json?apikey=';

    /**
     * @return array
     * @throws JsonValidate
     * @throws TomatoesApiProblem
     */
    public function getInTheatreMovies()
    {
        if ($this->rawOption) {
            return $this->getJson(self::$inTheaterUrl);
        } else {
            $this->jsonObject = $this->getJsonData(self::$inTheaterUrl);
        }
        return $this->fetchFew($this->jsonObject);
    }

    /**
     * @var string
     */
    private static $movieInfo = 'http://api.rottentomatoes.com/api/public/v1.0/movies/';

    /**
     * @param $movieId
     * @return array
     * @throws JsonValidate
     * @throws TomatoesApiProblem
     */
    public function getMovieInfo($movieId)
    {
        $movieLink = sprintf('%s%s.json?apikey=', self::$movieInfo, $movieId);
        if ($this->rawOption) {
            return $this->getJson($movieLink);
        } else {
            $this->jsonObject = $this->getJsonData($movieLink);
            return $this->fetchOne($this->jsonObject);
        }
    }

    /**
     * @var string
     */
    private static $searchQuery = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=';

    /**
     * @param $searchQuery
     * @param $page
     * @return array|string
     * @throws JsonValidate
     * @throws TomatoesApiProblem
     */
    public function search($searchQuery, $page)
    {
        if ($this->rawOption) {
            return $this->getJson(self::$searchQuery, ['q' => $searchQuery, 'p' => $page]);
        } else {
            $this->jsonObject = $this->getJsonData(self::$searchQuery, ['q' => $searchQuery, 'p' => $page]);
            return $this->fetchFew($this->jsonObject);
        }
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

    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @return string
     */
    public static function getVersion()
    {
        return self::$version;
    }

    /**
     * @param boolean $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return array
     */
    public function getMovieContainer()
    {
        return $this->movieContainer;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (0 === count($this->movieContainer)) {
            return '';
        } else {
            return serialize($this->movieContainer);
        }
    }

    /**
     * @throws SyntaxError
     */
    public function __invoke()
    {
        throw new SyntaxError('Use default methods, such as getUpcomingMovies, getInTheatreMovies etc');
    }
}


