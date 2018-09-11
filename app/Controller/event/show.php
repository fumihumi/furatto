<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Event;
use Model\Dao\User;
use Model\Dao\EventUser;


$app->get('/event/{id}', function (Request $request, Response $response, $args) {

    $eventId = $args['id'];

    $event = new Event($this->db);
    $user = new User($this->db);
    $eventUser = new EventUser($this->db);

    $data['event'] = $event->select(array("id" => $eventId));

    $eventOwnerId = $data['event']['user_id'];
    $data['owner'] = $user->select(array("id" => $eventOwnerId));

    $userIds = $eventUser->getUserIdsByEventId($eventId);

    $event = new User($this->db);
    $data['users'] = $user->getUsersByIds($userIds);


    return $this->view->render($response, 'event/show.twig', $data);
});
