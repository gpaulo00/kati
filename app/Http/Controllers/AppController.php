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

    public function password(Request $request)
    {
        $notif = Notification::all();
        return view('password', [
        ]);
    }

    public function change_password(Request $request)
    {
        $pess = $request->post('confirm');
        $pass = $request->post('password');
        if ($pass != $pess) {
            return view('password', [
                'error' => 'Las contraseñas no coinciden'
            ]);
        }

        $user = Student::find($request->session()->get('auth_user')->id);
        $user->clave = password_hash($pass, PASSWORD_BCRYPT);
        $user->save();

        return view('password', [
            'message' => 'Se realizo el cambio exitosamente!',
        ]);
    }
}
