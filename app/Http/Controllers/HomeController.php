<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function index(){
        // NOTE Create connection to redis
        $storage = Redis::Connection();

        // NOTE reverse order sorted set all member 
        $popular = $storage->zRevRange('articleViews', 0, -1);

        // NOTE key in redis has prefix "laravel_database_"
        // only display value 
        foreach ($popular as $value) {
            $id = str_replace('article:', '', $value);
            echo 'Article ' . $id . " is popular, reach " . $storage->zScore('articleViews', $value) . " views" . "<br>";
        }
    }
}
