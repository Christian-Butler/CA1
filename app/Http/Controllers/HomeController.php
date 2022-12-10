<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
 
    public function _construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index (Request $request)
     {
        $user = Auth::user();
        $home = 'home';

        if ($user->hasRole('admin')){
            $home = 'admin.players.index';
        }
        else if ($user->hasRole('user')){
            $home = 'user.players.index';
        }
        return redirect()->route($home);
     }

     public function teamsIndex (Request $request)
     {
        $user = Auth::user();
        $home = 'home';

        if ($user->hasRole('admin')){
            $home = 'admin.teams.index';
        }
        else if ($user->hasRole('user')){
            $home = 'user.teams.index';
        }
        return redirect()->route($home);
     }

}
