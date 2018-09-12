<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Event;
use Model\Dao\User;
use Model\Dao\EventUser;

$app->post('/event/{id}/participate/', function (Request $request, Response $response, $args) {

    $eventId = $args["id"];

    $params = $request->getParsedBody();

    $userInfo = $this->session["user_info"];
    $currentUserId = $userInfo['id'];

    if (empty($currentUserId)) {
        return $response->withRedirect("/event/".$eventId);
    }

    // ここで参加する処理する
    // flg == 1 だったら参加して０なら削除する??????
    // 一旦参加だけなので FIXME
    // $flg = $params['participate'];

    $eventUserData = array(
        'user_id' => $currentUserId,
        'event_id' => $eventId
    );


    $eventUsers = new EventUser($this->db);
    $eventUsers->insert($eventUserData);

    return $response->withRedirect("/event/".$eventId);
});
