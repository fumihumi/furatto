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

     $data["user"] = $user->select(array("id" => $currentUserId));

    return $this->view->render($response, 'mypage/index.twig', $data);
});

$app->get('/user/{id}', function (Request $request, Response $response, $args) {
    $user = new User($this->db);
    $event = new Event($this->db);
    $eventuser= new EventUser($this->db);
    $user_id= $args['id'];

      $data["user"] = $user->select(array("id" => $user_id));

      $data["event"]=$eventuser->select(array("user_id" => $event));

    return $this->view->render($response, 'mypage/index.twig', $data);

});
