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

    // notifications
    public function notifications(Request $request)
    {
        $notif = Notification::all();
        return view('notifications', [
            'notifications' => $notif,
        ]);
    }
    public function notif_edit(Request $request, Notification $notif)
    {
        $input = $request->all();
        $notif->fill($input)->save();
        return back()->with('message', 'Se actualizó el registro con éxito!')->with('alert-class', 'alert-success');
    }
    public function notif_delete(Notification $notif)
    {
        $notif->delete();
        return back()->with('message', 'Se eliminó el registro con éxito!')->with('alert-class', 'alert-success');
    }
    public function notif_create(Request $request)
    {
        Notification::create($request->all());
        return back()->with('message', 'Se creó el registro con éxito!')->with('alert-class', 'alert-success');
    }

    // passwords
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
