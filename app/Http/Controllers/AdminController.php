<?php

namespace App\Http\Controllers;

use Cache;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{

    public function showAddArticle(){
        return view('admin.add');
    }

    public function addArticle(Request $request){
        
        $isValid = \Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'tags' => 'required',
            'content' => 'required'
        ])->validate();

        // return dd($isValid);
        if ($isValid) {

            // $post = new Post();
            $result = Post::create($isValid);

            // return dd($result);
            Redis::connection();

            if($request->tags != ''){
                $tags = \explode(', ', trim($request->tags));
                // return dd($tags);
                foreach( $tags as $tag){
                    // Menambahkan member ke dalam sorted sets dengan key article:tag:nama_tag 
                    Redis::zadd('article:tag:' . trim($tag), $result->id, $result->id);
                    // Menambahkan data kayak array ke key yang bertipe sets
                    Redis::sadd('article:' . $result->id . ':tags', trim($tag));
                    // Menambahkan tag ke daftar tag yang bertipe sets
                    Redis::sadd('article:tags', trim($tag));
                }

                // Menghapus cached query di redis
                Cache::clear();
            }

            return redirect()->route('blog')->with(['status' => 'sukses']);
        }

    }
}
