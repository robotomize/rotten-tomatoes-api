<?php

namespace rotten\RottenApi;

/**
 * Class RottenMovieContainer for generate movie container
 * @package rotten
 * @author robotomize@gmail.com
 */
class RottenMovieContainer
{
    /**
     * @var int
     */
    private $id = 0;

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $year = '';

    /**
     * @var string
     */
    private $mpaaRating = '';

    /**
     * @var string
     */
    private $runtime = '';

    /**
     * @var array
     */
    private $releaseDates = [];

    /**
     * @var array
     */
    private $rating = [];

    /**
     * @var string
     */
    private $synopsis = '';

    /**
     * @var array
     */
    private $poster = [];

    /**
     * @var array
     */
    private $abridgedCast = [];

    /**
     * @var array
     */
    private $links = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getMpaaRating()
    {
        return $this->mpaaRating;
    }

    /**
     * @param string $mpaaRating
     */
    public function setMpaaRating($mpaaRating)
    {
        $this->mpaaRating = $mpaaRating;
    }

    /**
     * @return string
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * @param string $runtime
     */
    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;
    }

    /**
     * @return array
     */
    public function getReleaseDates()
    {
        return $this->releaseDates;
    }

    /**
     * @param array $releaseDates
     */
    public function setReleaseDates($releaseDates)
    {
        $this->releaseDates = $releaseDates;
    }

    /**
     * @return array
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param array $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * @param string $synopsis
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
    }

    /**
     * @return array
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @param array $poster
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    /**
     * @return array
     */
    public function getAbridgedCast()
    {
        return $this->abridgedCast;
    }

    /**
     * @param array $abridgedCast
     */
    public function setAbridgedCast($abridgedCast)
    {
        $this->abridgedCast = $abridgedCast;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param array $links
     */
    public function setLinks($links)
    {
        $this->links = $links;
    }
}