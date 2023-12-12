<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
* {
    font-family: Arial;
}

.gp-title {
    text-align: center;
    font-size: 14pt;
    text-decoration: underline;
    text-transform: uppercase;
}

.gp-sub {
    text-decoration: underline;
    /*border-bottom: 1px solid;*/
}

.gp-sub2:after {
    content: "\00a0\00a0";
}
.gp-sub2:before {
    content: "\00a0\00a0";
}

p.gp-first {
  text-indent: 20px;
  text-align: justify;
  font-size: 12pt;
  margin: 0 30pt;
  line-height: 2.5;
}
</style>
</head>
<body>
    @php
        if (\Request::get('id')) {
            $user = \App\Models\Student::find(\Request::get('id'));
        } else {
            $user = \App\Models\Student::find(Session::get('auth_user')->id);
        }
    @endphp

    <h1 class="gp-title">CONSTANCIA DE ESTUDIOS</h1>
    <br><br><br>
    <p class="gp-first">
        Quien suscribe <b style="text-transform: uppercase;">Lcdo. Leonardo Escalona</b>, Director (E) del
        <b style="text-transform: uppercase;">{{ config('app.community_name', 'Laravel') }}</b>,
        ubicada en el Barrio Campo Lindo de la Ciudad de Acarigua Estado Portuguesa, por medio de la presente <b>Hace Constar</b> que el (la) Estudiante
        <span class="gp-sub">{{ $user->nombre . ' ' . $user->apellido ?? '{Nombre Completo}'}}&nbsp;</span>
        titular de la Cédula de Identidad o Cédula Escolar <span class="gp-sub">{{ ' ' . $user->cedula . ' ' ?? '{Cedula}' }}</span>
        cursa <span class="gp-sub gp-sub2">{{ $user->nivel_educacion ?? '{Grado}' }}</span>
        de Educación: <span class="gp-sub gp-sub2">{{ $user->tipo_educacion ?? '{Educacion}' }}</span>
        en esta institución durante el Año Escolar: <span class="gp-sub gp-sub2">{{ $fecha->year }}-{{ $fecha->year + 1 }}</span>
    </p>

    <br><br><br><br>

    <p class="gp-first">
        Constancia que se expide en Acarigua a los <span class="gp-sub gp-sub2">{{ $fecha->day }}</span> días del mes de
        <span class="gp-sub gp-sub2">{{ $fecha->monthName }}</span> del <span class="gp-sub gp-sub2">{{ $fecha->year }}</span>.
    </p>

    <br><br><br><br>

    <p style="text-align: center;">ATENTAMENTE</p>

    <br><br><br>

    <div style="border-bottom: 1px solid; width: 230px; margin: 0 auto;"></div>
    <p style="text-align: center; font-size: 11pt;">
        <b>Lcdo. Leonardo Escalona</b><br>
        C.I: 12.089.276<br>
        Director (E)<br>
        {{ config('app.community_name', 'Laravel') }}<br>
        Rif: J409128644
    </p>
</body>
</html>