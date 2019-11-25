<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\Author;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\IdeaRepository;

class CreateNewIdeaService
{
    private $ideaRepository;

    public function __construct(IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    public function execute(CreateNewIdeaRequest $request) : CreateNewIdeaResponse
    {
        $ideadId = new IdeaId();
        $title = $request->getIdeaTitle();
        $content = $request->getIdeaContent();
        $author = new Author($request->getAuthorName(), $request->getAuthorEmail());
        $idea = new Idea($ideadId, $title, $content, $author);
        
        return new CreateNewIdeaResponse($this->ideaRepository->save($idea));
    }

}