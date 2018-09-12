<?php

namespace Model\Dao;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Class Chat
 *
 * Chat Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2018/08/28
 * @package Model\Dao
 */
class Chat extends Dao{

    public function getChatByEventId($eventId)
    {
        $queryBuilder = new QueryBuilder($this->db);

        $queryBuilder
            ->select('*')
            ->where("event_id =".$eventId)
            ->from($this->_table_name);

        $query = $queryBuilder->execute();

        $result = $query->FetchALL();

        return $result;
    }
}
