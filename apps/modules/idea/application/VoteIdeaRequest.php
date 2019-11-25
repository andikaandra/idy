<?php

namespace Idy\Idea\Application;

class VoteIdeaRequest
{
    private $ideaId;

    public function __construct($ideaId)
    {
        $this->ideaId = $ideaId;
    }

    public function getIdeaId(){
      return $this->ideaId;
    }

    public function setIdeaId($ideaId){
  		$this->ideaId = $ideaId;
    }
}