<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Event;



// 会員登録ページコントローラ
$app->get('/event/new/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'article/article.twig', $data);

});

// 会員登録処理コントローラ
$app->post('/event/new/', function (Request $request, Response $response) {
    //POSTされた内容を取得します
    $data = $request->getParsedBody();

    //ユーザーDAOをインスタンス化
    $event = new Event($this->db);

    // 今の $data に user_id がいない
    // $data に user_idを追加する処理をする
    $user_info = $this->session["user_info"];
    $data = $data + array('user_id' => $user_info["id"]);

    //DBに登録をする。戻り値は自動発番されたIDが返ってきます
    $id = $event->insert($data);



    // 登録完了ページを表示します。
    return $this->view->render($response, 'article/article_done.twig', $data);
    // return null;
});
