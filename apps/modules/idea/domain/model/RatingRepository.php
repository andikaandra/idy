<?php

namespace Idy\Idea\Domain\Model;

interface RatingRepository
{
    public function allIdeaRatings(IdeaId $id);
    public function addRate(Rating $rating);
}