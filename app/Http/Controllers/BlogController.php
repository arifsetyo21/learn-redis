<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Contracts\PostContract as PostContract;

class BlogController extends Controller
{

   private $post;

   public function __construct(PostContract $post){
      $this->post = $post;
   }

   public function showBlog(){

      DB::connection()->enableQueryLog();

      $tags = Redis::sRandMember('article:tags', 4);

      $post = $this->post->fetchAll();

      $log = DB::getQueryLog();

      print_r($log);

      return view('home')->with(['posts' => $post, 'tags' => $tags]);
   }

   public function showArticle($id){

      // fetch post
      $article = $this->post->fetch($id);

      if ($article) {
         // FIXME store keys to redis has prefix "laravel_database_", this should be remove
         // NOTE Resolve with add key "REDIS_PREFIX=''" in .env file
         $storage = Redis::connection();
         $this->id = $article->id;
         
         // NOTE check is value article:{id} exists or not in stored set 'articleViews'
         if( $storage->zScore('articleViews', 'article:' . $id)) {
            // NOTE Pipelining should be used when you need to send many commands to the server in one operation. The pipeline method accepts one argument.
            $storage->pipeline(function ($pipe){
               // NOTE Increment a value in stored sets 'articleViews' with 1 and in the article:id
               $pipe->zIncrBy('articleViews', 1, 'article:'. $this->id);
               // NOTE Pemisahan key dengan colon agar dalam proses pemisahan lebih mudah
               $pipe->incr('article:' . $this->id . ':views');
            });
         } else {
            // NOTE Increment value in key article:{id}:views
            $views = $storage->incr('article:' . $this->id . ':views');
            // NOTE Increment value in stored sets with 
            $storage->zIncrBy('articleViews', $views, 'article:' . $this->id);
         }
         $tags = $storage->smembers('article:' . $this->id . ':tags');
         $views = $storage->get('article:' . $this->id . ':views');
   
         return view('blog.article')->with(['article' => $article, 'views' => $views, 'tags' => $tags]);
         // return "this is an article with id: " . $id . " it has " . $views . " views";
      } 
      
   }

   public function filteredShowBlog($tag){
      DB::connection()->enableQueryLog();

      $articles_id = Redis::zRange('article:tag:' . $tag, '0', '-1');

      $posts = $this->post->filteredFetch($articles_id);

      $tags = Redis::sRandMember('article:tags', 4);

      $log = DB::getQueryLog();

      print_r($log);
      
      return view('home')->with(['posts' => $posts, 'tags' => $tags]);
   }
}
