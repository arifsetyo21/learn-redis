<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis as Redis;
use App\Contracts\UpdateContract as UpdateContract;

class Update extends Model implements UpdateContract
{
   /**
    * Craete post with unique ID
    * @param array $data
    * 
    * @return $postID
    * @return boolean 
   */ 
   public static function create( array $data ){
      //  get unique post id
      $postID = Redis::incr('next_post_id');

      $time = time();

      // Create post message
      $postSuccess = Redis::hmset('post:' . $postID, [
         'user_id' => $data['userID'],
         'time' => $time,
         'text' => $data['update']
      ]);

      if($postSuccess){
         // Push update to followers after successful creation
         if ( Update::pushUpdate($postID, $data['userID'])) {
            // Everything successed, so return the new post's ID
            return $postID;
         }
         // Unsuccessful push to followers, Delete post and decrement ID
         // in real world case we could queue and try again or give user another chance
         Redis::delete('post:', $postID);
         Redis::decr('next_post_id');
      }
      
      return false;
   }

   /**
    * Push post to all followers with $postID parameter and $userID 
    * @param $postID
    * @param $userID
    * 
    * @return boolean
   */ 
   public static function pushUpdate($postID, $userID){
      // Get all the user's follower
      $followers = Redis::zRange('followers:' . $userID, 0, -1);

      // Include update author
      $followers[] = $userID;

      // Push the update to all follower
      foreach ($followers as $followerID) {
         $pushSuccess = Redis::lpush('posts:' . $followerID, $postID);
      }

      // Success of update push to follower
      if($pushSuccess) {
         return true;
      }

      return false;
   }

   /**
    * Get updates associated with specific IDs
    * 
    * @param $postIDs
    * @return array posts
   */ 
   public function getPosts($postIDs){
      // kumpulkan posts
      $posts = [];

      foreach ($postIDs as $post) {
         // get all field and value in the hash
         $posts[$post] = Redis::hGetAll('post:' . $post);
         
         // get username of user who wrote posts
         $username = Redis::hGet('user:' . $posts[$post]['user_id'], 'username');

         // add username to array
         $posts[$post]['username'] = $username;
      }

      return $posts;


      // add username to array
   }



}
