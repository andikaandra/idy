<?php

namespace Idy\Idea\Controllers\Web;

use Idy\Common\Controllers\WebController;
use Idy\Idea\Application\CreateNewIdeaRequest;
use Idy\Idea\Application\VoteIdeaRequest;
use Idy\Idea\Application\RateIdeaRequest;

class IdeaController extends WebController
{
    protected $request;
    protected $createNewIdeaService;
    protected $viewAllIdeasService;
    protected $voteIdeaService;
    protected $rateIdeaService;

    public function initialize()
    {
        $this->request = $this->di->get('request');
        $this->createNewIdeaService = $this->di->get('createNewIdeaService');
        $this->viewAllIdeasService = $this->di->get('viewAllIdeasService');
        $this->voteIdeaService = $this->di->get('voteIdeaService');
        $this->rateIdeaService = $this->di->get('rateIdeaService');
    }

    public function indexAction()
    {
        $ideas = $this->viewAllIdeasService->execute();
        $this->view->setVar('ideas', $ideas);
        return $this->view->pick('home');
    }

    public function addAction()
    {
        return $this->view->pick('add');
    }

    public function addPostAction()
    {
        $ideaTitle = $this->request->getPost('title');
        $ideaContent = $this->request->getPost('description');
        $authorName = $this->request->getPost('name');
        $authorEmail = $this->request->getPost('email');

        $request = new CreateNewIdeaRequest($ideaTitle, $ideaContent, $authorName, $authorEmail);
        $response = $this->createNewIdeaService->execute($request);
        if ($response->getResponse()) {
            return $this->response->redirect('');
        }
        return $this->response->redirect($this->request->getHTTPReferer());
    }

    public function votePostAction()
    {
        $ideaId = $this->request->getPost('idea_id_vote');
        $request = new VoteIdeaRequest($ideaId);
        $response = $this->voteIdeaService->execute($request);
        return $this->response->redirect($this->request->getHTTPReferer());
    }

    public function ratePostAction()
    {
        $ideaId = $this->request->getPost('idea_id_rate');
        $rating = $this->request->getPost('rate');
        $user = $this->request->getPost('name');
        $request = new RateIdeaRequest($ideaId, $rating, $user);
        $response = $this->rateIdeaService->execute($request);
        if ($response === true) {
            return $this->response->redirect('');
        }
        var_dump($response);
    }

}