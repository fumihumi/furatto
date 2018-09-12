<?php

namespace Model\Dao;

use Doctrine\DBAL\Query\QueryBuilder;
/**
 * Class User
 *
 * Userテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2018/08/28
 * @package Model\Dao
 */
class User extends Dao
{

  // userIdのArrayからユーザのArrayを返却する
    public function getUsersByIds($ids)
    {
        $queryBuilder = new QueryBuilder($this->db);

        $queryBuilder
            ->select('*')
            ->andWhere("id in"."(".implode(',', array_column($ids, 'user_id')).")")
            ->from($this->_table_name);

        $query = $queryBuilder->execute();

        $result = $query->FetchALL();

        return $result;
    }

}
