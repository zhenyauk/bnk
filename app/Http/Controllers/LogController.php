<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{

    public function index()
    {
        $logs = Log::where('user_id', Auth::id())->paginate(35);
        return view('admin.pages.logs', compact('logs'));
    }
}
