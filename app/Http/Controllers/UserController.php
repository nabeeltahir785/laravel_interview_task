<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Constant;
use App\Http\Requests\UserUpdateRequest;
use App\Http\services\UserService;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    //

    public function index(){
        $users = $this->userService->getUserData(Constant::BASE_URL);
        $this->save($users);
        $userData = User::take(5)->get();
        $limit = 5;
        $offset = 0;
        $page = 1;
        return view('users')
                ->with('users',$userData)
                ->with('page',$page)
                ->with('offset',$offset)
                ->with('limit',$limit);
    }

    public function getUserData(Request $request){
        $users = $this->userService->getUserData(Constant::BASE_URL);
        $this->save($users);
        $userData = User::offset($request["offset"])->limit($request["limit"])->get();
        return response()->json(['users'=>$userData]);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $user = User::findOrFail($id);
        return view('edit')->with('user',$user);
    }

    public function update(UserUpdateRequest $request, $id){
        $validated = $request->validated();
        User::whereId($id)->update($validated);
        return redirect('/user');
    }

    /**
     * @param $users
     */
    public function save($users):void{
        foreach($users->results as $user ){
            $userObject = new User;
            $userObject->title = $user->name->title;
            $userObject->first = $user->name->first;
            $userObject->last = $user->name->last;
            $userObject->email = $user->email;
            $userObject->street = $user->location->street->number . $user->location->street->name;
            $userObject->city = $user->location->city;
            $userObject->state = $user->location->state;
            $userObject->country = $user->location->country;
            $userObject->passcode = $user->location->postcode;
            $userObject->save();
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport(), 'users.csv');
    }
}
