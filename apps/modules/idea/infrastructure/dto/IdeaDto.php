<?php

namespace Idy\Idea\Infrastructure\Dto;

use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\Author;

class IdeaDto
{
    private $data;
    private $rates;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function setRate($data)
    {
        $this->rates = $data;
    }

    public function getIdea()
    {
        $data = $this->data;
        $ideadId = new IdeaId($data['idea_id']);
        $title = $data['title'];
        $content = $data['content'];
        $author = new Author($data['author_name'], $data['author_email']);
        $votes = $data['vote'];
        return new Idea($ideadId, $title, $content, $author, $votes);        
    }
}