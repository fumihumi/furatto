<?php
use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;

// mypageページのコントローラ
$app->get('/mypage/', function (Request $request, Response $response) {

    //
    // //ユーザーDAOをインスタンス化
    //
     $user = new User($this->db);
     $currentUserId = $this->session->user_info["id"];

     // $param, "", "", 1,false
     $data = $user->select(array("id" => $currentUserId));



     // $param["name"]=$param["name"];
     // $param["email"] = $data["email"];
     // $param["github_id"] = $data["gihub_id"];
     // $param["twitter_id"] = $data["twitter_id"];

    // Render index view
    return $this->view->render($response, 'mypage/index.twig', $data);
});
