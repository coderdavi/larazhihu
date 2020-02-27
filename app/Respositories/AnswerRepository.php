<?php
namespace App\Repositories;

use App\Answer;

/**
 * Class AnswerRepository
 * @package App\Repositories
 */
class AnswerRepository
{

    /**
     * @param array $attributes
     * @return \App\Answer
     */
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Answer::find($id);
    }
}