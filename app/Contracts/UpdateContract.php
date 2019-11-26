<?php

namespace App\Contracts;

interface UpdateContract {
   /**
    * Create an update
    * 
    * @param array $data
    * @return Boolean
    */
   public static function create(array $data);

   /**
    * Push update feed to followers
    * @param $userID
    * @param $postID
    * 
    * @return boolean
    */
   public static function pushUpdate($postID, $userID);
}