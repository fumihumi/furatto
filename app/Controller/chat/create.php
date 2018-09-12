<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Chat;

$app->post('/event/{id}/chat/', function (Request $request, Response $response, $args) {

    $eventId = $args["id"];
    $params = $request->getParsedBody();

    if (empty(trim($params['content']))){
        return $response->withRedirect("/event/".$eventId);
    }

    $userInfo = $this->session["user_info"];
    $currentUserId = $userInfo['id'];

    $content = $params['content']."<br />"."by  ".$userInfo['name'];

    $chatData = array(
        'user_id' => $currentUserId,
        'event_id' => $eventId,
        'content' => $content
    );

    $chat = new Chat($this->db);
    $chat->insert($chatData);

    return $response->withRedirect("/event/".$eventId);
});
