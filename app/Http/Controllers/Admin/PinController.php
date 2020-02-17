<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PinController extends Controller
{

    public function getPins()
    {
        if(Auth::user()->role !== 'admin'){
            abort('403');
        }


        Pin::where('id', '>', 0)->delete();


        $users = User::all();

        foreach ($users as $user){
            $this->makePin($user->id);
        }
        return view('admin.pages.pin', compact('users'));
    }

    public function makePin($uid)
    {
        $pin = new Pin();
        $pin->user_id = $uid;
        $pin->pin = Str::random(1) . rand(11111, 99909);
        $pin->save();
        return $pin;
    }


}
