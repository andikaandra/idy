<?php

namespace Idy\Idea\Infrastructure\Dto;

use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\Author;

class AllIdeasDto
{
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getAllIdeas()
    {
        $ideas = [];
        foreach ($this->data as $idea) {
            $ideadId = new IdeaId($idea['idea_id']);
            $title = $idea['title'];
            $content = $idea['content'];
            $author = new Author($idea['author_name'], $idea['author_email']);
            $votes = $idea['vote'];
            $idea = new Idea($ideadId, $title, $content, $author, $votes);
            array_push($ideas, $idea);
        }
        return $ideas;
    }
}