<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Place;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $places = Place::all();
        $places_of_user = $user->CompletedPlaces()->get();
        $Favplaces_of_user = $user->FavoritePlaces()->get();
        return view("home", ["user"=>$user, "places_favorite"=>$Favplaces_of_user, "places_completed"=>$places_of_user, "places"=>$places]);
    }

    public function placeFromDep(Request $request)
    {
        if ($request->ajax()) { 
            $places = Place::where('departement','=',$request->code_dep_selected)->get();
            // return response();
            return response()->json($places);

        }
            abort(404);
    }

}