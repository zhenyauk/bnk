<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activities = $this->getActivities($user);

        return view('admin.pages.home', compact('user', 'activities'));
    }

    public function getActivities($user)
    {
        if( $activities = Activity::whereUserId($user->id)
            ->latest()
            ->limit(2)
            ->get()
            ->toArray() )
        return  array_pop($activities);

        return null;
    }

}
