<?php
use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Event;
use Model\Dao\EventUser;

// mypageページのコントローラ
$app->get('/mypage/', function (Request $request, Response $response) {

     $user = new User($this->db);
     $currentUserId = $this->session->user_info["id"];
     $event = new Event($this->db);
     $eventUser = new EventUser($this->db);
     $data["user"] = $user->select(array("id" => $currentUserId));

     $eventIds = $eventUser->getEventIdsByUserId($currentUserId);
     if (count($eventIds)) {
         $data['events'] = $event-> getEventByIds($eventIds);
     } else {
         $data['events'] = [];
     }
     foreach ($data['events'] as $event) {
         $data['categories'] = explode(', ', $event['categories']);
     }

     $data['is_mypage'] = true;

    return $this->view->render($response, 'mypage/index.twig', $data);
});

$app->get('/user/{id}/', function (Request $request, Response $response, $args) {
    $user = new User($this->db);
    $event = new Event($this->db);
    $eventUser = new EventUser($this->db);
    $userId = $args['id'];

    $data["user"] = $user->select(array("id" => $userId));

    $eventIds = $eventUser->getEventIdsByUserId($userId);
    if (count($eventIds)) {
        $data['events'] = $event->getEventByIds($eventIds);
    } else {
        $data['events'] = [];
    }

    foreach ($data['events'] as $event) {
        $data['categories'] = explode(', ', $event['categories']);
    }

    return $this->view->render($response, 'mypage/index.twig', $data);
});

$app->get('/mypage/edit', function (Request $request, Response $response) {

     $user = new User($this->db);
     $currentUserId = $this->session->user_info["id"];

     $data["user"] = $user->select(array("id" => $currentUserId));

    return $this->view->render($response, 'mypage/index.twig', $data);
});
