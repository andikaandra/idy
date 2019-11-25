<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\RatingRepository;

class ViewAllIdeasService
{
    private $ideaRepository;
    private $ratingRepository;

    public function __construct(IdeaRepository $ideaRepository, RatingRepository $ratingRepository)
    {
        $this->ideaRepository = $ideaRepository;
        $this->ratingRepository = $ratingRepository;
    }

    public function execute()
    {
        $ideas = $this->ideaRepository->allIdeas()->getAllIdeas();
        foreach ($ideas as $idea) {
            $idea->ratings($this->ratingRepository->allIdeaRatings($idea->id())->getRatings());
        }
        return $ideas;
    }
}