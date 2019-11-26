<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis as Redis;
use Illuminate\Http\Request;
use App\FeedUser as FeedUser;
use App\Update;
use App\Contracts\UpdateContract as UpdateContract;
use App\Services\UpdateRegistrar as UpdateRegistrar;

class UserController extends Controller
{
    public function __construct(Update $update, UpdateRegistrar $updateRegistrar){
        $this->update = $update;
        $this->updateRegistrar = $updateRegistrar;
    }

    public function showAddUpdate($id){
        return view('user.update')->with('userID', $id);
    }

    public function doAddUpdate($id, Request $request){
        
        // validasi input
        $isValid = $this->updateRegistrar->validator($request->all());
        // $isValid = \Validator::make($request->all(), [
        //     'update' => $request->update,
        // ])->validate();

        if($isValid){
            // create update
            $result = $this->updateRegistrar->create($isValid, $id);

            if($result) {
                // updated post, redirect to newsfeed
                // return view('user.newsfeed')->with(['message' => 'Update successfully posted', 'user_id' => $id]);
                return redirect()->route('feed', ['id' => $id])->with(['message' => 'Update successfully posted', 'user_id' => $id]);
            }
        }
        // update didnt post successfully
        return view('update')->with('message', 'Update didnt post. please try again');
    }

    /**
     * Show user news feed
     * 
     * @param $userID
     * @return Respose
     */
    public function showFeed($userID){
        // Get 40 posts from people user follows
        Redis::ltrim('posts:' . $userID, 0, 100);

        // Get posts ID
        $postIDs = Redis::lRange('posts:' . $userID, 0, 100);

        // Get post information from IDs
        $posts = $this->update->getPosts($postIDs);

        return view('user.newsfeed')->with(['posts' => $posts]);
    }

    /**
     * Show user list with static getUserList static method
     * 
     * @param $id
     * @return Response
    */
    public function showUserList($id){

        if ($users = FeedUser::getUserList($id, -1)){
            $current_user = ['username' => Redis::hget('user:' . $id, 'username'), 'id' => $id];
            return view('user.userList')->with(['users' => $users, 'current_user_id' => $current_user]);
        }
        
        return view('user.userList')->with('message', 'No User to follow');
    }

    /**
     * Follow a User
     * 
     * @param $id
     * @param $userID
     * @return Response
    */
    public function followUser($id, $userID){
        if( FeedUser::followUser($id, $userID))
            return view('user.followSuccess')->with(['message' => 'Successfully followed user.', 'user_id' => $id]);
        
        return view('user.followSuccess')->with(['message' => 'Follow failed, please try again', 'user_id' => $id]);
    }


}
