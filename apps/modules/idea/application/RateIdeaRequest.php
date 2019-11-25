<?php

namespace Idy\Idea\Application;

class RateIdeaRequest
{
    private $ideaId;
    private $rating;
    private $user;

    public function __construct($ideaId, $rating, $user)
    {
        $this->ideaId = $ideaId;
        $this->rating = $rating;
        $this->user = $user;
    }

    public function getIdeaId(){
      return $this->ideaId;
    }

    public function setIdeaId($ideaId){
  		$this->ideaId = $ideaId;
    }
    
    public function getRating(){
	  	return $this->rating;
	  } 

    public function setRating($rating){
      $this->rating = $rating;
    }

    public function getUser(){
	  	return $this->user;
	  } 

    public function setUser($user){
      $this->user = $user;
    }
}