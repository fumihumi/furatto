<?php
use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
// mypageページのコントローラ
$app->get('/mypage/', function (Request $request, Response $response) {

     $user = new User($this->db);
     $currentUserId = $this->session->user_info["id"];

     // $param, "", "", 1,false
     $data = $user->select(array("id" => $currentUserId));

    return $this->view->render($response, 'mypage/index.twig', $data);
});

$app->get('/user/{id}', function (Request $request, Response $response, $args) {

    $user = new User($this->db);

    $data = $user->select(array("id" => $args));

    return $this->view->render($response, 'mypage/index.twig', $data);
});
