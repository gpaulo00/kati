<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Student;
use App\Models\Notification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\ConsoleOutput;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {
        $notif = Notification::all();
        return view('login', [
            'notifications' => $notif,
        ]);
    }

    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function login(LoginRequest $request) {
        $request->session()->regenerate();
        $user = $request->post('username');
        $pass = $request->post('password');
        $notif = Notification::all();

        $student = Student::where('cedula', $user)->first();
        if (!$student) {
            return view('login', [
                'notifications' => $notif,
                'error' => 'No se encontró el usuario',
                'user' => $user,
            ]);
        }

        if(!password_verify($pass, $student->clave)) {
            return view('login', [
                'notifications' => $notif,
                'error' => 'Contraseña incorrecta',
                'user' => $user,
            ]);
        }

        $request->session()->put('auth', true);
        $request->session()->put('auth_user', $student);
        return redirect()->route('profile');
    }
}
