<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\ConsoleOutput;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login', ['error' => 'Hello']);
    }

    public function login(LoginRequest $request) {
        $request->session()->regenerate();
 
        $output = new ConsoleOutput();
        $output->writeln("<info>Error message</info>");
        $user = $request->post('username');
        $pass = $request->post('password');

        $student = Student::where('cedula', $user)->first();
        if (!$student) {
            return view('login', [
                'error' => 'No se encontró el usuario ',
                'user' => $user,
            ]);
        }

        if(!password_verify($pass, $student->clave)) {
            return view('login', [
                'error' => 'Contraseña incorrecta',
                'user' => $user,
            ]);
        }

        $request->session()->put('auth', true);
        $request->session()->put('auth_user', $student);
        return view('login', [
            'error' => 'Bienvenido ' . $user,
        ]);
    }
}
