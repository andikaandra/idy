<?php

namespace Idy\Idea\Application;

class RateIdeaResponse
{
    private $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function getResponse(){
      return $this->response;
    }

  	public function setResponse($response){
	  	$this->response = $response;
    }
}