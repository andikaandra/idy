<?php

namespace Idy\Idea\Application;

class CreateNewIdeaRequest
{
    private $ideaTitle;
    private $ideaContent;
    private $authorName;
    private $authorEmail;

    public function __construct($ideaTitle, $ideaContent, $authorName, $authorEmail)
    {
        $this->ideaTitle = $ideaTitle;
        $this->ideaContent = $ideaContent;
        $this->authorName = $authorName;
        $this->authorEmail = $authorEmail;
    }
    
    public function getIdeaTitle(){
		return $this->ideaTitle;
	}

	public function setIdeaTitle($ideaTitle){
		$this->ideaTitle = $ideaTitle;
	}

	public function getIdeaContent(){
		return $this->ideaContent;
	}

	public function setIdeaContent($ideaContent){
		$this->ideaContent = $ideaContent;
	}

	public function getAuthorName(){
		return $this->authorName;
	}

	public function setAuthorName($authorName){
		$this->authorName = $authorName;
	}

	public function getAuthorEmail(){
		return $this->authorEmail;
	}

	public function setAuthorEmail($authorEmail){
		$this->authorEmail = $authorEmail;
	}
}