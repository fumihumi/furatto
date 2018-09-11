<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Event;
use Model\Dao\User;

$app->get('/event/{id}', function (Request $request, Response $response, $args) {

    $event = new Event($this->db);
    $user = new User($this->db);

    $data['event'] = $event->select(array("id" => $args['id']));
    $data['user'] = $user->select(array("id" => $data['event']['user_id']));

    return $this->view->render($response, 'event/show.twig', $data);
});

