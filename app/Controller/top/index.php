<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Event;
use Model\Dao\User;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $events_dao = new Event($this->db);
    $users_dao = new User($this->db);
    $events = $events_dao->select([], "startDate", "DESC", 1000000000, true);

    // 登録されたeventごとに紐づけられたuserのnameを取り出し，hostに格納する
    foreach($events as $key => $event)
    {
      $param["id"] = $event["user_id"];
      $events[$key]['host'] = $users_dao->select($param, "", "", 1, false);
    }

    $data["events"] = $events;

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});
