<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\User;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth', ['except' => ['store', 'create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all();
        dd($places);    
    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {

        return view("PlaceCreate");
    }

    /**
     * attach a favorite place to a user
     *
     */
    public function attachFavorite(Request $request)
    {
        if ($request->ajax()) { 
            $place_id = $request->id;
            $place = Place::findOrFail($place_id);
            $user = User::findOrFail(Auth::user()->id);
            $user->FavoritePlaces()->syncWithoutDetaching($place);
            $places_of_user = $user->FavoritePlaces()->get();
            return response()->json($places_of_user,200);
        }
            abort(404);
    }

    /**
     * detach a favorite place from a user
     *
     */
    public function detachFavorite(Request $request)
    {
        if ($request->ajax()) { 
            $place_id = $request->id;
            $place = Place::findOrFail($place_id);
            $user = User::findOrFail(Auth::user()->id);
            $user->FavoritePlaces()->detach($place);  
            $places_of_user = $user->FavoritePlaces()->get();
            return response()->json($places_of_user,200);

        }
            abort(404);
    }

    /**
     * attach a completed place to a user
     *
     */
    public function attachCompleted(Request $request)
    {
        if ($request->ajax()) { 
            $place_id = $request->id;
            $place = Place::findOrFail($place_id);
            $user = User::findOrFail(Auth::user()->id);
            $user->CompletedPlaces()->syncWithoutDetaching($place);
            $user->experience += 25;
            $user->save();
            $places_of_user = $user->CompletedPlaces()->get();
            return response()->json($places_of_user,200);

        }
            abort(404);
        
    }


    /**
     * detach a completed place from a user
     *
     */
    public function detachCompleted(Request $request)
    {

        if ($request->ajax()) { 
            $place_id = $request->id;
            $place = Place::findOrFail($place_id);
            $user = User::findOrFail(Auth::user()->id);
            $user->CompletedPlaces()->detach($place);
            $user->experience -= 25;
            $user->save();
            $places_of_user = $user->CompletedPlaces()->get();
            return response()->json($places_of_user,200);

        }
            abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $place = new Place();
        $place->name = $request->name;
        $place->type = $request->type;
        $place->lng = $request->lng;
        $place->lat = $request->lat;
        $place->departement = $request->dep;
        $place->adr = $request->adr;
        if($request->hasfile('img') != null){
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/place/', $filename);
            $place->img = $filename;
        } else {
            return $request;
            $place->img = '';
        }
        $place->save();
        return view("PlaceCreate");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
    }
}