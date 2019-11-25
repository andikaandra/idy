<?php 

namespace Idy\Idea\Infrastructure;

use Idy\Idea\Domain\Model\IdeaRepository;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Infrastructure\Dto\AllIdeasDto;
use Idy\Idea\Infrastructure\Dto\IdeaDto;
use Phalcon\Di;
use PDO;

class SqlIdeaRepository implements IdeaRepository
{
    private $ideas;
    private $dbManager;

    public function __construct()
    {
        $this->ideas = array();
        $this->dbManager = Di::getDefault()->get('db');
    }

    public function byId(IdeaId $id)
    {
        $query = sprintf("SELECT * FROM idea WHERE idea_id = :idea_id");

        $params = [
            'idea_id' => $id->id()
        ];

        $idea = $this->dbManager->query($query, $params)->fetch(PDO::FETCH_ASSOC);
        
        return new IdeaDto($idea);
    }

    public function save(Idea $idea)
    {
        $query = sprintf('INSERT INTO idea (idea_id, title, content, author_name, author_email) VALUES (:idea_id, :title, :content, :author_name, :author_email);');

        $params = [
            'idea_id' => $idea->id()->id(),
            'title' => $idea->title(),
            'content' => $idea->description(),
            'author_name' => $idea->author()->name(),
            'author_email' => $idea->author()->email()
        ];
        
        return $this->dbManager->execute($query, $params);
    }

    public function allIdeas()
    {
        $query = sprintf("SELECT * FROM idea");

        $ideas = $this->dbManager->query($query)->fetchAll(PDO::FETCH_ASSOC);
        
        return new AllIdeasDto($ideas);
    }
    
    public function voteIdea(Idea $idea)
    {
        $query = sprintf('UPDATE idea set vote = :vote WHERE idea_id = :idea_id;');

        $params = [
            'vote' => $idea->votes(),
            'idea_id' => $idea->id()->id()
        ];

        return $this->dbManager->execute($query, $params);
    }
}