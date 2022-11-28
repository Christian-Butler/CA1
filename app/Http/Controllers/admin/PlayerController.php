<?php

namespace App\Http\Controllers\Admin;

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
        $user = authorizeRoles('admin');

         $players = Player::paginate(10);
        // dd($players);
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
        $user = authorizeRoles('admin');
        return view('admin.players.create');

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required|max:100',
            'player_number' =>'required'
        ]);

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
            'img' => $filename
            
        ]);

        return to_route('players.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player = Player::where('id', $id)->firstOrFail();
        if($player->user_id != Auth::user()){
            return abort(403);
        }
        return view('players.show')->with('player', $player);
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
        return view('players.edit')->with('player', $player);
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
            'player_number' => $request->player_number
            // 'img'=> $request->img
        ]);

        return to_route('players.show', $player);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();
    

        return to_route('players.index');
    }
}
