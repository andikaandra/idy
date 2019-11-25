<?php

namespace Idy\Idea\Infrastructure\Dto;

use Idy\Idea\Domain\Model\Rating;

class RatingDto
{
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getRatings()
    {
        $ratings = [];
        foreach ($this->data as $rating) {
            array_push($ratings, new Rating($rating['user'], $rating['value']));
        }
        return $ratings;
    }
}