<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-10
 * Time: 09:53
 */

namespace App\Repository;
use App\Topic;


class TopicRepository {

    /**
     * @return mixed
     */
    public function getTopics($query)
    {
        return Topic::where('name','like','%'.$query.'%')->get();
    }

    public function createTopic($params)
    {
        return Topic::create($params);
    }

}