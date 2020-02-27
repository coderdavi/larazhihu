<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Question
 * @package App
 */
class Question extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * @return BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }


    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('is_hidden', 'F');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_question')->withTimestamps();
    }
}
