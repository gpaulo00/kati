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
    margin: auto 20px;
    padding: auto 10pt;
    text-decoration: underline;
    /*border-bottom: 1px solid;*/
}
.gp-sub:after {
    content: "\00a0\00a0";
}
.gp-sub:before {
    content: "\00a0\00a0";
}

p.gp-first {
  text-indent: 40px;
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

        $nac = new \Carbon\Carbon($user->fecha_nacimiento);
    @endphp
    <img width="750px" src="{{ asset('membrete.png') }}">
    <br><br>

    <h1 class="gp-title">CONSTANCIA DE RETIRO</h1>
    <br><br>
    <p class="gp-first">
        Quien suscribe Lcdo. Leonardo Escalona, titular de la Cédula de Identidad Nº 12.089.276,
        Director (E) del <b>{{ config('app.community_name', 'Laravel') }}</b>,
        ubicada en la calle 30, entre Avenidas 21 y Rómulo Gallegos del Barrio Campo Lindo de la Ciudad de Acarigua
        Estado Portuguesa, por medio de la presente <b>HACE CONSTAR</b> que el (la) Estudiante (a):
        <span class="gp-sub">{{ $user->nombre . ' ' . $user->apellido ?? '{Nombre Completo}'}}&nbsp;</span>

        Portador (a) de la Cédula de Identidad o Cédula Escolar Nº <span class="gp-sub">{{ ' ' . $user->cedula . ' ' ?? '{Cedula}' }}</span>
        de nacionalidad <span class="gp-sub">{{ $user->extranjero ? 'EXTRANJERO' : 'VENEZOLANO' }}</span>,
        nacido (a) el día <span class="gp-sub">{{ $nac->day }}</span> del mes <span class="gp-sub">{{ $nac->monthName }}</span>
        de <span class="gp-sub">{{ $nac->year }}</span>, y de <span class="gp-sub">{{ $nac->diffInYears($fecha) }}</span> años de edad
        inscrito en el <span class="gp-sub">{{ $user->nivel_educacion }}</span>
        de Educación <span class="gp-sub">{{ $user->tipo_educacion }}</span>
        Año Escolar <span class="gp-sub">{{ $fecha->year }}-{{ $fecha->year + 1 }}</span>
    </p>

    <p class="gp-first">
        Durante su permanencia en esta institución se observó una conducta: <span class="gp-sub">BUENA</span>.
    </p>

    <p class="gp-first">
        Se retira debido a: <span class="gp-sub">{{ $motivo }}</span>, según información dada por su
        representante: <span class="gp-sub">{{ $representante }}</span>, portador de la C.I. Nº
        <span class="gp-sub">{{ $ci }}</span>
    </p>

    <br><br>

    <p class="gp-first">
        Constancia que se expide a solicitud de parte interesada en Acarigua a los <span class="gp-sub">{{ $fecha->day }}</span> días del mes de
        <span class="gp-sub">{{ $fecha->monthName }}</span> del <span class="gp-sub">{{ $fecha->year }}</span>.
    </p>

    <br><br>

    <p style="text-align: center;">ATENTAMENTE</p>

    <br><br>

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