<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\RatingRepository;

class RateIdeaService
{
    private $ideaRepository;
    private $ratingRepository;

    public function __construct(IdeaRepository $ideaRepository, RatingRepository $ratingRepository)
    {
        $this->ideaRepository = $ideaRepository;
        $this->ratingRepository = $ratingRepository;
    }

    public function execute(RateIdeaRequest $request)
    {
        $rate = $request->getRating();
        $user = $request->getUser();
        $ideaId = new IdeaId($request->getIdeaId());
        $idea = $this->ideaRepository->byId($ideaId)->getIdea();
        $idea->ratings($this->ratingRepository->allIdeaRatings($ideaId)->getRatings());
        try {
            $rating = $idea->addRating($user, $rate);
            $res = $this->ratingRepository->addRate($rating);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $res;
    }
}