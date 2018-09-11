<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $data = [];
    $event = new User($this->$db);

    // $result = $event->select([], "startDate", "DESC", 10, true);

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});
