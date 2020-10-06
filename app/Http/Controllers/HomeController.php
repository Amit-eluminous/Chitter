<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserHasPostsModel;
use App\User;
use App\Models\UserHasFollowersModel;
// Request
use App\Http\Requests\PostChitRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
                                UserHasPostsModel $UserHasPostsModel,
                                User $User,
                                UserHasFollowersModel $UserHasFollowersModel
                                )
    {
        
        $this->ViewData                 = [];
        $this->UserHasPostsModel        = $UserHasPostsModel;
        $this->User                     = $User;
        $this->UserHasFollowersModel    = $UserHasFollowersModel;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getPostedChits()
    {
        //Get followed users
        $userFollowed = $this->User->with('hasFollowed')
                              ->where('id','=',auth()->user()->id)
                              ->first();
        $followed_ids = [];
        if(!empty($userFollowed)){
            $followed_ids = array_column($userFollowed->hasFollowed->toArray(), "followed_user_id");
        } 

        array_push($followed_ids, auth()->user()->id);

        $posts = $this->UserHasPostsModel->with('assignedUser')
                        ->whereIn('user_id',$followed_ids)
                        ->orderBy('id','DESC')
                        ->get();

        $this->ViewData['posts'] = $posts;
        return view('posted-chits',$this->ViewData);
    }

    public function postStore(PostChitRequest $request)
    {

        $collection = new $this->UserHasPostsModel;
        $collection = $this->_storeOrUpdate($collection,$request);

        return redirect()->route('home')->with('success','Post created successfully.');
    }

    public function _storeOrUpdate($collection, $request)  
    {
        $collection->user_id   = auth()->user()->id;
        $collection->post      = $request->post;
        $collection->save();
        
        return $collection;
    }


    public function followUsers(Request $request,$followId=false)
    {
        //Follow & Unfollow Users
        if(!empty($followId)){
            $checkRecordExist = $this->UserHasFollowersModel
                                     ->where('user_id',auth()->user()->id)
                                     ->where('followed_user_id',$followId)
                                     ->first();
            if(!empty($checkRecordExist)){
                
                $this->UserHasFollowersModel->where('id',$checkRecordExist->id)->delete();
                return redirect()->route('followusers.list')
                        ->with('success','UnFollowed successfully.');
            }else{
                $UserHasFollowersModel                     = new $this->UserHasFollowersModel;
                $UserHasFollowersModel->user_id            = auth()->user()->id;
                $UserHasFollowersModel->followed_user_id   = $followId;
                $UserHasFollowersModel->save();

                return redirect()->route('followusers.list')
                        ->with('success','Followed successfully.');
            }
        }    

        //Get followed users
        $userFollowed = $this->User->with('hasFollowed')
                              ->where('id','=',auth()->user()->id)
                              ->first();
        $followed_ids = [];
        if(!empty($userFollowed)){
            $followed_ids = array_column($userFollowed->hasFollowed->toArray(), "followed_user_id");
        }     

        //Get other users
        $otherUsers = $this->User
                      ->where('id','!=',auth()->user()->id)
                      ->get();      

        $this->ViewData['other_users'] = $otherUsers;
        $this->ViewData['followed_ids'] = $followed_ids;

        return view('users',$this->ViewData);
    }
}
