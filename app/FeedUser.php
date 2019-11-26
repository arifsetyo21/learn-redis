<?php

namespace App;

use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\FeedUserContract as FeedUserContract;

class FeedUser extends Model implements FeedUserContract
{
    public static function getUserList($userID, $num){
        
        // Get users
        $userList = Redis::lRange('users', 0, $num);

        if ($userList != '') {
            $users = [];

            foreach ($userList as $user) {
                // we need just the ID number for the follow URL
                $filteredID = \str_replace('user:', '', $user);

                // Don't show the current user
                if ($filteredID != $userID) {
                    $users[$user]['username'] = \ucfirst(Redis::hGet($user, 'username'));
                    $users[$user]['id'] = $filteredID;
                }
            }
            return $users;
        }
        return false;
    }

    public static function followUser($currentUserID, $followUserID){
        
        // Add current user id to list of followers for user being followed
        $followers = Redis::zadd('followers:' . $followUserID, time(), $currentUserID);

        // add follow user id to current user id following list
        $following = Redis::zadd('following:' . $currentUserID, time(), $followUserID);

        return true;
    }
}
