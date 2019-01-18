<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-11
 * Time: 18:52
 */

namespace App\Api\Controllers;


use App\Repository\TopicRepository;
use Illuminate\Http\Request;

class TopicController extends Controller{

    protected $topicRepository;

    /**
     * TopicController constructor.
     * @param $topicRepository
     */
    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }


    public function index(Request $request)
    {
        $topics = $this->topicRepository->getTopics($request->get('query'));

        return response()->json([
            'topics' => $topics
        ]);

    }

}