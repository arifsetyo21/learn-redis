<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\PostContract as PostContract;

class Post extends Model implements PostContract
{
    /**
     * The database table used the model
     * 
     * @var string
     */ 
    protected $table = 'blog_posts';

    /**
     * The attribute that mass assignable
     * 
     * @var array
    */
    protected $fillable = ['title', 'author', 'content'];

    public function fetchAll(){

        $result = Cache::remember('blog_posts_cache', now()->addMinutes(1), function () {
            return $this->get();
        });

       return $result;
    }

    public function fetch($id){

        $this->id = $id;

        // $redis = new Redis();
        Redis::pipeline(function ($pipe) {
            // Increment number for count viewer in sorted sets for display popular post
            $pipe->zIncrBy('articleViews', 1, 'article:' . $this->id);

            // Increment number for count viewer with string data structured
            // $pipe->incr('article:' . $this->id . ':views');
        });

        return $this->where('id', $id)->first();
    }

    public function filteredFetch($ids){
        return $this->whereIn('id', $ids)->get();
    }

    public function getViews(){

    }

    public function getPostViews($id){

    }

}
