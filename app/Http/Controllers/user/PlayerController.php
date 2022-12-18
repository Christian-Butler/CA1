<?php

namespace App\Http\Controllers\User;

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
        $user->authorizeRoles('user');

         $players = Player::paginate(5);
         $players = Player::with('team')->get();
        // dd($players);
        return view('user.players.index')->with('players', $players);
    }
    
    public function show( $id)
    {

        $player = Player::where('id', $id)->firstOrFail();
        if(!Auth::id()) {
            return abort(403);
          }
        return view('user.players.show')->with('player', $player);
    }

    
    
}
