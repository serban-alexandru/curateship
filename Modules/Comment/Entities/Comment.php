<?php

namespace Modules\Comment\Entities;

use Modules\Post\Entities\{Post, PostsTag, PostsMeta};
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    // protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo(\Modules\Users\Entities\User::class, 'user_id');
    }

    public function reply()
    {
    	return $this->hasMany(\Modules\Comment\Entities\Reply::class);
    }

    public function post()
    {
    	return $this->belongsTo(\Modules\Post\Entities\Post::class);
    }
}
