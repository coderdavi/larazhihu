<?php
namespace App\Repositories;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository
{
    /**
     * @param array $attributes
     * @return Comment|Model
     */
    public function create(array $attributes)
    {
        return Comment::create($attributes);
    }
}