<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Event;
use Model\Dao\User;
use Model\Dao\EventUser;
use Model\Dao\Chat;


$app->get('/event/{id}', function (Request $request, Response $response, $args) {

    $eventId = $args['id'];

    $event = new Event($this->db);
    $user = new User($this->db);
    $eventUser = new EventUser($this->db);
    $chat = new Chat($this->db);

    $data['event'] = $event->select(array("id" => $eventId));

    $eventOwnerId = $data['event']['user_id'];
    $data['owner'] = $user->select(array("id" => $eventOwnerId));

    $userIds = $eventUser->getUserIdsByEventId($eventId);

    if (count($userIds) > 0) {
        $data['users'] = $user->getUsersByIds($userIds);
    } else {
        $data['users'] = [];
    }

    $currentUser = $this->session["user_info"];
    $data['currentUser'] = $currentUser;

    $data['isJoin'] = in_array($currentUser['id'], array_column($data['users'], 'id'));

    $data['messages'] = $chat->getChatByEventId($eventId);

    return $this->view->render($response, 'event/show.twig', $data);
});
