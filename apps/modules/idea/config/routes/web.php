<?php

$namespace = 'Idy\Idea\Controllers\Web';


$router->addGet('/idea', [
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'index'
]);

$router->addGet('/idea/add', [
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'add'
]);

$router->addPost('/idea/add', [
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'addPost'
]);

$router->addPost('/idea/vote', [
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'votePost'
]);

$router->addPost('/idea/rate', [
    'namespace' => $namespace,
    'module' => 'idea',
    'controller' => 'idea',
    'action' => 'ratePost'
]);
