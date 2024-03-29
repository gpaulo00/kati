<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Notification;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Builder;

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

    // estudiantes
    public function student_create(Request $request)
    {
        $user = new Student();
        $user->fill($request->all());

        if (!isset($user->clave) || empty($user->clave)) {
            $user->clave = str_pad($user->cedula, 8, "0", STR_PAD_LEFT);
        }
        $user->clave = password_hash($user->clave, PASSWORD_BCRYPT);
        $user->toUpperCase();
        $user->save();
        return redirect()->route('students.form.edit', ["user" => $user->id])
            ->with('message', 'Se creó el registro con éxito!')->with('alert-class', 'alert-success');
    }
    public function student_edit(Request $request, Student $user)
    {
        $input = $request->all();
        $user->fill($input)->save();
        return back()->with('message', 'Se actualizó el registro con éxito!')->with('alert-class', 'alert-success');
    }
    public function student_table(Request $request)
    {
        $search = $request->query("search");

        // query
        $data = Student::query()->where(function (Builder $query) {
            $query->where('superuser', null)->orWhere('superuser', false);
        });
        if (isset($search)) {
            $data->where(function (Builder $query) use ($search) {
                $query->where('nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('apellido', 'LIKE', '%' . $search . '%')
                    ->orWhere('cedula', 'LIKE', '%' . $search . '%');
            });
        }
        if ($request->query('nivel_educacion') != null) {
            $data->where('nivel_educacion', $request->query("nivel_educacion"));
        }

        // vista
        return view('forms/tabla_estudiantes', [
            'users' => $data->paginate(5)->appends('search', $request->search),
        ]);
    }
    public function student_form_create()
    {
        return view('forms/estudiante', []);
    }
    public function student_form_edit(Student $user)
    {
        return view('forms/estudiante', [
            'user' => $user,
        ]);
    }
    public function student_searcher()
    {
        return view('forms/buscar_estudiante', []);
    }
    public function student_form_edit2(Request $request)
    {
        $user = $request->query('cedula');
        $student = Student::where('cedula', $user)->first();
        if (!$student) {
            return back()->with('message', 'El estudiante no está registrado')->with('alert-class', 'alert-danger');
        }
        return view('forms/estudiante', [
            'user' => $student,
        ]);
    }

    // workens
    public function worker_table(Request $request)
    {
        $search = $request->query("search");

        // query
        $data = Worker::query();
        if (isset($search)) {
            $data->where(function (Builder $query) use ($search) {
                $query->where('nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('apellido', 'LIKE', '%' . $search . '%')
                    ->orWhere('cedula', 'LIKE', '%' . $search . '%');
            });
        }

        // vista
        return view('forms/tabla_trabajadores', [
            'users' => $data->paginate(5)->appends('search', $request->search),
        ]);
    }
    public function worker_form_create()
    {
        return view('forms/trabajador', []);
    }
    public function worker_form_edit(Worker $user)
    {
        return view('forms/trabajador', [
            'user' => $user,
        ]);
    }
    public function worker_create(Request $request)
    {
        $user = new Worker();
        $user->fill($request->all());
        // does not contain password
        $user->toUpperCase();
        $user->save();
        return redirect()->route('workers.form.edit', ["user" => $user->id])
            ->with('message', 'Se creó el registro con éxito!')->with('alert-class', 'alert-success');
    }
    public function worker_edit(Request $request, Worker $user)
    {
        $input = $request->all();
        $user->fill($input)->save();
        return back()->with('message', 'Se actualizó el registro con éxito!')->with('alert-class', 'alert-success');
    }
    public function worker_searcher()
    {
        return view('forms/buscar_trabajador', []);
    }
    public function worker_form_edit2(Request $request)
    {
        $user = $request->query('cedula');
        $worker = Worker::where('cedula', $user)->first();
        if (!$worker) {
            return back()->with('message', 'El trabajador no está registrado')->with('alert-class', 'alert-danger');
        }
        return view('forms/trabajador', [
            'user' => $worker,
        ]);
    }

    // passwords
    public function password(Request $request)
    {
        $notif = Notification::all();
        return view('password');
    }

    public function change_password(Request $request)
    {
        $pess = $request->post('confirm');
        $pass = $request->post('password');
        if (!isset($pass) || empty($pass) || !is_string($pass) || strlen((string)$pass) < 8) {
            return back()->with('message', 'La contraseña es inválida')->with('alert-class', 'alert-danger');
        }
        if ($pass != $pess) {
            return back()->with('message', 'Las contraseñas no coinciden')->with('alert-class', 'alert-danger');
        }

        $user = Student::find($request->session()->get('auth_user')->id);
        $user->clave = password_hash($pass, PASSWORD_BCRYPT);
        $user->save();

        return back()->with('message', 'Se realizo el cambio exitosamente!')->with('alert-class', 'alert-success');
    }
}
