<?php 

namespace Idy\Idea\Infrastructure;

use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\Rating;
use Idy\Idea\Domain\Model\RatingRepository;
use Idy\Idea\Infrastructure\Dto\RatingDto;
use Phalcon\Di;
use PDO;

class SqlRatingRepository implements RatingRepository
{
    private $dbManager;

    public function __construct()
    {
        $this->dbManager = Di::getDefault()->get('db');
    }

    public function allIdeaRatings(IdeaId $id)
    {
        $query = sprintf("SELECT * FROM rate WHERE idea_id = :idea_id");

        $params = [
            'idea_id' => $id->id()
        ];

        $ratings = $this->dbManager->query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
        
        return new RatingDto($ratings);
    }

    public function addRate(Rating $rating)
    {
        $query = sprintf('INSERT INTO rate (idea_id, user, value) VALUES (:idea_id, :user, :value);');

        $params = [
            'idea_id' => $rating->ideaId(),
            'user' => $rating->user(),
            'value' => $rating->value()
        ];
        
        return $this->dbManager->execute($query, $params);
    }
}