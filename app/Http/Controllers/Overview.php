<?php

namespace App\Http\Controllers;

use App\Resource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Overview extends Controller
{
        /**
     * Get all users data for overview
     */
    public function index(Request $request) {
        if(Auth::check()) {


         $r = User::select('*')
                ->join('resources', 'users.id', '=', 'resources.user_id')
                ->join('accounts', 'resources.ac_id', '=', 'accounts.id')
                ->where('users.id', '=', Auth::user()->id)
                ->orderBy('ac_id')
                ->get();

            // dd($r);

            $resources = User::find(Auth::user()->id)->resources;
            // $resources = User::find(Auth::user()->id)->accounts;
            // dd($resources);

            $s = User::select('*')
            ->join('speeds', 'users.id', '=', 'speeds.user_id')
            ->join('accounts', 'speeds.ac_id', '=', 'accounts.id')
            ->where('users.id', '=', Auth::user()->id)
            ->orderBy('ac_id')
            ->get();

        // dd($r);

            return view('overview', ['resData' => $r, 'speedData' => $s]);
        } else {
            return [1000=>2];
        }
    }
}
