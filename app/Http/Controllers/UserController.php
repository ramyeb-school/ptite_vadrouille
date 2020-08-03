<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use LengthException;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->toArray();
        $infosUsers = [];

        function findmaxuser($users){
            $maxuser = ["experience" => -1];

            for ($i = 0; $i < count($users); $i++) {
                if ($users[$i]['experience'] >  $maxuser["experience"])
                $maxuser = $users[$i];
            }
            return $maxuser;
        }

        while(count($users) != 0){
            $maxuser= findmaxuser($users);
            $key = array_search($maxuser, $users);
            array_splice($users,$key,1);

            array_push($infosUsers,[ "nickname" => $maxuser["nickname"], "description" =>  $maxuser["description"], "experience" => $maxuser["experience"]]);
        }
        // for ($i = 0; $i < count($users); $i++) {
        //     if ($users[$i]->experience >  $maxuser->experience)
        //     $maxuser = $users[$i];
        // }


        

        // for ($i = 0; $i < count($users); $i++) {
        //     $infosUsers[$i] = [ "nickname" => $users[$i]->nickname, "description" => $users[$i]->description, "experience" => $users[$i]->experience];
        // }
        

        // foreach($users as $user){
        //     $infosUsers[$user->id] = [ "nickname" => $user->nickname, "description" => $user->description, "experience" => $user->experience];
        //     // array_push($infosUsers,  [$user->id => [ "nickname" => $user->nickname, "description" => $user->description]]);
        // }
        return view("classement", ["infosUsers"=>$infosUsers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $infos = ["nickname" => $user->nickname,
                "firstname" =>$user->firstname,
                "lastname" => $user->lastname,
                "description" => $user->description,
                "img" => $user->img,
                "experience" => $user->experience,
    ];
        dd($infos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return Validator::make($request, [
            'nickname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->update($request->all());
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = User::findOrFail(Auth::user()->id);
        //redirect à une page
        Auth::logout();
        $user->delete();
        return redirect()->route('login'); 
    }
}
