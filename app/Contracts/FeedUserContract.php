<?php 

namespace App\Contracts;

interface FeedUserContract {
   /**
    * Get a list of User
    * 
    * @param $num
    * @param $userID
    * 
    * @return Boolean
   */
   public static function getUserList($userID, $num);

   
   /**
    * do Follow a specific user 
    * with add ID user to sorted sets following in $currentUserID and add ID User to sorted sets follower in $followUserID
    * 
    * @param $followUserID
    * @param $currentUserID
    * @return Boolean
   */
   public static function followUser($currentUserID, $followUserID);

}