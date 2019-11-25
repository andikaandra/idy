<?php

namespace Idy\Idea\Domain\Model;

use Idy\Common\Events\DomainEventPublisher;
use Exception;

class Idea
{
    private $id;
    private $title;
    private $description;
    private $author;
    private $ratings;
    private $votes;
    
    public function __construct(IdeaId $id, $title, $description, Author $author, $votes = null, $ratings = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->votes = $votes ? $votes : 0;
        $this->ratings = $ratings ? $ratings : array();
    }

    public function id() 
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function description()
    {
        return $this->description;
    }

    public function author()
    {
        return $this->author;
    }

    public function votes()
    {
        return $this->votes;
    }

    public function addRating($user, $ratingValue)
    {
        $newRating = new Rating($user, $ratingValue, $this->id()->id());

        if ($newRating->isValid()) {
            $exist = false;
            foreach ($this->ratings as $existingRating) {
                if ($existingRating->equals($newRating)) {
                    $exist = true;
                }
            }

            if (!$exist) {
                array_push($this->ratings, $newRating);
            } else {
                throw new Exception('Author ' . $newRating->user() . ' has given a rating.');
            }

            return $newRating;
            // DomainEventPublisher::instance()->publish(
            //     new IdeaRated($this->author()->name(), $this->author()->email(), $this->title, $ratingValue)
            // );
        }
    }

    public function vote()
    {   
        $this->votes = $this->votes + 1;
    }

    public function averageRating()
    {
        $numberOfRatings = count($this->ratings);
        if (!$numberOfRatings) {
            return 0;
        }
        $totalRatings = 0;

        foreach ($this->ratings as $rating) {
            $totalRatings += $rating->value();
        }

        return $totalRatings / $numberOfRatings;
    }

    public static function makeIdea($title, $description, $author)
    {
        $newIdea = new Idea(new IdeaId(), $title, $description, $author);
        
        return $newIdea;
    }

    public function ratings($ratings)
    {
        $this->ratings = $ratings;
    }

    public function getR()
    {
        return $this->ratings;
    }
}