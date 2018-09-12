<?php
use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Event;

$app->get('/event/{id}/edit/', function (Request $request, Response $response, $args) {
  //GETされた内容を取得します。
  $args['id'];

  // $data = $request->getQueryParams();

  $event = new Event($this->db);

  $param["id"] = $args['id'];

  // $result = $event->select($param, "", "", 1, false);
  $data = $event->select($param, "", "", 1, false);

  $startDate = str_replace(" ","T",$data["startDate"]);
  $data["startDate"] = $startDate;

  $endDate = str_replace(" ", "T", $data["endDate"]);
  $data["endDate"] = $endDate;

  // Render index view
  return $this->view->render($response, 'event/edit.twig', $data);
});

// 会員登録処理コントローラ
$app->post('/event/{id}/', function (Request $request, Response $response) {
    //POSTされた内容を取得します
    $data = $request->getParsedBody();

    //ユーザーDAOをインスタンス化
    $event = new Event($this->db);

    // 今の $data に user_id がいない
    // $data に user_idを追加する処理をする
    // $user_info = $this->session["user_info"];
    // $data = $data + array('user_id' => $user_info["id"]);

    // id(event_id)をとる
    // var_dump($args['id']);

    // data にid(event_id)を追加する
    // $data = $data + array('id' => $args['id']);
    //

    // var_dump($data);
    // exit;

    //DBに登録をする。戻り値は自動発番されたIDが返ってきます
    $event->update($data);



    // 登録完了ページを表示します。
    return $this->view->render($response, 'event/edit_done.twig', $data);
    // return null;
});
