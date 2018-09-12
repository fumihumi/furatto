<?php

namespace Model\Dao;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Class EventUser
 *
 * EventUserテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2018/08/28
 * @package Model\Dao
 */
class EventUser extends Dao
{

    // ユーザが参加しているイベントを取得する関数
    public function getEventIdsByUserId($userId)
    {
        $queryBuilder = new QueryBuilder($this->db);

        $queryBuilder
            ->select('event_id')
            ->andWhere("user_id =".$userId)
            ->from($this->_table_name);

        $query = $queryBuilder->execute();

        $result = $query->FetchALL();
        return $result;
    }

  // eventIdから参加しているユーザを取得する関数
    public function getUserIdsByEventId($eventId)
    {
        $queryBuilder = new QueryBuilder($this->db);

        $queryBuilder
            ->select('user_id')
            ->andWhere("event_id =".$eventId)
            ->from($this->_table_name);

            $query = $queryBuilder->execute();

            $result = $query->FetchAll();

            return $result;
    }
}
