<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Symfony\Component\Console\Output\ConsoleOutput;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login', ['error' => 'Hello']);
    }

    public function login(Request $request) {
        $output = new ConsoleOutput();
        $output->writeln("<info>Error message</info>");
        $user = $request->post('username');
        $pass = $request->post('password');

        $student = Student::where('cedula', $user)->get();
        if (!$student) {
            return view('login', [
                'error' => 'No se encontró el usuario ' . $user,
            ]);
        }

        return view('login', [
            'error' => 'Bienvenido ' . $user,
        ]);
    }
}
