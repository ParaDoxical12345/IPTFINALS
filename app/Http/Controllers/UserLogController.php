<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class UserLogController extends Controller
{
    public function index()
    {
        return view('logs', [
            'logs' => Log::all()
        ]);
    }
}
