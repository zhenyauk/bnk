<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activities = $this->getActivities($user);
        // Fix bug with PHP settings' time zone
        $activities['created_at'] = Carbon::parse($activities['created_at'])->addHours(2);


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
