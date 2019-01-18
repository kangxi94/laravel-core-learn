<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-10
 * Time: 09:50
 */

namespace App\Service;
use App\Repository\TopicRepository;
use App\Topic;

class TopicService {

    protected $topicRepositoy;

    /**
     * TopicService constructor.
     * @param $topicRepositoy
     */
    public function __construct(TopicRepository $topicRepositoy)
    {
        $this->topicRepositoy = $topicRepositoy;
    }

    /**
     * @param array $topics
     * @return array
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic) {
            if ( is_numeric($topic) ) {
                Topic::find($topic)->increment('post_count');
                return $topic;
            }
            $newTopic = $this->topicRepositoy->createTopic(['name' => $topic, 'post_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }

}