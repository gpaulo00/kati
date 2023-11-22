<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Notification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\ConsoleOutput;

class AppController extends Controller
{
    //
    public function profile(Request $request)
    {
        return view('dashboard');
    }

    public function notifications(Request $request)
    {
        $notif = Notification::all();
        return view('notifications', [
            'notifications' => $notif,
        ]);
    }
}
