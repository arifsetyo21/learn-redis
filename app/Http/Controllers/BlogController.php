<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BlogController extends Controller
{
   public function showArticle($id){
      $storage = Redis::connection();

      $views = $storage->incr('article:' . $id . ':views');
      return "this is an article with id: " . $id . " it has " . $views . " views";
   }
}
