<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $players = Player::with('team')->get();
    
        return view('admin.players.index')->with('players', $players);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $teams = Team::all();

       // dd($teams);
        return view('admin.players.create')->with('teams', $teams);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $teams = Team::all();
        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'dob' => 'required|max:100',
        //     'player_number' =>'required',
        //     'teams_id' => 'required'
        // ]);

        $img = $request->file('img');
        $extension = $img->getClientOriginalExtension();
        $filename = date('Y-m-d-His') . '_' . $request->input('title'). '.'. $extension;

        $path = $img->storeAs('public/images', $filename);
        Player::create([
            // Ensure you have the use statement for
            
            'user_id' => Auth::id(),
            'first_name' =>$request->first_name,
            'last_name' =>$request->last_name,
            'dob' =>  $request->dob,
            'player_number' => $request->player_number,
            'img' => $filename,
            'team_id' => $request->team_id
            
        ]);

        return to_route('admin.players.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if(!Auth::id()) {
            return abort(403);
        }

        $player = Player::where('id', $id)->firstOrFail();
        // if($player->user_id != Auth::user()){
        //     return abort(403);
        // }
        return view('admin.players.show')->with('player', $player);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $player = Player::where('id', $id)->firstOrFail();
        $teams = Team::all();
        return view('admin.players.edit')->with('player', $player)->with('teams', $teams);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // $request->validate([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'dob' => $request->dob,
        //     'player_number' => $request->player_number,
        //     // 'img'=> $request->img
        // ]);

        $player->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'player_number' => $request->player_number,
            'teams_id' => $request->teams_id
            // 'img'=> $request->img
        ]);

        return to_route('admin.players.show', $player);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $player->delete();

        return to_route('admin.players.index');
    }
}
