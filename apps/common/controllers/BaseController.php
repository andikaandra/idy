<?php

namespace Idy\Common\Controllers;

use Phalcon\Mvc\Controller;

class BaseController extends Controller
{    

	public function isDevMode()
	{
		return $this->config->mode == 'DEVELOPMENT';
	}
	
	public function send($data, $statusCode = 200, $statusMessage = "OK")
	{
		$this->response->setContentType('application/json');

		$opts = $this->isDevMode() ? JSON_PRETTY_PRINT : 0;
		$json = json_encode($data, $opts);

		if (json_last_error() !== JSON_ERROR_NONE) {
			throw new \RuntimeException('Failed to convert server response to JSON: ' . json_last_error_msg());
		}

        $this->response->setStatusCode($statusCode, $statusMessage);
		$this->response->setContent($json);
		$this->response->send();
    }
}

